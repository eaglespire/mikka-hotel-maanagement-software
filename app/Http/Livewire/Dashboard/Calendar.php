<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $eventList;
    protected $listeners = ['calendarUpdated'=>'$refresh'];

    public function mount()
    {
        $appointments = Event::get();
        $this->eventList = [];
        foreach ($appointments as $appointment) {
            $this->eventList[] = [
                'title' => $appointment->name,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
    }
    public function render()
    {
        return view('livewire.dashboard.calendar');
    }
}
