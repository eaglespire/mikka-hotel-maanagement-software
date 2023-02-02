<?php

namespace App\Http\Middleware;

use App\Services\Constant;
use Closure;
use Illuminate\Http\Request;

class ScreenLockMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && $request->session()->has(Constant::SCREEN_LOCK)){
            return redirect(route('lock-screen'));
        }
        return $next($request);
    }
}
