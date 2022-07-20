<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class SetUUID
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->hasCookie('uuid')) {
            Cookie::queue(Cookie::forever('uuid', Str::uuid()));
        }

        return $next($request);
    }
}
