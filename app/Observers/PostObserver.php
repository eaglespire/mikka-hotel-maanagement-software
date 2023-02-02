<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function created(Post $post)
    {
        if (Cache::has(CacheKeys::POST_CACHE)){
            Cache::forget(CacheKeys::POST_CACHE);
        }
    }

    public function updated(Post $post)
    {
        if (Cache::has(CacheKeys::POST_CACHE)){
            Cache::forget(CacheKeys::POST_CACHE);
        }
    }

    public function deleted(Post $post)
    {
        if (Cache::has(CacheKeys::POST_CACHE)){
            Cache::forget(CacheKeys::POST_CACHE);
        }
    }

    public function restored(Post $post)
    {
    }

    public function forceDeleted(Post $post)
    {
    }
}
