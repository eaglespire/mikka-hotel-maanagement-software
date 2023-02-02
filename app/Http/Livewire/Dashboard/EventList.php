<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;


class EventList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $eventTitle,$eventStart,$eventEnd,$eventId;

    public function deleteEvent(int $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            $this->emit('calendarUpdated');
            toast('Success','success')->position('bottom-end');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('An error has occurred','error')->position('bottom-end');
        }
        return redirect(request()->header('Referer'));
    }
    public function launchEditModal(int $eventId)
    {
        try {
            $event = Event::findOrFail($eventId);
            $this->eventTitle = $event->name;
            $this->eventStart = $event->start_time;
            $this->eventEnd = $event->finish_time;
            $this->eventId = $eventId;
            $this->emit('LaunchUpdateModal');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('EventNotFound');
        }
    }
    public function updateEvent()
    {
        $this->validate([
            'eventTitle'=>['required'],
            'eventStart'=>['required'],
            'eventEnd'=>['required']
        ]);
        $event = Event::find($this->eventId);
        $event->update([
            'name'=>$this->eventTitle,
            'start_time'=>$this->eventStart,
            'finish_time'=>$this->eventEnd
        ]);
        $this->emit('EventUpdated');
        //dd($this->eventTitle,$this->eventStart,$this->eventEnd);
    }
    public function render()
    {
        $events = Event::simplePaginate(3);
        return view('livewire.dashboard.event-list',['events' => $events]);
    }
}
