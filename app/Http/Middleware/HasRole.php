<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            // if user has given role, continue processing the request
            if (auth()->user()->hasRole($role)) {
                return $next($request);
            }
        }

        App::abort(403);
    }
}
