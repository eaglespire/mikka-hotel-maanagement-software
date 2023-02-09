<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;


trait RolesCacheTrait
{
    public function cachedRoles()
    {
        return Cache::remember('roleCache',now()->addDays(30), function (){
            return Role::where('id','>',1)->get();
        });
    }
}
