<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return view('admin.blog.category.index');
    }
}
