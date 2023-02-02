<?php

namespace App\Http\Livewire\Dashboard;

use App\Jobs\SendEmailOtp;
use App\Models\UpdateAdminPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ChangePassword extends Component
{
    public $emailOtp,$showEmailOtpField,
        $currentPassword, $showCurrentPasswordField,
        $newPassword, $confirmPassword,$showNewPasswordField;

    public function mount()
    {
        $this->fill([
            'emailOtp' =>'',
            'showEmailOtpField' => false,
            'currentPassword' => '',
            'newPassword' => '',
            'confirmPassword' => '',
            'showNewPasswordField' => false,
            'showCurrentPasswordField'=>true,
        ]);
    }
    public function SendOTP()
    {
        $this->validate([
            'currentPassword'=>['required']
        ]);
        //get the user
        $user = auth()->user();
        /*
         * Check if the provided current password matches with what is on the
         * database
         */
        if (Hash::check($this->currentPassword,$user->password))
        {
            //password matches, therefore send the email otp
            SendEmailOtp::dispatch($user);
            //notify the user that an email otp has been sent
            $this->emit('otp-sent');
        }else{
            $this->emit('current-password-error');
        }
        $this->reset(['currentPassword']);
        return back();
    }
    public function SubmitOTP()
    {
        $this->validate(['emailOtp'=>['required']]);
        /*
         * Fetch the otp from the database
         */
        $otp = UpdateAdminPassword::latest()
            ->where('email', auth()->user()->email)
            ->where('token', $this->emailOtp)
            ->first();
        //check to see if the otp is still valid
        $otpValidity = $otp?->created_at->addMinutes(5);

        if ($otp?->token !== $this->emailOtp)
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
        $this->reset(['emailOtp']);
        return back();
    }
    public function updatePassword()
    {
        $this->validate([
            'newPassword'=>['required','min:8','max:40'],
            'confirmPassword'=>['required','same:newPassword']
        ]);
        $response = auth()->user()->update([
            'password' => Hash::make($this->newPassword),
            'password_text' => $this->newPassword
        ]);
        if ($response)
        {
            $this->reset(['newPassword','confirmPassword']);
            $this->emit('password-change-success');
        }else{
            $this->emit('password-change-error');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.dashboard.change-password');
    }
}
