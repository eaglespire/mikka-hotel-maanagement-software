<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolePermissionMiddleware
{
    public function handle(Request $request, Closure $next, $role = null, $permission = null)
    {
        if ($role !== null && !auth()->user()->hasRole($role)){
            abort(404);
        }
        if ($permission !== null && !auth()->user()->can($permission)){
            abort(404);
        }
        return $next($request);
    }
}
