<?php

namespace App\Http\Livewire\Modules;

use App\Models\Feature;
use App\Models\FeaturePricing;
use App\Services\CacheKeys;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class RoomCategory extends Component
{
    public $title;
    public $subtitle;
    public $tag;
    public $mode;
    public $pricing;
    public $hideModal;
    public $hidden;
    public $features;
    public $roomFeatures;
    public $modalHeader;

    protected $listeners = ['clear-errors'=> 'ClearErrors',];

    protected $rules = [
        'title'=>['required','string','max:255'],
        'subtitle'=>['nullable','string','max:255'],
        'tag'=>['nullable','string','max:40']
    ];
    public function mount()
    {
        $this->pricing = Cache::remember(CacheKeys::PRICING_CACHE,now()->addDays(30), function (){
            return \App\Models\Pricing::get();
        });

        $roomFeatures = Cache::remember(CacheKeys::FEATURE_CACHE, now()->addDays(30), function (){
            return Feature::get();
        });
        //get the first row from the database and retrieve the image
        $this->fill([
            'title' => null,
            'subtitle' => null,
            'tag' => null,
            'hideModal' => true,
            'hidden'=>null,
            'features' => [],
            'roomFeatures' => $roomFeatures,
            'mode' => 0,
            'modalHeader' => 'Add New Room Category'
        ]);
    }
    public function SavePricingData()
    {
        $this->validate();
        $response  = \App\Models\Pricing::create([
            'title'=>$this->title,
            'subtitle' => $this->subtitle,
            'tag' => $this->tag,
        ]);
        if ($response){
            //save the features selected to the database
            for ($i = 0; $i < count($this->features); $i++){
                FeaturePricing::create([
                    'feature_id'=>$this->features[$i],
                    'pricing_id'=> $response->id
                ]);
            }
            $this->reset(['title','subtitle','tag']);
            $this->emit('success');
            $this->mount();
        }else{
            $this->emit('fail');
        }

    }

    public function UpdatePricing()
    {
        //validate the date
        $this->validate();
        //Get the pricing model to update
        $pricing = \App\Models\Pricing::find($this->hidden);
        $response = $pricing->update([
            'title'=>$this->title,
            'subtitle'=>$this->subtitle,
            'tag'=>$this->tag,
        ]);

        if ($response){
            $this->emit('success');
        }else{
            $this->emit('fail');
        }
        $this->mount();
    }
    public function DeletePricing(int $id)
    {
        //find the pricing
        try {
            $pricing = \App\Models\Pricing::findOrFail($id);
            $pricing->delete();
            $this->emit('success');
            $this->mount();
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('fail');
        }
    }
    public function OpenModal($mode = 0, $hidden = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        $this->mode = $mode;
        if ($mode === 1){
            $this->hidden = $hidden;
            //update mode
            $this->modalHeader = 'Update This Category';
            $pricing = \App\Models\Pricing::find($this->hidden);
            $this->title = $pricing->title;
            $this->subtitle = $pricing->subtitle;
            $this->tag = $pricing->tag;
        }
    }
    public function CloseModal()
    {
        $this->reset([
            'title',
            'subtitle',
            'hidden',
            'modalHeader',
            'mode',
            'hideModal',
            'tag',
        ]);
        $this->mount();
    }


    public function render()
    {
        return view('livewire.modules.room-category');
    }

}
