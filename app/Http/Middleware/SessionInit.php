<?php

namespace App\Http\Middleware;

use Closure;

class SessionInit
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
        if (!session()->has('city_id'))
            session(['city_id' => 1]);

        return $next($request);
    }
}
