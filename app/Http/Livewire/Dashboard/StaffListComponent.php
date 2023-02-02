<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class StaffListComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = "";
    public $staffIndex='';

    public function mount()
    {

    }

    public function searchList()
    {
        return User::with('roles')->latest()
            ->where('id','>',1)
            ->search($this->searchTerm)->paginate(20);
    }
    public function refreshList()
    {
       $this->searchTerm = "";
    }
    public function launchDeleteModal(int $id)
    {
        $this->staffIndex = $id;
        $this->dispatchBrowserEvent('launch-delete-modal');
    }
    public function removeStaff()
    {
        try {
            $staff = User::findOrFail($this->staffIndex);
            if (file_exists(public_path('storage/users/'.$staff->photo)))
            {
                unlink(public_path('storage/users/'.$staff->photo));
            }
            $staff->delete();
            $this->staffIndex = "";
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success','deleted');
            $this->mount();
            $this->render();
            return back();
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            session()->flash('error','An error has occurred');
            return back();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.staff-list-component',[
            'employees' => $this->searchList()
        ]);
    }
}
