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
    
        return view('admin.settings.index',compact('setting'));
    }
  
}