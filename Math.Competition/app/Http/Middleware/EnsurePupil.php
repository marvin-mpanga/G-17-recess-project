<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsurePupil
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and is a pupil
        if (Auth::check() && Auth::user()->is_pupil) {
            return $next($request);
        }

        // Redirect or deny access if the user is not a pupil
        return redirect('/welcome');
    }
}
