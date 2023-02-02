<?php

namespace App\Observers;

use App\Models\Faq;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class FaqObserver
{
    public function created(Faq $faq)
    {
        if (Cache::has(CacheKeys::FAQ_CACHE)){
            Cache::forget(CacheKeys::FAQ_CACHE);
        }
    }

    public function updated(Faq $faq)
    {
        if (Cache::has(CacheKeys::FAQ_CACHE)){
            Cache::forget(CacheKeys::FAQ_CACHE);
        }
    }

    public function deleted(Faq$faq)
    {
        if (Cache::has(CacheKeys::FAQ_CACHE)){
            Cache::forget(CacheKeys::FAQ_CACHE);
        }
    }

    public function restored(Faq $faq)
    {
    }

    public function forceDeleted(Faq $faq)
    {
    }
}
