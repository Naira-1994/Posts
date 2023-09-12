<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuest
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
