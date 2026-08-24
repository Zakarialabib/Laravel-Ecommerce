<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Language;
use App\Models\Settings;
use App\Observers\SettingsObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        View::share('languages', $this->getLanguages());

        Settings::observe(SettingsObserver::class);

        // Model::shouldBeStrict(! $this->app->isProduction());

    }

    /**
     * Languages shared with every view.
     *
     * Only ARRAYS are cached here, never Eloquent models: Laravel 13's
     * cache hardening ('serializable_classes' => false) means a cached
     * model resurrects as __PHP_Incomplete_Class. The default language is
     * rehydrated into a Language instance on read so views that call
     * ->code / ->name keep working.
     *
     * @return \App\Models\Language|array<string, string>|null
     */
    private function getLanguages()
    {
        if ( ! $this->isConnected() || ! Schema::hasTable('languages')) {
            return null;
        }

        $cached = cache()->rememberForever('languages', function (): array {
            if (Session::has('language')) {
                return ['type' => 'list', 'data' => Language::pluck('name', 'code')->toArray()];
            }

            return [
                'type' => 'default',
                'data' => Language::query()->where('is_default', 1)->first()?->attributesToArray(),
            ];
        });

        if ($cached['type'] === 'list') {
            return $cached['data'];
        }

        return $cached['data'] === null ? null : new Language($cached['data']);
    }

    private function isConnected(): bool
    {
        try {
            \DB::connection()->getPDO();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
