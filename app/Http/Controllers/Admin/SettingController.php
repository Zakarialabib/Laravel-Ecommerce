<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class SettingController extends Controller
{

    public function index(Settings $setting)
    {
        // abort_if(Gate::denies('admin_settings_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.index',compact('setting'));
    }
  
}