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
    public function RoomFeatures()
    {
        $this->data['title'] = "Room Features";
        $this->data['titleText'] = "Available Room Features";
        $features = Cache::remember(CacheKeys::FEATURE_CACHE, now()->addDays(30), function (){
            return Feature::get();
        });
        return view('dashboard.feature.index',$this->data,compact('features'));
    }
    public function AddFeature()
    {
        if (Auth::user()->can(Permissions::CAN_CREATE_ROOM)){
            $this->data['title'] = "Add Feature";
            $this->data['titleText'] = "Add New Room Feature";
            return view('dashboard.feature.create',$this->data);
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function StoreFeature(Request $request)
    {
        if (Auth::user()->can(Permissions::CAN_CREATE_ROOM)){
            $request->validate([
                'name'=>['required','string','max:255','min:3'],
                'icon'=>['required']
            ]);
            $feature = Feature::create([
                'name' => ucwords($request['name']),
                'icon' => $request['icon']
            ]);
            if ($feature){
                toast('Feature added','success');
            }else{
                toast('An error occurred','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function UpdateRoomFeature(Request $request, int $id)
    {
        if (Auth::user()->can(Permissions::CAN_UPDATE_ROOM)){
            $request->validate([
                'name'=>['required','string','max:255','min:3'],
                'icon'=>['nullable']
            ]);
            try {
                $feature = Feature::findOrFail($id);
                $feature->update([
                    'name' => $request['name'],
                    'icon' => $request['icon'] == null ? $feature->icon : $request['icon']
                ]);
                toast('Updated successfully','success');
            }  catch (ModelNotFoundException $exception){
                Log::error($exception->getMessage());
                toast('An error has occurred','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function DeleteRoomFeature(int $id)
    {
        if (Auth::user()->can(Permissions::CAN_DELETE_ROOM)){
            try {
                $feature = Feature::findOrFail($id);
                $feature->delete();
                toast('Deleted...','success');
            }  catch (ModelNotFoundException $exception){
                Log::error($exception->getMessage());
                toast('Feature not found','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function Rooms()
    {
        if (Cache::has(FullPageCache::ROOMS_PAGE_CACHE)){
            return Cache::get(FullPageCache::ROOMS_PAGE_CACHE);
        }else{
            $this->data['title'] = "Rooms";
            $this->data['titleText'] = "Available Rooms";
            $rooms = Cache::remember(CacheKeys::ROOM_CACHE, now()->addDays(30),static function (){
                return Room::get();
            });
            /*
             * Convert the collection to a plain PHP Array
             */
            $arr = $rooms->toArray();
            $items = $this->paginate($arr,20);
            // Set  pagination path/route.
            $items->withPath(route('b-rooms'));
            $cachedData = view('dashboard.room.index',$this->data,compact('items'))->render();
            Cache::put(FullPageCache::ROOMS_PAGE_CACHE,$cachedData);
            return $cachedData;
        }

    }
    public function AddRoom(Request $request)
    {
        if (Auth::user()->can(Permissions::CAN_CREATE_ROOM)){
            $this->data['title'] = "New room";
            $this->data['titleText'] = "Add a new room";
            return view('dashboard.room.create',$this->data);
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function StoreRoom(StoreRoomRequest $request)
    {
        if (Auth::user()->can(Permissions::CAN_CREATE_ROOM)){
            if (!$this->ConnectedToInternet()){
                toast('Ooops!!!, No or weak Internet','error');
                return back();
            }
            try {
                DB::transaction(function () use ($request){
                    $firstImageUrl = $this->SaveFile('rooms',1200,800,'firstImage');
                    $secondImageUrl = $this->SaveFile('rooms',400,300,'secondImage');
                    $thirdImageUrl = $this->SaveFile('rooms',400,300,'thirdImage');
                    $fourthImageUrl = $this->SaveFile('rooms',400,300,'fourthImage');
                    $fifthImageUrl = $this->SaveFile('rooms',400,300,'fifthImage');
                    $sixthImageUrl = $this->SaveFile('rooms',400,300,'sixthImage');

                    $room =  Room::create([
                        'title'=>$request['title'],
                        'category' => $request['category'],
                        'extraInfo' => $request['adesc'],
                        'description' => $request['desc'],
                        'price' => $request['price'],
                        'roomNumber' => $request['roomNumber'],
                        'firstImage'=> empty($firstImageUrl) ? null : $firstImageUrl[1] ,
                        'secondImage' => empty($secondImageUrl) ? null : $secondImageUrl[1],
                        'thirdImage' => empty($thirdImageUrl) ? null : $thirdImageUrl[1],
                        'fourthImage' => empty($fourthImageUrl) ? null : $fourthImageUrl[1],
                        'fifthImage' => empty($fifthImageUrl) ? null : $fifthImageUrl[1],
                        'sixthImage' => empty($sixthImageUrl) ? null : $sixthImageUrl[1],
                        'f1_public_id' => empty($firstImageUrl) ? null : $firstImageUrl[0],
                        'f2_public_id' => empty($secondImageUrl) ? null : $secondImageUrl[0],
                        'f3_public_id' => empty($thirdImageUrl) ? null : $thirdImageUrl[0],
                        'f4_public_id' => empty($fourthImageUrl) ? null : $fourthImageUrl[0],
                        'f5_public_id' => empty($fifthImageUrl) ? null : $fifthImageUrl[0],
                        'f6_public_id' => empty($sixthImageUrl) ? null : $sixthImageUrl[0],
                    ]);
                    if (!$room){
                        throw new \Exception('Room not created');
                    }
                    $room->update([
                        'slug'=>Str::slug($room->title).'-'.$room->id.'-'.Str::slug($room->category)
                    ]);
                });
                toast('Room created','success');
            } catch (\Exception $exception){
                Log::error($exception->getMessage());
                toast('Something went wrong','error');
            }
            return back();
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function Room(string $slug)
    {
        $room = Room::where('slug',$slug)->first();
        $this->data['title'] = (string)$room->title;
        $this->data['titleText'] = "Single room";
         return view('dashboard.room.show',$this->data,compact('room'));
    }
    public function EditRoom(string $slug)
    {
        if (Auth::user()->can(Permissions::CAN_UPDATE_ROOM)){
            $room = Room::where('slug',$slug)->first();
            $this->data['title'] = (string)$room->title;
            $this->data['titleText'] = "Edit Single room";
            return view('dashboard.room.edit',$this->data,compact('room'));
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }
    public function UpdateRoom(UpdateRoomRequest $request, string $slug)
    {
        if (Auth::user()->can(Permissions::CAN_UPDATE_ROOM)){
            if (!$this->ConnectedToInternet()){
                toast('Ooops!!!, No or weak Internet','error');
                return back();
            }
            try {
                $room = Room::where('slug',$slug)->firstOrFail();

                DB::transaction(function () use ($room, $request) {
                    $firstImageResponse = $this->CheckImageWasUploaded('firstImage',$room['f1_public_id'],'rooms',1200,800);
                    $secondImageResponse = $this->CheckImageWasUploaded('secondImage',$room['f2_public_id'],'rooms',400,300);
                    $thirdImageResponse = $this->CheckImageWasUploaded('thirdImage',$room['f3_public_id'],'rooms',400,300);
                    $fourthImageResponse = $this->CheckImageWasUploaded('fourthImage',$room['f4_public_id'],'rooms',400,300);
                    $fifthImageResponse = $this->CheckImageWasUploaded('fifthImage',$room['f5_public_id'],'rooms',400,300);
                    $sixthImageResponse = $this->CheckImageWasUploaded('sixthImage',$room['f6_public_id'],'rooms',400,300);

                    $updateResponse = $room->update([
                        'title'=>$request['title'],
                        'category' => $request['category'],
                        'extraInfo' => $request['adesc'],
                        'description' => $request['desc'],
                        'price' => $request['price'],
                        'roomNumber' => $request['roomNumber'],
                        'firstImage'=> $firstImageResponse !== null ?  $firstImageResponse[1] : $room['firstImage'] ,
                        'secondImage' => $secondImageResponse !== null ? $secondImageResponse[1] : $room['secondImage'] ,
                        'thirdImage' => $thirdImageResponse !== null ? $thirdImageResponse[1] : $room['thirdImage'] ,
                        'fourthImage' => $fourthImageResponse !== null ? $fourthImageResponse[1] : $room['fourthImage'] ,
                        'fifthImage' => $fifthImageResponse !== null ? $fifthImageResponse[1] : $room['fifthImage'] ,
                        'sixthImage' => $sixthImageResponse !== null ? $sixthImageResponse[1] : $room['sixthImage'] ,
                        'f1_public_id' => $firstImageResponse !== null ? $firstImageResponse[0] : $room['f1_public_id'] ,
                        'f2_public_id' => $secondImageResponse !== null ? $secondImageResponse[0] : $room['f2_public_id'] ,
                        'f3_public_id' => $thirdImageResponse !== null ? $thirdImageResponse[0] : $room['f3_public_id'] ,
                        'f4_public_id' => $fourthImageResponse !== null ? $fourthImageResponse[0] : $room['f4_public_id'] ,
                        'f5_public_id' => $fifthImageResponse !== null ? $fifthImageResponse[0] : $room['f5_public_id'] ,
                        'f6_public_id' => $sixthImageResponse !== null ? $sixthImageResponse[0] : $room['f6_public_id'] ,
                    ]);
                    $room->update([
                        'slug'=>Str::slug($room->title).'-'.$room->id.'-'.Str::slug($room->category)
                    ]);
                    if(!$updateResponse){
                        toast('An error occurred','error');
                    } else{
                        toast('Successfully updated','success');
                    }
                });
                return redirect()->route('b-rooms');
            }  catch (ModelNotFoundException $exception){
                Log::error($exception->getMessage());
                toast('Oops!!!, Not Found','error');
                return back();
            }
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();
    }

    public function DeleteRoom(int $id)
    {
        if (Auth::user()->can(Permissions::CAN_DELETE_ROOM)){
            if ($this->ConnectedToInternet()){
                try {
                    $room = Room::where('id',$id)->firstOrFail();
                    //delete the images if any
                    $arr = ['f1_public_image','f2_public_image','f3_public_image','f4_public_image','f5_public_image','f6_public_image'];
                    for ($i = 1; $i < 6; $i++){
                        $this->DeleteFile($room[$arr[$i]]);
                    }
                    //delete the room model
                    $room->delete();
                    toast('Success','success');
                } catch (ModelNotFoundException $exception){
                    Log::error($exception->getMessage());
                    toast('An error occurred','error');
                }
            }  else{
                toast('Weak or no internet','error');
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
    public function Pricing()
    {
        $this->data['title'] = "Pricing";
        $this->data['titleText'] = "Pricing";
        return view('dashboard.pricing.index',$this->data);
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
