<?php

namespace farmacia\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \farmacia\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \farmacia\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'      => \farmacia\Http\Middleware\Authenticate::class,
        'auth.basic'=> \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'     => \farmacia\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'  => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin'     => \farmacia\Http\Middleware\Admin::class,
        'ventas'    => \farmacia\Http\Middleware\ventas::class,
        'marcas'    => \farmacia\Http\Middleware\mdwMarca::class,
        'categ'     => \farmacia\Http\Middleware\mdwCategoria::class,
        'clase'     => \farmacia\Http\Middleware\mdwClase::class,
        'isAdmin'   => \farmacia\Http\Middleware\mdwAdmin::class,
    ];
}
