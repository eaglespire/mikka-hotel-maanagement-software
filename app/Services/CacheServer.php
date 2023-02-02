<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheServer
{
    //to be used for creating and updating
    public function store($model,$key): bool
    {
        //call the database server
        if (Cache::has($key))
        {
            $cachedRoles = Cache::get($key);//this will be an array
//            if (in_array($model, $cachedRoles))
//            {
//                unset($cachedRoles[$model]);
//            }
            $cachedRoles[] = $model;
            Cache::put($key, $cachedRoles);
            return true;
        }
        return false;
    }
    public function retrieveAll(string $key, string $modelName)
    {
        $upperCasedModel = ucfirst($modelName);
        $model = app("App\\Models\\$upperCasedModel");
        return Cache::remember($key,now()->addDays(90),function () use ($model) {
            return $model::get();
        } );
    }
    public function paginatedData(string $key, string $modelName)
    {
        $upperCasedModel = ucfirst($modelName);
        $model = app("App\\Models\\$upperCasedModel");
        return Cache::remember($key,now()->addDays(90),function () use ($model) {
            return $model::paginate(3);
        } );
    }
    public function retrieve(string $key, int $id)
    {
        if (Cache::has($key)){
            $allData = Cache::get($key);
            return $allData[$id];
        }
        return null;
    }
    public function removeSingleItem(string $key, int $id): ?bool
    {
        if (Cache::has($key)){
           // dd($key);
            $allData = Cache::get($key);
            //dd($allData);
            $filteredArray = array_filter($allData, function ($v,$k) use($id){
              // dd($id);
                return $id !== $k;
            },ARRAY_FILTER_USE_BOTH);
            //dd($filteredArray);
            Cache::put($key, $filteredArray);
            return true;
        }
        return null;
    }
    public function updateCacheItem(string $key, $value) : bool
    {
        if (Cache::has($key)){
            Cache::put($key,$value);
            return true;
        }
        return false;
    }

}
