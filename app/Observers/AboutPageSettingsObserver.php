<?php

namespace App\Observers;

use App\Models\About;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AboutPageSettingsObserver
{
    public function created(About $about)
    {
        $about->update([
            'slug'=>'about'.'-'. Str::random(8)
        ]);
        if (Cache::has(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE)){
            Cache::forget(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE);
        }
    }

    public function updated(About $about)
    {
        if (Cache::has(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE)){
            Cache::forget(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE);
        }
    }

    public function deleted(About $about)
    {
        if (Cache::has(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE)){
            Cache::forget(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE);
        }
    }

    public function restored(About $about)
    {
        if (Cache::has(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE)){
            Cache::forget(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE);
        }
    }

    public function forceDeleted(About $about)
    {
        if (Cache::has(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE)){
            Cache::forget(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE);
        }
    }
}
