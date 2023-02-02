<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use App\Services\CacheKeys;

class EventObserver
{
    public function created(Event $event)
    {
        if (Cache::has(CacheKeys::EVENT_CACHE)){
            Cache::forget(CacheKeys::EVENT_CACHE);
        }
    }

    public function updated(Event $event)
    {
        if (Cache::has(CacheKeys::EVENT_CACHE)){
            Cache::forget(CacheKeys::EVENT_CACHE);
        }
    }

    public function deleted(Event $event)
    {
        if (Cache::has(CacheKeys::EVENT_CACHE)){
            Cache::forget(CacheKeys::EVENT_CACHE);
        }
    }

    public function restored(Event $event)
    {
    }

    public function forceDeleted(Event $event)
    {
    }
}
