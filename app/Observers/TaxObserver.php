<?php

namespace App\Observers;

use App\Models\Tax;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class TaxObserver
{
    public function created(Tax $tax)
    {
        if (Cache::has(CacheKeys::TAX_CACHE)){
            Cache::forget(CacheKeys::TAX_CACHE);
        }
    }

    public function updated(Tax $tax)
    {
        if (Cache::has(CacheKeys::TAX_CACHE)){
            Cache::forget(CacheKeys::TAX_CACHE);
        }
    }

    public function deleted(Tax $tax)
    {
        if (Cache::has(CacheKeys::TAX_CACHE)){
            Cache::forget(CacheKeys::TAX_CACHE);
        }
    }

    public function restored(Tax $tax)
    {
    }

    public function forceDeleted(Tax $tax)
    {
    }
}
