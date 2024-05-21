<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Aquí puedes registrar tus middleware y asignarles nombres
    protected $middleware = [
        // Otros middlewares...
    ];

    // Aquí puedes registrar middleware de ruta
    protected $middlewareGroups = [
        'web' => [
            // Otros middlewares de ruta...
        ],

        'api' => [
            \App\Http\Middleware\CustomAuthenticate::class, // Aquí se asigna el middleware AuthCustom
        ],
    ];

    // Aquí puedes registrar middleware de ruta con su nombre de clave
    protected $routeMiddleware = [
        'custom.auth' => \App\Http\Middleware\CustomAuthenticate::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
