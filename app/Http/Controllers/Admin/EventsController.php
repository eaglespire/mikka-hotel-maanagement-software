<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends BaseController
{
    public function index()
    {
        $this->data['title'] = "Calendar";
        $this->data['titleText'] = "Check out events";
        return view('dashboard.events',$this->data);
    }
    public function store(EventStoreRequest $request)
    {
        if ($request->saveToDB())
        {
            toast('Event Added','success')->position('bottom-end');
        }else{
            toast('An error has occurred','error')->position('bottom-end');
        }
        return back();
    }
}
