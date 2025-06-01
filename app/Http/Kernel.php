<?php
// ...existing code...
class Kernel extends \Illuminate\Foundation\Http\Kernel
{
    protected $middlewareGroups = [
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        // ...other middleware groups...
    ];
    // ...existing code...
}