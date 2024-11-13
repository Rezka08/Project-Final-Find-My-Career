<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JobSeekerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isJobSeeker()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}