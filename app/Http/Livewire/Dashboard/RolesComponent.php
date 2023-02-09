<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
//use Spatie\Permission\Models\Role;

class RolesComponent extends Component
{
    public $name,$delete_id;
    public $edit_id,$editRoleName;
    public $roles,$permissions,$showRole;
    protected $rules = [
        'name'=>['required','string','unique:roles']
    ];
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function mount()
    {
        $this->name = "";
        $this->roles = Cache::remember('roleCache', now()->addDays(30),function (){
            return Role::where('id','>',1)->get();
        });
    }

    public function addRole()
    {
        //dd($this->name);
        $this->validate();

        if (Role::create(['guard_name'=>'web','name'=>$this->name])){
            $this->name = "";
            session()->flash('success','Data added');
            $this->dispatchBrowserEvent('close-modal');
            $this->mount();
            $this->render();
        }
        //return false;
    }
    public function launchDeleteModal(int $id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('open-delete-modal');
    }
    public function removeRole()
    {
        $role = Role::findById($this->delete_id);
        if ($role->delete()){
            session()->flash('success','success...');
        }else{
            session()->flash('error','An error has occurred');
        }
        $this->delete_id = null;
        $this->dispatchBrowserEvent('close-delete-modal');
        $this->mount();
        $this->render();
    }
    public function launchEditModal(int $id)
    {
        $role = Role::findById($id);
        $this->name = $role->name;
        $this->edit_id = $id;
        $this->dispatchBrowserEvent('open-edit-modal');
    }
    public function updateRole()
    {
        $this->validate([
            'name'=>['required','unique:roles','string','max:255','min:3']
        ]);
        $role = Role::findById($this->edit_id);
        if ($role->update(['name'=>$this->name])){
            session()->flash('success','updated...');
            $this->dispatchBrowserEvent('close-edit-modal');
            $this->mount();
            $this->render();
        }else{
            session()->flash('error','An error has occurred');
        }
        return back();
    }

    public function launchShowModal(int $id)
    {
        $role = Role::findById($id);
        $this->showRole = $role->name;
        $this->dispatchBrowserEvent('open-show-modal');
    }

    public function render()
    {
        //dd($this->roles);
        return view('livewire.dashboard.roles-component');
    }
}
