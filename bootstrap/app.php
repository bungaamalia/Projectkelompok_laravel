<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
=======
use App\Http\Middleware\CheckAuth;
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        // Daftarkan alias middleware untuk proteksi login
        $middleware->alias([
            'check.auth' => \App\Http\Middleware\CheckAuth::class,
=======
        $middleware->alias([
            'check.auth' => CheckAuth::class,
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
<<<<<<< HEAD
    })->create();
=======
    })
    ->create();
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
