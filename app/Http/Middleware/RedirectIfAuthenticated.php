<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    /*
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
*/
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (auth()->user->getRole() == 'admin') {
                return redirect('/admin');
            }
            if (auth()->user->getRole() == 'user') {
                return redirect('/home');
            }
            else{
                return redirect('/');
            }
        }
    
        return $next($request);
    }

}
