<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Route registration and rate limiting moved to bootstrap/app.php in the
 * Laravel 11+ skeleton. This provider is kept purely for the "home" route
 * constants that the auth controllers and middleware redirect to.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the admin "home" route for your application.
     */
    public const ADMIN_HOME = '/admin/dashboard';

    /**
     * The path to the client "home" route for your application.
     */
    public const CLIENT_HOME = '/';
}
