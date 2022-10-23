<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show (Product $id)
    {
        $product = Product::findorfail($id);

        return view('front.product', compact('product'));
    }
}
