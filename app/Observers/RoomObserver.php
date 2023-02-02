<?php

namespace App\Observers;

use App\Models\Room;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class RoomObserver
{
    public function created(Room $room)
    {
        if (Cache::has(CacheKeys::ROOM_CACHE)){
            Cache::forget(CacheKeys::ROOM_CACHE);
        }
    }

    public function updated(Room $room)
    {
        if (Cache::has(CacheKeys::ROOM_CACHE)){
            Cache::forget(CacheKeys::ROOM_CACHE);
        }
    }

    public function deleted(Room $room)
    {
        if (Cache::has(CacheKeys::ROOM_CACHE)){
            Cache::forget(CacheKeys::ROOM_CACHE);
        }
    }

    public function restored(Room $room)
    {
    }

    public function forceDeleted(Room $room)
    {
    }
}
