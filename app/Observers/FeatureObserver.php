<?php

namespace App\Observers;

use App\Models\Feature;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class FeatureObserver
{
    public function created(Feature $feature)
    {
        if (Cache::has(CacheKeys::FEATURE_CACHE))
        {
            Cache::forget(CacheKeys::FEATURE_CACHE);
        }
    }

    public function updated(Feature $feature)
    {
        if (Cache::has(CacheKeys::FEATURE_CACHE))
        {
            Cache::forget(CacheKeys::FEATURE_CACHE);
        }
    }

    public function deleted(Feature $feature)
    {
        if (Cache::has(CacheKeys::FEATURE_CACHE))
        {
            Cache::forget(CacheKeys::FEATURE_CACHE);
        }
    }

    public function restored(Feature $feature)
    {
    }

    public function forceDeleted(Feature $feature)
    {
    }
}
