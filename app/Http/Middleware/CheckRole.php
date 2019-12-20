<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::user()->role == $role) 
           /* return redirect('user.show', ['username' => Auth::user()->username]);*/
           return $next($request);

        return back();
    }

}
//https://dev.to/kaperskyguru/multiple-role-based-authentication-in-laravel-30pc 