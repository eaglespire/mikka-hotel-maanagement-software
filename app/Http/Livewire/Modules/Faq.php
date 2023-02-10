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
    public $question;
    public $answer;
    public $list;
    public $hidden;
    public $mode;
    public $modalHeader;
    public $btnText;
    public $hideModal;


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
            'hidden' =>  null,
            'modalHeader' => 'Add new FAQ',
            'mode' => 0,
            'btnText' => 'Save',
            'hideModal' => true
        ]);
    }
    public function OpenModal($mode = 0, $hidden = null)
    {
        $this->resetErrorBag();
         $this->hideModal = false;
        if ($mode == 1){
            $this->hidden = $hidden;
            $faq = \App\Models\Faq::find($this->hidden);
            $this->question = $faq['question'];
            $this->answer = $faq['answer'];
            $this->modalHeader ='Update FAQ';
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
            'question',
            'answer',
        ]);
        $this->mount();
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
            $this->emit('success','Updated successfully');
            $this->mount();
        }else{
            $this->emit('fail','An error occurred');
        }
        return back();
    }
    public function DeleteFaq(int $id)
    {
        //fetch the faq to update
        $faq = \App\Models\Faq::find($id);
        $faq->delete();
        $this->emit('success','Deleted successfully');
        return back();
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
            $this->emit('success','New FAQ Added');
            $this->mount();
        }else{
            $this->emit('fail','An error occurred');
            return back();
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
