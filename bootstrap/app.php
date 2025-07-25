<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       // $middleware->append(\App\Http\Middleware\SetLocaleFromHeader::class),
       $middleware->alias([
               'verified.api' => \App\Http\Middleware\EnsureEmailIsVerifiedApi::class,
               'pharmacist.verified' => \App\Http\Middleware\EnsurePharmacistEmailIsVerified::class,

           ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
