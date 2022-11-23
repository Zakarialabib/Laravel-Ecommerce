<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }
}
