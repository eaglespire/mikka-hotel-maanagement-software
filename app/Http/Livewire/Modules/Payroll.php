<?php

namespace App\Http\Livewire\Modules;

use App\Models\User;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Payroll extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $modalHeader;
    public $hidden;
    public $mode;
    public $hideModal;
    public $user_id;
    public $amount;
    public $employees;

    public function OpenModal($mode = 0, $hidden = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        $this->mode = $mode;
        if ($mode == 1){
            $this->hidden = $hidden;
            $data = \App\Models\Payroll::find($this->hidden);
            $this->amount = $data->amount;
            $this->user_id = $data->user_id;
            $this->modalHeader = 'Update Payroll Data';
        }
    }
    public function CloseModal()
    {
        $this->reset([
            'amount',
            'user_id',
            'modalHeader',
            'mode',
            'hidden',
            'hideModal',
        ]);
        $this->mount();
    }

    public function mount()
    {
        $this->employees = Cache::remember(CacheKeys::USERS_PAYROLL_DATA_CACHE, now()->addDays(30), function (){
            return User::orderBy('id','asc')->select('id','firstname','lastname','staff_identity')->where('id','!=',1)->get();
        });
        //dd($this->employees);
        $this->fill([
            'hidden' => null,
            'mode' => 0,
            'modalHeader' => 'Add new payroll',
            'hideModal' => true,
            'user_id' => $this->employees ? $this->employees[0]['id'] : null,
            'amount' => null,
        ]);
    }
    public function Save()
    {
        $this->validate([
            'amount'=>['required','min:1','numeric'],
            'user_id' => ['required','unique:payrolls']
        ]);
        $response = \App\Models\Payroll::create([
            'user_id'=>$this->user_id,
            'amount'=>$this->amount
        ]);
        if ($response){
            $this->emit('success','Data added');
            $this->reset(['user_id','amount']);
            $this->CloseModal();
        }else{
            $this->emit('fail','Something went wrong');
        }
    }
    public function render()
    {
        $data['payrolls'] = \App\Models\Payroll::paginate(10);
        return view('livewire.modules.payroll',$data);
    }
}
