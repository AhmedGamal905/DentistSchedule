<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('/dashboard')
                ->middleware('web')
                ->name('dashboard.')
                ->group(__DIR__.'/../routes/dashboard.php');
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectUsersTo(fn () => route('dashboard.login.index'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
