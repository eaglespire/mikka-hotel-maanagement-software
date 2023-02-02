<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\User;
use App\Services\Permissions;
use App\Services\StaffService;
use App\Traits\RolesCacheTrait;

class DashboardControllerOld extends Controller
{

    use RolesCacheTrait;
    public function indexPage()
    {
        return view('dashboard.index');
    }
    public function staffListPage()
    {
        if (auth()->user()->can(Permissions::CAN_READ_EMPLOYEES)){
            return view('dashboard.staffList');
        }
        return view('errors.authError');

    }
    public function createStaffPage()
    {
        //fetch the roles
        $roles = $this->cachedRoles();
        return view('dashboard.newStaff', compact('roles'));
    }
    public function storeStaff(NewStaffRequest $request)
    {
        //dd($request->all());
        $staffService = new StaffService;
        $response = $staffService->createNewStaff($request['firstname'], $request['lastname'],$request['email'],$request['phone'],$request['role'],$request['join_date'], $request['dob']);

        if ($response){
            session()->flash('success','data added');
        }else{
            session()->flash('error','Something went wrong');
        }
        return back();
    }
    public function editStaffPage(int $id)
    {
        $roles = $this->cachedRoles();
        $staff = User::find($id);
        return view('dashboard.editStaff', [
            'roles' => $roles,
            'staff' => $staff
        ]);
    }
    public function updateStaff(UpdateStaffRequest $request, int $id)
    {
       dd($request->all());
        $arr = [
            'firstname'=>$request['firstname'],
            'lastname'=>$request['lastname'],
            'email'=>$request['email'],
            'password_text'=>$request['password_text'],
            'role'=>$request['role'],
            'dob'=>$request['dob'],
            'join_date'=>$request['join_date'],
            'phone'=>$request['phone'],
            'photo'=>$request['photo'],
            'status'=>$request['status']
        ];
        $staffService = new StaffService;
        $response = $staffService->updateStaff($id,$arr);
        if ($response){
            session()->flash('success','Update success...');
        }else{
            session()->flash('error','Something went wrong');
        }
        return back();
    }
    public function themeSettingsPage()
    {
        return view('dashboard.themeSettings');
    }
    public function roleSettingsPage()
    {
        return view('dashboard.roles-permissions');
    }

}
