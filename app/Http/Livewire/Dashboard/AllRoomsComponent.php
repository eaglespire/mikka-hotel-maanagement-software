<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class AllRoomsComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $data['rooms'] = Room::paginate(20);
        return view('livewire.dashboard.all-rooms-component',$data);
    }
}
