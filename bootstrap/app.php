<?php

declare(strict_types=1);

use App\Http\Middleware\AuthGate;
use App\Http\Middleware\AuthRole;
use App\Http\Middleware\CheckApproved;
use App\Http\Middleware\HTTPSConnection;
use App\Http\Middleware\Locale;
use App\Http\Middleware\MaintenanceMode;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SuperAdmin;
use App\Providers\RouteServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // routes/web.php also requires routes/auth.php and routes/admin.php
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Guests hitting an "auth" route land on the named login route.
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));

        // Authenticated users hitting a "guest" route go to their dashboard.
        $middleware->redirectUsersTo(
            fn (Request $request) => $request->user()?->isAdmin()
                ? RouteServiceProvider::ADMIN_HOME
                : RouteServiceProvider::CLIENT_HOME
        );

        // Do not trim/convert credential fields.
        $middleware->trimStrings(except: [
            'current_password',
            'password',
            'password_confirmation',
        ]);

        // Livewire 4 serves its endpoints under /livewire-{hash}/*.
        $middleware->validateCsrfTokens(except: [
            'livewire/*',
            'livewire-*/*',
        ]);

        // Web group additions (framework defaults already cover cookies,
        // session, errors-from-session, CSRF and route bindings).
        $middleware->web(append: [
            AuthGate::class,
            Locale::class,
        ]);

        $middleware->api(prepend: [
            'throttle:api',
        ]);

        $middleware->alias([
            'role'      => AuthRole::class,
            'guest'     => RedirectIfAuthenticated::class,
            'super'     => SuperAdmin::class,
            'approved'  => CheckApproved::class,
            'https'     => HTTPSConnection::class,
            'maintenance' => MaintenanceMode::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })
    ->booted(function (): void {
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute(60)
            ->by($request->user()?->id ?: $request->ip()));
    })
    ->create();
