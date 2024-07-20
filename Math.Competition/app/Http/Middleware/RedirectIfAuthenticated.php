<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route($this->redirectTo($guard));
        }

        return $next($request);
    }

    protected function redirectTo($guard)
    {
        switch ($guard) {
            case 'admin':
                return 'admin.dashboard';
            case 'pupil':
                return 'pupil.dashboard';
            case 'representative':
                return 'schoolRep.dashboard';
            default:
                return 'home';
        }
    }
}


