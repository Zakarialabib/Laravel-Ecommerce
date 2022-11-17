<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
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

    public function productShow($slug)
    {    
        $product = Product::where('slug', $slug)->first();
        
        return view('front.product', compact('product'));
    }

    public function categories()
    {
        return view('front.categories');
    }

    public function brands()
    {
        return view('front.brands');
    }

    public function brandPage($slug)
    {    
        $brand = Brand::where('slug', $slug)->first();

        return view('front.brand-page', compact('brand'));
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
        $blogs = Blog::with('category')->get();

        return view('front.blog', compact('blogs'));
    }

    public function blogPage(Blog $id)
    {
        $blog = Blog::findorfail($id);

        return view('front.blog-page', compact('blog'));
    }

    // thanks page
    public function thankyou(Order $order)
    {
        return view('front.order-summary', compact('order'));
    }

}
