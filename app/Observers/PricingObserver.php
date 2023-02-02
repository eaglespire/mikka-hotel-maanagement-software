<?php

namespace App\Observers;

use App\Models\Pricing;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PricingObserver
{
    public function created(Pricing $pricing)
    {
        if (Cache::has(CacheKeys::PRICING_CACHE)){
            Cache::forget(CacheKeys::PRICING_CACHE);
        }
        if (Cache::has(CacheKeys::FIRST_PRICING_CACHE)){
            Cache::forget(CacheKeys::FIRST_PRICING_CACHE);
        }
        $pricing->update([
            'slug'=>Str::slug(Str::random(4))
        ]);
    }

    public function updated(Pricing $pricing)
    {
        if (Cache::has(CacheKeys::PRICING_CACHE)){
            Cache::forget(CacheKeys::PRICING_CACHE);
        }
        if (Cache::has(CacheKeys::FIRST_PRICING_CACHE)){
            Cache::forget(CacheKeys::FIRST_PRICING_CACHE);
        }
    }

    public function deleted(Pricing $pricing)
    {
        if (Cache::has(CacheKeys::PRICING_CACHE)){
            Cache::forget(CacheKeys::PRICING_CACHE);
        }
        if (Cache::has(CacheKeys::FIRST_PRICING_CACHE)){
            Cache::forget(CacheKeys::FIRST_PRICING_CACHE);
        }
    }

    public function restored(Pricing $pricing)
    {
        if (Cache::has(CacheKeys::PRICING_CACHE)){
            Cache::forget(CacheKeys::PRICING_CACHE);
        }
    }

    public function forceDeleted(Pricing $pricing)
    {
        if (Cache::has(CacheKeys::PRICING_CACHE)){
            Cache::forget(CacheKeys::PRICING_CACHE);
        }
    }
}
