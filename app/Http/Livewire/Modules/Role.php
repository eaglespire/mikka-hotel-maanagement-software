<?php

namespace App\Http\Livewire\Modules;

use App\Models\Permission;
use App\Services\CacheKeys;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Role extends Component
{
    public $hideModal;
    public $name;
    public $hidden;
    public $btnText;
    public $roles;
    public $mode;
    public $modalHeader ;
    public $modalPermissionsHeader;
    public $hidePermissionsModal;
    public $permissions;
    public $rolePermissions;
    public $role;
    public $roleName;

    protected $rules = [
        'name' => ['required','string','unique:roles','max:255']
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $roles = Cache::remember(CacheKeys::ROLE_CACHE, now()->addDays(30), function (){
            return \App\Models\Role::get();
        });
        $permissions = Cache::remember(CacheKeys::PERMISSIONS_CACHE,now()->addDays(30), function (){
            return Permission::get();
        });
        $this->fill([
            'hideModal' => true,
            'name'=> null,
            'hidden' => null,
            'btnText' => 'Save',
            'roles' => $roles->where('id','>',1),
            'mode' => 0,
            'modalHeader' => 'Add New Role',
            'modalPermissionsHeader' => 'Manage Permissions',
            'hidePermissionsModal' => true,
            'permissions' => $permissions,
            'role' => null,
            'roleName' => null
        ]);
    }
    public function OpenModal(int $mode = 0, int $hidden = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        if ($mode == 1){
            $this->hidden = $hidden;
            $this->mode = $mode;
            $role = \App\Models\Role::find($this->hidden);
            $this->name = $role['name'];
            $this->btnText = 'Update';
            $this->modalHeader ='Update';
        }
    }
    public function CloseModal()
    {
        $this->reset([
            'hidden',
            'hideModal',
            'modalHeader',
            'mode',
            'btnText',
            'name'
        ]);
        $this->mount();
    }
    public function Save()
    {
        $this->validate();
        $response = \App\Models\Role::create([
            'name'=>$this->name
        ]);
        if ($response){
            $this->reset(['name']);
            $this->emit('success','Role added');
            $this->CloseModal();
            $this->mount();
        }else{
            $this->emit('fail','Something went wrong');
        }
    }
    public function Update()
    {
        $this->validate();
        try {
            $role = \App\Models\Role::findOrFail($this->hidden);
            $response = $role->update(['name'=>$this->name]);
            if ($response){
                $this->emit('success','Role updated');
            }else{
                $this->emit('fail','An error occurred');
            }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail','An error occurred');
        }
        $this->CloseModal();
    }
    public function Remove(int $id)
    {
        try {
            $role = \App\Models\Role::findOrFail($id);
            $response = $role->delete();
            if ($response){
                $this->emit('success','deleted');
            }else{
                $this->emit('fail','An error occurred');
            }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail','An error occurred');
        }
        $this->mount();
    }
    public function OpenPermissionsModal(int $id,string $name)
    {
        $role = \App\Models\Role::find($id);
        $this->role = $role;
        $this->roleName = $name;
        $this->rolePermissions = $role->permissions;
        $this->hidePermissionsModal = false;
    }
    public function ClosePermissionsModal()
    {
        $this->reset(['hidePermissionsModal','role']);
        $this->mount();
    }
    public function AddPermission(int $id)
    {
        $response = $this->role->assignPermission($id);
        if ($response){
            Artisan::call('cache:clear');
           // Cache::forget(CacheKeys::PERMISSIONS_CACHE);
            $this->emit('success','Success');
            return redirect(request()->header('Referer'));
            $this->mount();
        }else{
            $this->emit('fail','An error occurred');
        }
        return back();
    }
    public function RevokePermission(int $id)
    {
        $this->role->revokePermission($id);
        Artisan::call('cache:clear');
        //Cache::forget(CacheKeys::PERMISSIONS_CACHE);
        $this->emit('success','Permission revoked');
        $this->mount();
    }
    public function render()
    {
        return view('livewire.modules.role');
    }
}
