<?php

namespace App\Observers;

use App\Models\Postcategory;
use App\Services\CacheKeys;
use Illuminate\Support\Facades\Cache;

class PostCategoryObserver
{
    public function created(Postcategory $postcategory)
    {
        if (Cache::has(CacheKeys::POST_CATEGORY_CACHE)){
            Cache::forget(CacheKeys::POST_CATEGORY_CACHE);
        }
    }

    public function updated(Postcategory $postcategory)
    {
        if (Cache::has(CacheKeys::POST_CATEGORY_CACHE)){
            Cache::forget(CacheKeys::POST_CATEGORY_CACHE);
        }
    }

    public function deleted(Postcategory $postcategory)
    {
        if (Cache::has(CacheKeys::POST_CATEGORY_CACHE)){
            Cache::forget(CacheKeys::POST_CATEGORY_CACHE);
        }
    }

    public function restored(Postcategory $postcategory)
    {
    }

    public function forceDeleted(Postcategory $postcategory)
    {
    }
}
