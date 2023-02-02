<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $data['title'] = "Calendar";
        $data['titleText'] = "Check out events";
        $data['titleContent'] = "Hotel Management System";
        $data['description'] = "";
        $data['keywords'] = "";
        $appointments = Event::get();
        $events = [];
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->name,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
        return view('dashboard.events',['events' => $events],$data);
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
