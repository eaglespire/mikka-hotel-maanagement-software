<?php

namespace App\Http\Livewire\Dashboard;

use App\Jobs\SendMainEmailOtp;
use App\Models\UpdateAdminPassword;
use Livewire\Component;

class ChangeEmail extends Component
{
    public $disableEmailField,$otp,$showOTPField,$commenceProcess,
        $email,$showChangeEmailField,$confirmEmail;
    public function mount()
    {
         $this->fill([
             'disableEmailField' => true,
             'otp' => null,
             'showOTPField' => false,
             'commenceProcess' => true,
             'email' => null,
             'showChangeEmailField' => false,
             'confirmEmail' => null
         ]);
    }
    public function SendOtp()
    {
        //send an otp to the registered email
        SendMainEmailOtp::dispatch(auth()->user());
    }
    public function SubmitOTP()
    {
        $this->validate(['otp'=>['required','string']]);
        /*
        * Fetch the otp from the database
        */
        $emailOtp = UpdateAdminPassword::latest()
            ->where('email', auth()->user()->email)
            ->where('token', $this->otp)
            ->first();
        //check to see if the otp is still valid
        $otpValidity = $emailOtp?->created_at->addMinutes(5);

        if ($emailOtp?->token !== $this->otp)
        {
            //otp is invalid
            $this->emit('otp-is-invalid');
            return false;
        }
        if(now()->gt($otpValidity))
        {
            //otp is now invalid
            $this->emit('otp-is-invalid');
            return false;
        }else{
            //otp is valid
            $this->emit('otp-is-valid');
        }
        $this->reset(['otp']);
        return back();
    }
    public function UpdateEmail()
    {
         $this->validate([
             'email'=>['required','unique:users','email','max:255'],
             'confirmEmail'=>['required','same:email']
         ]);
        $response = auth()->user()->update(['email' => $this->email]);
        if ($response)
        {
            $this->reset(['email','confirmEmail']);
            $this->emit('email-change-success');
        }else{
            $this->emit('email-change-error');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.dashboard.change-email');
    }
}
