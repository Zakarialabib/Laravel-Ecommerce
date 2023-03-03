<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(): View|Factory
    {
        return view('admin.blog.index');
    }

    public function blogcategories(): View|Factory
    {
        return view('admin.blog.category.index');
    }
}
