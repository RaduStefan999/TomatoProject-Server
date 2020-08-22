<?php

namespace App\Http\Middleware;

use App\Token;
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
        if (Token::where('token', '=', $request->token)->first() != null) {
            return $next($request);
        }
        else {
            return response()->json(json_decode('{"expiredToken" : true}'));
        }
    }
}
