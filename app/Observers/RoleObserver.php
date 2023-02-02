<?php

namespace App\Observers;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class RoleObserver
{
    private string $cacheKey = "roleCache";
    private function buildCache(): void
    {
        Cache::remember($this->cacheKey, now()->addDays(30), function () {
            return Role::where('id', '>', 1)->get();
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
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
