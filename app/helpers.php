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
        return Cache::get('settings')->where('key', $key)->first()->value;
    }
}