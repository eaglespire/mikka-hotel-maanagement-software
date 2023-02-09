<?php

namespace Modules\Room\Http\Controllers;
use App\Models\Room;
use Illuminate\Support\Facades\Cache;
use Modules\Room\Services\RoomCacheServer;

class RoomController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth','screen.lock']);
    }

    public function index()
    {
        $this->data['title'] = "Rooms";
        $this->data['titleText'] = "Available Rooms";
        $rooms = Cache::remember(RoomCacheServer::ROOM_CACHE, now()->addDays(30),static function (){
            return Room::get();
        });
        /*
         * Convert the collection to a plain PHP Array
         */
        $arr = $rooms->toArray();
        $items = $this->paginate($arr,10);
        // Set  pagination path/route.
        $items->withPath(route('modules.room.index'));
        return view('room::index',$this->data,compact('items'));
    }
}
