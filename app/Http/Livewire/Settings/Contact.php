<?php /** @noinspection DuplicatedCode */

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Services\CacheKeys;
use App\Traits\HasInternet;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Contact extends Component
{
    use HasInternet;
    public $firstPhoneNumber,$secondPhoneNumber,$firstAddress,$secondAddress,$firstEmail,$secondEmail, $settings;
    protected $rules = [
        'firstPhoneNumber'=>['nullable','string','max:255'],
        'secondPhoneNumber'=> ['nullable','string','max:255'],
        'firstAddress'=> ['nullable','string','max:255'],
        'secondAddress'=> ['nullable','string','max:255'],
        'firstEmail'=> ['nullable','email','max:255'],
        'secondEmail'=> ['nullable','email','max:255'],
    ];
    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'firstPhoneNumber' => $this->settings['firstPhoneNumber'] ?? null,
            'secondPhoneNumber' => $this->settings['secondPhoneNumber'] ?? null,
            'firstAddress' => $this->settings['firstAddress'] ?? null,
            'secondAddress' => $this->settings['secondAddress'] ?? null,
            'firstEmail' => $this->settings['firstEmail'] ?? null,
            'secondEmail' => $this->settings['secondEmail'] ?? null
        ]);
    }
    public function SaveChanges()
    {
        if ($this->ConnectedToInternet()){
            $this->validate();
            $response = null;
            if ($this->settings === null){
                $response =  Setting::create([
                    'firstPhoneNumber' => $this->firstPhoneNumber,
                    'secondPhoneNumber' => $this->secondPhoneNumber,
                    'firstAddress' => $this->firstAddress,
                    'secondAddress' => $this->secondAddress,
                    'firstEmail' => $this->firstEmail,
                    'secondEmail' => $this->secondEmail,
                ]);
            }else{
                $response = $this->settings->update([
                    'firstPhoneNumber' => $this->firstPhoneNumber,
                    'secondPhoneNumber' => $this->secondPhoneNumber,
                    'firstAddress' => $this->firstAddress,
                    'secondAddress' => $this->secondAddress,
                    'firstEmail' => $this->firstEmail,
                    'secondEmail' => $this->secondEmail,
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
        return view('livewire.settings.contact');
    }
}
