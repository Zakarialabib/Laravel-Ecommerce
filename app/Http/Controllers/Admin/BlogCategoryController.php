<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function index(){
        return view('admin.blog.category.index');
    }
}