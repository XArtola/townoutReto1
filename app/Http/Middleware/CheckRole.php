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

        if ($role === "user" && Auth::user()->is_Admin==0)
           /* return redirect('user.show', ['username' => Auth::user()->username]);*/
            return \Redirect::route('user.show', [Auth::user()->username]);

        else if ($role === "admin" && $request->user()->isAdmin==1)
            return redirect('user.index', ['users' => User::all()]);

        return redirect('/');
    }
}
//https://dev.to/kaperskyguru/multiple-role-based-authentication-in-laravel-30pc 