<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class landing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //Si se intenta acceder a la landing page tendŕa que ser sin estar logueado
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'admin')
                return redirect()->route('admin.admin');
            if (Auth::user()->role == 'user')
                return redirect()->route('user.home');
        }
        return $next($request);
    }
}
