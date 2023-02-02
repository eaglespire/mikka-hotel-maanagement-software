<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Services\CacheKeys;
use App\Traits\HasInternet;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class FaviconUpload extends Component
{
    use WithFileUploads, HasInternet;
    public $settings,$favicon,$newFavicon;

    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'newFavicon' => $this->settings['favicon'] ?? null,
            'favicon' => null
        ]);
    }
    public function updatedFavicon()
    {
        $this->validate([
            'favicon'=>['required','mimes:ico,png,jpg,jpeg,JPG,PNG','max:100']
        ]);
    }
    public function SaveChanges()
    {
        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $faviconUrl = Cloudinary::upload($this->favicon->getRealPath(), [
                'folder'=>'site',
                'transformation'=>[
                    'width'=>128,
                    'height'=>128,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'favicon'=> $faviconUrl
                ]);
            }else{
                $response = $this->settings->update([
                    'favicon'=> $faviconUrl
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
            $this->mount();
            $this->render();
            return back();
        }else{
            $this->emit('no-internet');
        }
    }
    public function render()
    {
        return view('livewire.settings.favicon-upload');
    }
}
