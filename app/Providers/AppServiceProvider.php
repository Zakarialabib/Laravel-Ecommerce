<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Models\Language;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Cache; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // cache()->rememberForever('settings', function () {
        //     return Settings::all();
        // });

        // View::share('settings', cache('settings'));

        // if (env('APP_ENV') === 'production') {
        //     URL::forceScheme('https');
        // }

        //  Todo : Share Settings and languages with all views
        Cache::forever('settings', Settings::all());
        
        if (Session::has('language')) {
        $languages = cache()->rememberForever('languages', function () {
            return Language::pluck('name', 'code')->toArray();
        });
        View::share('languages', $languages);
        } else {
        $languages = cache()->rememberForever('languages', function () {
            return Language::where('is_default', 1)->first();
        });

        View::share('languages', $languages);
        }
        
        // Model::shouldBeStrict(! $this->app->isProduction());
        
    }
}
