<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Feature;
use Livewire\Component;


class AddFeature extends Component
{
    public $feature = null;
    public $icon = null;

    protected $listeners = ['iconAdded'];
    public function iconAdded($icon)
    {
        //dd('This was fired');
        //dd($icon);
        $this->icon = $icon;
    }
    public function submit()
    {
        $this->validate([
            'feature'=>'required',
            'icon'=>'required'
        ]);
        $newFeature = Feature::create([
            'name' => $this->feature,
            'icon' => $this->icon
        ]);
        //dd($this->feature,$this->icon);
        if ($newFeature){
            $this->dispatchBrowserEvent('success');
            $this->icon = null;
            $this->feature = null;
        }else{
            alert('error','An error has occurred');
        }
        return back();
    }
    public function render()
    {
        //alert('success','Hello');
        return view('livewire.add-feature');
    }
}
