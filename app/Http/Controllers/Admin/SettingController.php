<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingController extends Controller
{
    public function index(Settings $setting)
    {
        return view('admin.settings.index', compact('setting'));
    }
}
