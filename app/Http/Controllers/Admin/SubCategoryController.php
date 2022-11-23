<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view('admin.subcategory.index');
    }
}
