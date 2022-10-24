<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->paginate(3);
        
        return view('front.index',compact('products'));

    }

    public function catalog(){
        
        return view('front.catalog');
    }

    public function product(Product $id)
    {
        $product = Product::findorfail($id);

        return view('front.product', compact('product'));
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function checkout()
    {
        return view('front.checkout');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function about()
    {
        return view('front.about');
    }

    public function blog()
    {
        return view('front.blog');
    }

    public function blogPage(Blog $id)
    {
        $blog = Blog::findorfail($id);

        return view('front.blog-page', compact('blog'));
    }


}
