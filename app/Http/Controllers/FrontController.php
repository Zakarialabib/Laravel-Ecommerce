<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Tags\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::active()->paginate(3);

        return view('front.index', compact('products'));
    }

    public function catalog()
    {
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

    public function subcategories()
    {
        return view('front.subcategories');
    }

     public function SubcategoryPage($slug)
     {
         $subcategory = Subcategory::where('slug', $slug)->first();

         return view('front.subcategory-page', compact('subcategory'));
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

    public function myaccount(User $customer)
    {
        $customer = Auth::user();

        return view('front.user-account', ['customer' => $customer]);
    }

    public function generateSitemaps()
    {
        SitemapIndex::create()
            ->add(Sitemap::create('/pages_sitemap.xml')
                ->setLastModificationDate(Carbon::yesterday()))
            ->add(Sitemap::create('/posts_sitemap.xml')
                ->setLastModificationDate(Carbon::yesterday()))
            ->writeToFile(public_path('sitemap.xml'));
            
        Product::active()->get()->each( function (Product $product) use ($sitemap) {
            $sitemap->add(Url::create("/{$product->slug}"));
        });

        Brand::all()->each( function (Brand $brand) use ($sitemap) {
            $sitemap->add(Url::create("/brand/{$brand->slug}"));
        });

        Subcategory::all()->each( function (Subcategory $subcategory) use ($sitemap) {
            $sitemap->add(Url::create("/subcategory/{$subcategory->slug}"));
        });

        SitemapGenerator::create(config('app.url'))
            ->getSitemap()
            ->add(
                Url::create('/')
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(1.0)
            )
            ->add(Url::create(route('front.catalog'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.9)
            )
            ->add(Url::create(route('front.brands'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.8)
            )
            ->add(Url::create(route('front.categories'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
            )
            ->add(Url::create(route('front.about'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
            )
            ->add(Url::create(route('front.contact'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.2)
            )


            ->writeToFile(public_path('pages_sitemap.xml'));
    }
}
