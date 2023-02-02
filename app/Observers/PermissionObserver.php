<?php

namespace App\Observers;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class PermissionObserver
{
    private function clearCache(): void
    {
        if (Cache::has(CacheKeys::PERMISSIONS_CACHE))
        {
            Cache::forget(CacheKeys::PERMISSIONS_CACHE);
        }
    }
    private function buildCache(): void
    {
        Cache::remember(CacheKeys::PERMISSIONS_CACHE,now()->addDays(30),function (){
            return Permission::get();
        });
    }
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        $this->clearCache();
        $this->buildCache();
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        $this->clearCache();
        $this->buildCache();
    }
}
