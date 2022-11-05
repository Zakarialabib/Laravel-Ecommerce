<?php

namespace App;

use Cache;

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @return string
     */
    public static function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return \App\Models\Settings::pluck('value', 'key');
        })->get($key);
        // return Cache::get('settings')->where('key', $key)->first()->value;
    }
}