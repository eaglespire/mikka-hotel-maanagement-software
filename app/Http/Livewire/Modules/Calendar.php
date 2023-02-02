<?php

namespace App\Http\Livewire\Modules;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Calendar extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title,$start,$end,$_id,$comment;
    public $hideModal, $eventList,$mode;

    protected $rules = [
        'title'=>['required','string','max:20'],
        'start'=>['required','string'],
        'end'=>['required','string'],
        'comment'=>['nullable']
    ];


    public function ToggleModal()
    {
        $this->hideModal = !$this->hideModal;
    }

    public function SaveNewEvent()
    {
        $this->validate();
        $response = Event::create([
            'name' => $this->title,
            'start_time' => $this->start,
            'finish_time' => $this->end,
            'comments' => $this->comment
        ]);
        if ($response){
            $this->reset(['title','start','end','comment']);
            $this->emit('refreshCalendar');
            $this->emit('changes-saved');
            return redirect(request()->header('Referer'));
        }else{
            $this->emit('changes-not-saved');
        }

    }

    public function mount()
    {
        $this->fill([
            'hideModal' => true,
            'title' => null,
            'comment' => null,
            'start' => null,
            'end' => null,
            'mode'=> 'New Event'
        ]);
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

    public function DeleteEvent(int $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            $this->emit('changes-saved');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('changes-not-saved');
        }
        return redirect(request()->header('Referer'));
    }

    public function LaunchEditModal(int $id)
    {
        try {
            $event = Event::findOrFail($id);
            $this->title = $event->name;
            $this->start = $event->start_time;
            $this->end = $event->finish_time;
            $this->comment = $event->comments;
            $this->hideModal = false;
            $this->mode = 'Update Event';
            $this->_id = $id;
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('EventNotFound');
        }
    }
    public function UpdateEvent()
    {
        $this->validate();
        $event = Event::find($this->_id);
       $response = $event->update([
            'name'=>$this->title,
            'start_time'=>$this->start,
            'finish_time'=>$this->end,
            'comments' => $this->comment
        ]);
       if ($response){
           $this->emit('changes-saved');
       }else{
           $this->emit('changes-not-saved');
       }
       $this->hideModal = true;
       return redirect(request()->header('referer'));
       // the above code closes the modal after updating the event
    }

    public function render()
    {
        $events = Event::simplePaginate(10);
        return view('livewire.modules.calendar',['events' => $events]);
    }
}
