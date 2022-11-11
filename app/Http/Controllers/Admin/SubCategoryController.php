<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Category,
    Models\Subcategory,
    Models\Childcategory
};
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{

    public function index(){
        return view('admin.subcategory.index');
    }

}
