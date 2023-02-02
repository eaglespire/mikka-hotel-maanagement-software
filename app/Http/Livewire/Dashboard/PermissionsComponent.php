<?php

namespace App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsComponent extends Component
{
    public $permissions,$role;
    public $checkedPermissions = [];
    public function mount(Role $role)
    {
        $this->role = $role;
        $this->permissions = Cache::remember('permissionsCache', now()->addDays(30),function (){
            return Permission::get();
        });
    }
    public function revokePermission($permission)
    {
        //dd($permission['name']);
        $this->role->revokePermissionTo($permission['name']);
        session()->flash('revokeSuccess','success');

    }
    public function saveCheckedPermissions()
    {
        try {
           if (count($this->checkedPermissions) !== 0)
           {
               $this->role->givePermissionTo($this->checkedPermissions);
               $this->checkedPermissions = [];
               session()->flash('success','success...');
           }else{
               session()->flash('error','error...');
           }
           return back();
        } catch (\Exception $exception){
           Log::error($exception->getMessage());
        }
    }
    public function render()
    {
        //dd($this->roleName);
        return view('livewire.dashboard.permissions-component')
            ->extends('dashboard.roles-permissions')
            ->section('main');
    }
}
