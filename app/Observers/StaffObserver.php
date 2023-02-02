<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\HasStaffInfo;
use Illuminate\Support\Facades\Cache;

class StaffObserver
{
    use HasStaffInfo;
    private string $cacheKey = "staffCache";



    private function buildCache(): void
    {
        Cache::remember($this->cacheKey, now()->addDays(30), function () {
            return User::where('id', '>', 1)->get();
        });
    }
    private function clearCache(): void
    {
        if (Cache::has($this->cacheKey))
        {
            Cache::forget($this->cacheKey);
        }
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
