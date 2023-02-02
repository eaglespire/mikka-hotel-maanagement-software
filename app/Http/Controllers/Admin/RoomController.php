<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        return view('dashboard.allRooms');
    }
    public function createRoom()
    {
        //Alert::success('Success','Data created');
        return view('dashboard.createRoom');
    }
    public function storeRoom(StoreRoomRequest $request)
    {
        if ($request->store())
        {
            alert('success','New Room Added')->position('bottom-end');
        }else{
            alert('error','An error has occurred')->position('bottom-end');
        }
        return back();
    }
    public function manageRoom(Room $room)
    {
        return view('dashboard.manageRoom', compact('room'));
    }
    public function allFeatures()
    {
        return view('dashboard.allFeatures') ;
    }
    public function newFeature()
    {
        return view('dashboard.createFeature') ;
    }
    public function storeFeature()
    {

    }

}
