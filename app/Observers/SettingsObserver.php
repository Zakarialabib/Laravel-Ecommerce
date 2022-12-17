<?php

namespace App\Observers;

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsObserver
{
   
    public function updated(Settings $settings)
    {
        // Refresh the cached list of settings
            Cache::forget('settings');
    }

}
