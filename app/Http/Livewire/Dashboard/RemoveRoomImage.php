<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Room;
use App\Traits\CloudinaryFileServer;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RemoveRoomImage extends Component
{
    use CloudinaryFileServer;
    public $identifier;
    public $_id;
    public $filename;
    public $publicid;
    public function mount($identifier,$_id, $filename,$publicid)
    {
        $this->identifier = $identifier;
        $this->_id = $_id;
        $this->filename = $filename;
         $this->publicid = $publicid;
    }

    /**
     * @throws \Exception
     */
    public function RemoveImage()
    {
        $response  = $this->DeleteFile($this->identifier);
        if ($response){
            //get the room whose image is to be deleted
            $room = Room::find($this->_id);
            $room->update([
                $this->filename => null,
                $this->publicid => null
            ]);
            $this->emit('deleted-image');
        } else{
            $this->emit('deleted-image-error');
        }
        return redirect(request()->header('referer'));
    }
    public function render()
    {
        return view('livewire.dashboard.remove-room-image');
    }
}
