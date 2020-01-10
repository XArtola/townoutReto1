<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
=======
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
>>>>>>> feature/mapaJuego
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
<<<<<<< HEAD
        return $next($request)->header("Access-Control-Allow-Origin","http://localhost")-> header("Access-Control-Allow-Methods","GET, POST, PUT, DELETE, OPTIONS");
=======
        return $next($request)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
>>>>>>> feature/mapaJuego
    }
}
