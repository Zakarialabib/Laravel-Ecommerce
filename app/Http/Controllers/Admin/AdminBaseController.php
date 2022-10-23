<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App;
use App\Models\Language;

class AdminBaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
