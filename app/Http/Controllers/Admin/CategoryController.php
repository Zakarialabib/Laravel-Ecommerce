<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(){
        return view('admin.category.index');
    }
    
    public function subcategories(){
        return view('admin.subcategory.index');
    }
    
}