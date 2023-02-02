<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Services\CacheKeys;
use App\Traits\HasInternet;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Social extends Component
{
    use HasInternet;
    public $facebookID,$twitterID,$instagramID,$linkedinID,$whatsapp,$youtubeID, $settings;
    protected $rules = [
        'facebookID'=>['nullable','string','max:255'],
        'twitterID'=> ['nullable','string','max:255'],
        'instagramID'=> ['nullable','string','max:255'],
        'linkedinID'=> ['nullable','string','max:255'],
        'youtubeID'=> ['nullable','string','max:255'],
        'whatsapp'=> ['nullable','string','max:255'],
    ];
    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'facebookID' => $this->settings['facebookID'] ?? null,
            'twitterID' => $this->settings['twitterID'] ?? null,
            'youtubeID' => $this->settings['youtubeID'] ?? null,
            'instagramID' => $this->settings['instagramID'] ?? null,
            'linkedinID' => $this->settings['linkedinID'] ?? null,
            'whatsapp' => $this->settings['whatsapp'] ?? null
        ]);
    }
    public function SaveChanges()
    {
        if ($this->ConnectedToInternet()){
            $this->validate();
            $response = null;
            if ($this->settings === null){
                $response =  Setting::create([
                    'facebookID' => $this->facebookID,
                    'twitterID' => $this->twitterID,
                    'instagramID' => $this->instagramID,
                    'linkedinID' => $this->linkedinID,
                    'youtubeID' => $this->youtubeID,
                    'whatsapp' => $this->whatsapp,
                ]);
            }else{
                $response = $this->settings->update([
                    'facebookID' => $this->facebookID,
                    'twitterID' => $this->twitterID,
                    'instagramID' => $this->instagramID,
                    'linkedinID' => $this->linkedinID,
                    'youtubeID' => $this->youtubeID,
                    'whatsapp' => $this->whatsapp,
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
            return back();
        }else{
            $this->emit('no-internet');
        }
    }
    public function render()
    {
        return view('livewire.settings.social');
    }
}
