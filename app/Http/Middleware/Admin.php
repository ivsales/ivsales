<?php

namespace IVSales\Http\Middleware;

use Closure;

class Admin
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
        return $request->user()!==null?
            $request->user()->isAdmin()
            ? $next($request)
            : redirect('/home')
        : redirect('/login');

    }
}
