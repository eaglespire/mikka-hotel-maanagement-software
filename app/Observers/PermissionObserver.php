<?php

namespace App\Observers;
use App\Models\Permission;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;


class PermissionObserver
{


    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        if (Cache::has(CacheKeys::PERMISSIONS_CACHE))
        {
            Cache::forget(CacheKeys::PERMISSIONS_CACHE);
        }
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        if (Cache::has(CacheKeys::PERMISSIONS_CACHE))
        {
            Cache::forget(CacheKeys::PERMISSIONS_CACHE);
        }
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        if (Cache::has(CacheKeys::PERMISSIONS_CACHE))
        {
            Cache::forget(CacheKeys::PERMISSIONS_CACHE);
        }
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {

    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {

    }
}
