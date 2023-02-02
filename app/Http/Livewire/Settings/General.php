<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Services\CacheKeys;
use App\Traits\HasInternet;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class General extends Component
{
    use HasInternet;
    public $siteName,$frontCopyright,$backCopyright,$header,$currency, $settings;
    protected $rules = [
        'siteName'=>['required','string','max:255'],
        'frontCopyright'=> ['nullable','string','max:255'],
        'backCopyright'=> ['nullable','string','max:255'],
        'header'=> ['nullable','string','max:255'],
        'currency'=> ['nullable'],
    ];
    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'siteName' => $this->settings['siteName'] ?? null,
            'frontCopyright' => $this->settings['frontCopyright'] ?? null,
            'backCopyright' => $this->settings['backCopyright'] ?? null,
            'header' => $this->settings['siteHeaderInfo'] ?? null,
            'currency' => $this->settings['currency'] ?? null
            ]);
    }
    public function SaveChanges()
    {
        if ($this->ConnectedToInternet()){
            $this->validate();
            $response = null;
            if ($this->settings === null){
                $response =  Setting::create([
                    'siteName' => $this->siteName,
                    'frontCopyright' => $this->frontCopyright,
                    'backCopyright' => $this->backCopyright,
                    'siteHeaderInfo' => $this->header,
                    'currency' => $this->currency
                ]);
            }else{
                $response = $this->settings->update([
                    'siteName' => $this->siteName,
                    'frontCopyright' => $this->frontCopyright,
                    'backCopyright' => $this->backCopyright,
                    'siteHeaderInfo' => $this->header,
                    'currency' => $this->currency
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
            return back();
        } else{
            $this->emit('no-internet');
        }
    }
    public function render()
    {
        return view('livewire.settings.general');
    }
}
