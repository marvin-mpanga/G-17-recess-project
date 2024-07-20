<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureRepresentative
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and is a representative
        if (Auth::check() && Auth::user()->is_representative) {
            return $next($request);
        }

        // Redirect or deny access if the user is not a representative
        return redirect('/welcome'); // Adjust this to your preferred route
    }
}
