<?php

namespace IVSales\Http\Middleware;

use Closure;
use Cart;

class OrderIfCartNotEmpty
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
        if (Cart::isNotEmpty()) {
            return $next($request);
        }
        return abort(404);
    }
}
