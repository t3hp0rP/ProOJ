<?php

namespace App\Http\Middleware;

use Closure;

class BanMiddleware
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
        if (env('isBan'))
            return response()->view('ban');
        return $next($request);
    }
}
