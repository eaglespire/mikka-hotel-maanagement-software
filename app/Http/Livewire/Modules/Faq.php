<?php

namespace App\Http\Livewire\Modules;
use App\Services\CacheKeys;
use App\Traits\CustomPagination;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Faq extends Component
{
    use CustomPagination;
    public $question,$answer,$list;
    public $_id;

    protected $rules = [
        'question'=>['required'],
        'answer'=>['required']
    ];

    protected $listeners = ['setId'];

    public function mount()
    {
        $this->fill([
            'question' => null,
            'answer' => null,
            '_id' => null
        ]);

    }

    public function setId(int $id, string $question, string $answer)
    {
        $this->_id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }
    public function SaveEditFaq()
    {
        $this->validate();
        //fetch the faq to update
        $faq = \App\Models\Faq::find($this->_id);
        $response = $faq->update([
            'question'=>$this->question,
            'answer' => $this->answer
        ]);
        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
        }
        return back();
    }
    public function DeleteFaq(int $id)
    {
        //fetch the faq to update
        $faq = \App\Models\Faq::find($id);
        $faq->delete();
        $this->emit('changes-saved');
        return back();
    }



    public function resetInputFields()
    {
        $this->reset(['answer','question','_id']);
        $this->resetErrorBag();
    }



    public function AddFaq()
    {
        $this->validate();
        $response = \App\Models\Faq::create([
            'question'=> $this->question,
            'answer' => $this->answer
        ]);
        if ($response){
            $this->reset(['question','answer']);
            $this->emit('added');
            return back();
        }else{
            $this->emit('not-added');
            return false;
        }
    }
    public function render()
    {
        $itemList = Cache::remember(CacheKeys::FAQ_CACHE, now()->addDays(30), function (){
            return \App\Models\Faq::get();
        });
        /*
         * Convert the collection to a plain PHP Array
         */
        $arr = $itemList->toArray();
        $items = $this->paginate($arr,10);
        // Set  pagination path/route.
        $items->withPath(route('b-faq'));
        return view('livewire.modules.faq', compact('items'));
    }
}
