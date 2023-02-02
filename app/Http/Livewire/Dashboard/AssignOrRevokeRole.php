<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use App\Traits\RolesCacheTrait;
use Livewire\Component;

class AssignOrRevokeRole extends Component
{
    use RolesCacheTrait;
    public $user,$roles, $showRoles = false,$role;

    public function mount(User $user)
    {
        $this->roles = $this->cachedRoles();
        $this->user = $user;
    }
    public function launchModal($role)
    {
        $this->role = $role[0]['name'];
        $this->dispatchBrowserEvent('open-modal');
    }
    public function revokeRole()
    {
        $this->user->removeRole($this->role);
        $this->dispatchBrowserEvent('close-modal');
        $this->role = null;
        session()->flash('roleRevoked','Role revoked successfully');
        $this->showRoles = true;
        return back();
    }
    public function launchAssignRoleModal($role)
    {
        //dd($role['name']);
        $this->role = $role['name'];
        $this->dispatchBrowserEvent('launch-assign-modal');
    }
    public function assignRole()
    {
        $this->user->assignRole($this->role);
        session()->flash('success','success');
        $this->dispatchBrowserEvent('close-assign-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.assign-or-revoke-role');
    }
}
