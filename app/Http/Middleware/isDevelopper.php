<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDevelopper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isDevelopper() || !$request->user()->isAdmin()) {
            abort(403);
        }
        return $next($request);
    }
}
