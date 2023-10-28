<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSecretaire
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
        if ($request->user()->isSecretaire() || $request->user()->isAdmin()) {
            return $next($request);
        }
        abort(403);
    }
}
