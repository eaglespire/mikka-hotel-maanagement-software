<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

trait RolesCacheTrait
{
    public function cachedRoles()
    {
        return Cache::remember('roleCache',now()->addDays(30), function (){
            return Role::where('id','>',1)->get();
        });
    }
}
