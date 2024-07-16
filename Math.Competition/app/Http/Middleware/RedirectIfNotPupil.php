<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotPupil
{
    public function handle($request, Closure $next, $guard = 'pupil')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('pupil.login');
        }

        return $next($request);
    }
}