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

class Pricing extends Component
{
    use WithFileUploads;
    public $title,$subtitle,$tag,$price,$url,$image,$displayImage,$header,$mode;
    public $pricing, $item, $iteration;
    public $hideModal,$hidden,$features,$roomFeatures;

    protected $listeners = ['clear-errors'=> 'ClearErrors',];

    protected $rules = [
        'title'=>['required','string','max:255'],
        'subtitle'=>['required','string','max:255'],
        'url'=>['required','string'],
        'price'=>['required','numeric'],
        'tag'=>['required','string','max:40']
    ];
    public function mount()
    {
        $this->pricing = Cache::remember(CacheKeys::PRICING_CACHE,now()->addDays(30), function (){
            $collection =  \App\Models\Pricing::get();
            $newCollection = $collection->skip(1);
            return $newCollection->sortBy('created_at')->all();
        });

        $this->item = Cache::remember(CacheKeys::FIRST_PRICING_CACHE, now()->addDays(30), function (){
            return \App\Models\Pricing::first();
        });
        $roomFeatures = Cache::remember(CacheKeys::FEATURE_CACHE, now()->addDays(30), function (){
            return Feature::get();
        });
        //get the first row from the database and retrieve the image
        $this->fill([
            'title' => null,
            'subtitle' => null,
            'tag' => null,
            'price' => null,
            'url' => '/',
            'image' => null,
            'displayImage' => $this->item ? $this->item['image'] : null,
            'hideModal' => true,
            'hidden'=>null,
            'features' => [],
            'roomFeatures' => $roomFeatures,
            'mode' => null
        ]);
    }
    public function SavePricingData()
    {
        $this->validate();
        $response  = \App\Models\Pricing::create([
            'title'=>$this->title,
            'subtitle' => $this->subtitle,
            'url' => $this->url,
            'tag' => $this->tag,
            'price' => $this->price
        ]);
        if ($response){
            //save the features selected to the database
            for ($i = 0; $i < count($this->features); $i++){
                FeaturePricing::create([
                    'feature_id'=>$this->features[$i],
                    'pricing_id'=> $response->id
                ]);
            }
            $this->reset(['title','subtitle','url','tag','price']);
            $this->emit('changes-saved');
            $this->mount();
            $this->render();
        }else{
            $this->emit('changes-not-saved');
        }

    }
    public function UploadImage()
    {
        $this->validate([
            'image'=>['required','image','max:1024']
        ]);
        $response = null;
        //upload
        $url = Cloudinary::upload($this->image->getRealPath(), [
            'folder'=>'site',
            'transformation'=>[
                'width'=>1920,
                'crop' => 'fit',
            ]
        ])->getSecurePath();
        if ( empty($this->displayImage)){
            $response = \App\Models\Pricing::create([
                'image'=> $url
            ]);
        }else{
            $response = $this->item->update([
                'image'=>$url
            ]);
        }
        $this->image = null;
        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
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
            'price'=>$this->price,
            'url'=>$this->url
        ]);


        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
        }
        $this->mount();
        $this->render();
    }
    public function DeletePricing(int $id)
    {
        //find the pricing
        try {
            $pricing = \App\Models\Pricing::findOrFail($id);
            $pricing->delete();
            $this->emit('changes-saved');
            $this->mount();
            $this->render();
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('changes-not-saved');
        }
    }
    public function OpenModal(int $mode, int $id = null)
    {
        //possible values of mode are null, 0 and 1
        //null is the initial value when livewire renders
        if ($mode === 0){
            //create mode
            $this->header = 'New Pricing';
        }
        if ($mode === 1){
            //update mode
            $this->header = 'Update Pricing';
            $pricing = \App\Models\Pricing::find($id);
            $this->title = $pricing->title;
            $this->subtitle = $pricing->subtitle;
            $this->tag = $pricing->tag;
            $this->url = $pricing->url;
            $this->price = $pricing->price;

            $this->hidden = $pricing->id;
        }
        $this->hideModal = false;
        $this->mode = $mode;
    }
    public function CloseModal()
    {
        $this->hideModal = true;
        $this->mount();
    }


    public function render()
    {
        return view('livewire.modules.pricing');
    }

}
