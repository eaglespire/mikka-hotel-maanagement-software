<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Room;
use App\Services\CacheKeys;
use App\Services\Constant;
use App\Services\FullPageCache;
use App\Services\Permissions;
use App\Traits\CloudinaryFileServer;
use App\Traits\CustomPagination;
use App\Traits\HasInternet;
use App\Traits\UserImage;
use http\Client\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{
    use UserImage,CustomPagination,CloudinaryFileServer,HasInternet;
    private array $data = [];
    public function __construct()
    {
        $this->data['title'] = 'Dashboard';
        $this->data['titleText'] = "Hi";
        $this->data['titleContent'] = "Hotel Management System";
        $this->data['description'] = "";
        $this->data['keywords'] = "";
    }

    public function index()
    {
        $this->data['titleText'] = "Hi, ". auth()->user()->fullname;
        return view('dashboard.index', $this->data);
    }
    public function analytics()
    {
        $this->data['titleText'] = "Hi, ". auth()->user()->fullname;
        return view('dashboard.analytics',$this->data);
    }
    public function profile()
    {
        $this->data['title'] = "Profile ";
        $this->data['titleText'] = "Hi, ". auth()->user()->fullname;
        $user['user'] = auth()->user();
        return view('dashboard.profile',$this->data,$user);
    }
    public function lockScreen(Request $request)
    {
        $this->data['title'] = "Screen Locked |";
        $this->data['titleText'] = "Hi, ". auth()->user()->fullname;
        $request->session()->put(Constant::SCREEN_LOCK,true);
        return view('auth.lock-screen', $this->data);
    }
    public function unlockScreen(Request $request)
    {
        $request->validate(['password'=>['required','string']]);
        if (Hash::check($request['password'], auth()->user()->password))
        {
            //password is correct
            $request->session()->forget(Constant::SCREEN_LOCK);
            toast('Welcome back','success');
            return redirect()->route('b-dashboard.index');
        }
        toast('Password is incorrect','error');
        return back();
    }
    public function BackToLogin(Request $request)
    {
        auth()->logout();
        if ($request->session()->has(Constant::SCREEN_LOCK)){
            $request->session()->forget(Constant::SCREEN_LOCK);
        }
        return redirect(route('login'));
    }
    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'firstname'=>['required','string','max:255'],
            'lastname'=>['required','string','max:255'],
            'email'=>['required','string',Rule::unique('users')->ignore(auth()->id())],
            'phone'=>['nullable']
        ]);
        try {
            auth()->user()->update([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'phone' => $request['phone'],
                'email' => $request['email']
            ]);
            toast('Profile updated','success');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('An error has occurred','error');
        }
        return back();
    }
    public function ProfileImageUpload(Request $request)
    {
        $request->validate([
            'photo'=>['required','image','mimes:jpg,JPG,PNG,png,JPEG,jpeg','max:1024']
        ]);
        if ($request->hasFile('photo'))
        {
            //remove the previuosly uploaded photo
            if (is_file(public_path('storage/users/'.auth()->user()->photo)))
            {
                unlink(public_path('storage/users/'.auth()->user()->photo));
            }
            auth()->user()->update([
                'photo'=>$this->store('users',200,200,'photo')
            ]);
            toast('Profile image updated','success');
            return back();
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function Roles()
    {
        $this->authorize(Permissions::CAN_ACCESS_ROLES);
        $this->data['title'] = "User roles";
        $this->data['titleText'] = "User roles";
        return view('dashboard.role.index',$this->data);
    }
    public function AddRole(Request $request)
    {
        if (auth()->user()->can(Permissions::CAN_CREATE_ROLE)){
            $request->validate([
                'name'=>['required','string','unique:roles','max:255']
            ]);
            $role = Role::create(['guard_name' => 'web','name' => ucwords($request->name)]);
            if ($role){
                toast('Role created','success');
            }  else{
                toast('Error','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();

    }
    public function UpdateRole(Request $request, int $id)
    {
        if (auth()->user()->can(Permissions::CAN_UPDATE_ROLE)){
            $request->validate([
                'name'=>['required','string','unique:roles','max:255']
            ]);
            $role = Role::findById($id);
            $response = $role->update(['name' => $request->name]);
            if ($response){
                toast('Success','success');
            }  else{
                toast('Error','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function DeleteRole(Request $request)
    {
        if (auth()->user()->can(Permissions::CAN_DELETE_ROLE)){
            $roleId = $request->id;
            $role = Role::findById($roleId);
            $role->delete();
            toast('Deleted','success');
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function role(string $name)
    {
        if (Auth::user()->can(Permissions::CAN_READ_ROLES)){
            $role = Role::findByName($name);
            //Get all file permissions
            $allPermissions = Cache::remember(CacheKeys::PERMISSIONS_CACHE, now()->addDays(30), function (){
                return Permission::pluck('name');
            });

            //return only the permissions that this role does not have
            $permissions = $allPermissions->filter(function ($item) use ($role){
                return $role->permissions->pluck('name')->doesntContain($item);
            }) ;

            $this->data['title'] = "Module Access";
            $this->data['titleText'] = "Set/View Permissions";
            return view('dashboard.role.role',$this->data, compact('role', 'permissions'));
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function AssignPermission(Request $request, String $role)
    {
        if (Auth::user()->can(Permissions::CAN_UPDATE_ROLE)){
            $request->validate([
                'permission'=>['required']
            ]);
            $Role = Role::findByName($role);
            $Role->givePermissionTo($request->permission);
            toast('New permissions added to '. $role, 'success');
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function RevokePermission(Request $request, string $roleName)
    {
        if (Auth::user()->can(Permissions::CAN_DELETE_ROLE)){
            $permission = Permission::findByName($request->permission);
            $role = Role::findByName($roleName);
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
                toast('Permission revoked','success');
            }  else{
                toast('Error','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }


    public function Faq()
    {
        $this->data['title'] = "Faq";
        $this->data['titleText'] = "Faq";
        return view('dashboard.faq.index',$this->data);
    }

    public function PostCategory()
    {
        $this->data['title'] = "Categories";
        $this->data['titleText'] = "Categories";
        return view('dashboard.blog.category',$this->data);
    }
    public function Posts()
    {
        $this->data['title'] = "Posts";
        $this->data['titleText'] = "Posts";
        return view('dashboard.blog.post',$this->data);
    }
    public function Post(Post $post)
    {
        $this->data['title'] = $post->title;
        $this->data['titleText'] = $post->title;
        $this->data['post'] = $post;
        return view('dashboard.blog.single-post',$this->data);
    }
    public function Employee()
    {
        $this->data['title'] = 'Staff';
        $this->data['titleText'] ='Staff' ;
        return view('dashboard.employee.index',$this->data);
    }

}
