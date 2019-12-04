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

        if ($role === "user" && !$request->user()->isAdmin)
           /* return redirect('user.show', ['username' => Auth::user()->username]);*/
            return \Redirect::route('user.show', [Auth::user()->username]);

        else if ($role === "admin" && $request->user()->isAdmin)
            return redirect('user.index', ['users' => User::all()]);

        return redirect('/');
    }
}
