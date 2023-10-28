<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isComptable
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
        if ($request->user()->isComptable() || $request->user()->isAdmin()) {
            return $next($request);
        }
        abort(403);
    }
}
