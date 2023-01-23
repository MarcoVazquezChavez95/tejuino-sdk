<?php

namespace App\Http\Middleware;

use Closure;

class SuperAuthenticated
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
        if (auth()->check() && auth()->user()->isSuper()) {
            return $next($request);
        }

        return redirect('/login');
    }
}
