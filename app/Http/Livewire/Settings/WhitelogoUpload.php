<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Services\CacheKeys;
use App\Traits\HasInternet;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class WhitelogoUpload extends Component
{
    use WithFileUploads, HasInternet;
    public $settings,$whiteLogo,$logo;

    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'whiteLogo' => $this->settings['whiteLogo'] ?? null,
            'logo' => null
        ]);
    }
    public function updatedLogo()
    {
        $this->validate([
            'logo'=>['required','image','max:1024']
        ]);
    }
    public function SaveChanges()
    {
        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $logoUrl = Cloudinary::upload($this->logo->getRealPath(), [
                'folder'=>'site',
                'transformation'=>[
                    'width'=>520,
                    'height'=>80,
                    'crop' => 'fit',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'whiteLogo'=> $logoUrl
                ]);
            }else{
                $response = $this->settings->update([
                    'whiteLogo'=> $logoUrl
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
        return view('livewire.settings.whitelogo-upload');
    }
}
