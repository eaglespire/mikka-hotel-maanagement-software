<?php

namespace App\Observers;

use App\Models\Setting;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    public function created(Setting $setting)
    {
        if (Cache::has(CacheKeys::SETTING_CACHE)){
            Cache::forget(CacheKeys::SETTING_CACHE);
        }
    }

    public function updated(Setting $setting)
    {
        if (Cache::has(CacheKeys::SETTING_CACHE)){
            Cache::forget(CacheKeys::SETTING_CACHE);
        }
    }

    public function deleted(Setting $setting)
    {
        if (Cache::has(CacheKeys::SETTING_CACHE)){
            Cache::forget(CacheKeys::SETTING_CACHE);
        }
    }

    public function restored(Setting $setting)
    {
    }

    public function forceDeleted(Setting $setting)
    {
    }
}
