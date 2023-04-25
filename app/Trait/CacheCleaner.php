<?php

declare(strict_types=1);

namespace App\Trait;

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
