<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Blog,
    Models\BlogCategory
};
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
   
    public function index(){
        return view('admin.blog.index');
    }

    public function blogcategories(){
        return view('admin.blog.category.index');
    }


    public function create()
    {
        $cats = BlogCategory::all();
        return view('admin.blog.post.create',compact('cats'));
    }

    public function settings(){
        return view('admin.blog.settings');
    }

}
