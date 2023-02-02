<?php

namespace App\Jobs;

use App\Mail\EmailOtp;
use App\Models\UpdateAdminPassword;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = md5(microtime());
        UpdateAdminPassword::create([
            'token'=>$token,
            'email'=>$this->user->email,
        ]);
        // Send an email otp to this user
        Mail::to($this->user->email)->send(new EmailOtp($this->user,$token));
    }

}
