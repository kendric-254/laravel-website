<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSystemUpdatePermission
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('system-update')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have permission to perform this action.');
    }
}
