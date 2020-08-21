<?php

namespace App\Http\Middleware;

use Closure;

class apiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->token == "tomato_super_secret") {
            return $next($request);
        }
        else {
            return response()->json(json_decode('{"expiredToken" : true}'));
        }
    }
}
