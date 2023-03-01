<?php

namespace App\Traits;

use Illuminate\Support\Facades\Artisan;

trait CacheCleaner
{
    public static function bootCacheCleaner()
    {
        self::created(function () {
            Artisan::call('cache:clear');
        });

        self::updated(function () {
            Artisan::call('cache:clear');
        });

        self::deleted(function () {
            Artisan::call('cache:clear');
        });
    }
}
