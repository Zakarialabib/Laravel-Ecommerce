<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

    public function index(){
        return view('admin.brand.index');
    }

}
