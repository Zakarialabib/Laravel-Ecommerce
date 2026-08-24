<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * Policies are auto-discovered since Laravel 11, so no $policies map
     * and no registerPolicies() call is needed here.
     */
    public function boot(): void
    {
        Gate::before(fn ($user, $ability) => $user->hasRole('Super Admin') ? true : null);
    }
}
