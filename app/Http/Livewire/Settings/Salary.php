<?php

namespace App\Http\Livewire\Settings;

use App\Models\Tax;
use App\Services\CacheKeys;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Salary extends Component
{
    public $hidden;
    public $name;
    public $value;
    public $modalHeader;
    public $mode;
    public $hideModal;
    public $btnText;
    public $taxes;

    protected $rules = [
        'name' => ['required','max:255','string', 'unique:taxes' ],
        'value' => ['required','numeric']
    ];


    public function OpenModal(int $mode = 0, int $id = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        $this->mode = $mode;
        if ($mode === 1){
            $this->hidden = $id;
            $this->modalHeader = 'Update Tax';
            $this->btnText = 'Update';
            //find the tax
            $tax = Tax::find($id);
            $this->name = $tax['name'];
            $this->value = $tax['value'];
        }
    }
    public function CloseModal()
    {
        //$this->hideModal = true;
        $this->reset([
            'hidden',
            'name',
            'value',
            'modalHeader',
            'mode',
            'btnText',
            'hideModal'
        ]);
        $this->mount();
    }

    public function Save()
    {
        $this->validate();
        $response = Tax::create([
            'name'=> $this->name,
            'value' => $this->value
        ]);
        if ($response){
            $this->emit('success','Data added');
            $this->reset([
                'name',
                'value'
            ]);
        }else{
            $this->emit('fail','An error has occurred');
        }

    }
    public function Update()
    {
        $this->validate([
            'name' => ['required','max:255','string', Rule::unique('taxes')->ignore($this->hidden)],
            'value' => ['required','numeric']
        ]);
        //fetch the tax to update
        try {
            $tax = Tax::findOrFail($this->hidden);
           $response = $tax->update([
                'name' => $this->name,
               'value' => $this->value
            ]);
           if ($response){
               $this->emit('success','Data updated successfully');
           }else{
               $this->emit('fail','Something went wrong');
           }
           $this->CloseModal();
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail','Not Found');
        }
    }
    public function Remove(int $id)
    {
        try {
            $tax = Tax::findOrFail($id);
            $tax->delete();
            $this->emit('success','Deleted successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail','Something went wrong');
        }
        $this->mount();
    }

    public function mount()
    {
        $taxes = Cache::remember(CacheKeys::TAX_CACHE, now()->addDays(30), function (){
            return Tax::get();
        });
        $this->fill([
            'value' => null,
            'name' => null,
            'hidden' => null,
            'mode' => 0,
            'modalHeader' => 'New Tax',
            'taxes' => $taxes,
            'hideModal' => true,
            'btnText' => 'Submit',
        ]);
    }
    public function render()
    {
        return view('livewire.settings.salary');
    }
}
