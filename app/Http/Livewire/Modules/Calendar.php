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

    public $title;
    public $start;
    public $end;
    public $hidden;
    public $comment;
    public $hideModal;
    public $eventList;
    public $mode;
    public $btnText;
    public $modalHeader;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'title'=>['required','string','max:20'],
        'start'=>['required','string'],
        'end'=>['required','string'],
        'comment'=>['nullable']
    ];

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
        $this->fill([
            'hideModal' => true,
            'title'=> null,
            'hidden' => null,
            'btnText' => 'Save',
            'mode' => 0,
            'modalHeader' => 'Add New event',
            'start' => null,
            'end' => null,
            'comment' => null
        ]);
    }
    public function OpenModal($mode = 0, $hidden = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        if ($mode == 1){
            $this->hidden = $hidden;
            $event = Event::find($this->hidden);
            $this->title = $event['name'];
            $this->start = $event['start_time'];
            $this->end = $event['finish_time'];
            $this->comment = $event['comment'];
            $this->modalHeader ='Update';
            $this->btnText = 'Update';
        }
        $this->mode = $mode;
    }
    public function CloseModal()
    {
        $this->reset([
            'hidden',
            'hideModal',
            'modalHeader',
            'mode',
            'btnText',
            'title',
            'start',
            'end',
            'comment' ,
            'eventList',
        ]);
        $this->mount();
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
            $this->emit('success');
            return redirect(request()->header('Referer'));
        }else{
            $this->emit('fail');
            return back();
        }
    }



    public function DeleteEvent(int $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            $this->emit('success');
            return redirect(request()->header('Referer'));
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail');
            return back();
        }
    }

    public function UpdateEvent()
    {
        $this->validate();
        $event = Event::find($this->hidden);
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
        return view('livewire.modules.calendar', compact('events'));
    }
}
