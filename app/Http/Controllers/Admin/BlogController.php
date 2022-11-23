<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index');
    }

    public function blogcategories()
    {
        return view('admin.blog.category.index');
    }

    public function create()
    {
        $cats = BlogCategory::all();

        return view('admin.blog.post.create', compact('cats'));
    }

    public function settings()
    {
        return view('admin.blog.settings');
    }
}
