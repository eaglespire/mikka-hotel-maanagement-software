<?php

namespace App\Observers;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        if (Cache::has(CacheKeys::ROLE_CACHE)){
            Cache::forget(CacheKeys::ROLE_CACHE);
        }
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        if (Cache::has(CacheKeys::ROLE_CACHE)){
            Cache::forget(CacheKeys::ROLE_CACHE);
        }
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        if (Cache::has(CacheKeys::ROLE_CACHE)){
            Cache::forget(CacheKeys::ROLE_CACHE);
        }
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
