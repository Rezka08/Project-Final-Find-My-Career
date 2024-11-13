<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'employer' => \App\Http\Middleware\EmployerMiddleware::class,
        'jobseeker' => \App\Http\Middleware\JobSeekerMiddleware::class,
    ];
}