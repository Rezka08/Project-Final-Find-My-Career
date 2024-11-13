<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isEmployer()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}