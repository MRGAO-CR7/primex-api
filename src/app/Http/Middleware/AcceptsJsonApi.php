<?php

namespace App\Http\Middleware;

use Closure;

class AcceptsJsonApi
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
        if (!config('app.debug')) {
            $request->headers->set('accept', 'application/vnd.api+json');
        }

        return $next($request);
    }
}
