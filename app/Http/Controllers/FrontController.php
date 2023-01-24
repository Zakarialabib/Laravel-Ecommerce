<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Auth;
use Spatie\Sitemap\SitemapIndex;

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

    public function categoryPage($slug)
    {
        $category = Category::where('slug', $slug)->first();

        return view('front.category-page', compact('category'));
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
        $sitemapIndexPath = SitemapIndex::create()
            ->add('/products_sitemap.xml')
            ->add('/brands_sitemap.xml')
            ->add('/pages_sitemap.xml')
            ->add('/subcategories_sitemap.xml');

        $sitemapIndexPath->writeToFile(public_path('sitemap.xml'));

        $sitemap = Sitemap::create()
            ->add(
                Url::create('/')
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(1.0)
            )
            ->add(
                Url::create(route('front.catalog'))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.9)
            )
            ->add(
                Url::create(route('front.brands'))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.8)
            )
            ->add(
                Url::create(route('front.categories'))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.7)
            )
            ->add(
                Url::create(route('front.about'))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.6)
            )
            ->add(
                Url::create(route('front.contact'))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.5)
            );

        $sitemap->writeToFile(public_path('pages_sitemap.xml'));

        $products_sitemaps = Sitemap::create();

        Product::select('id', 'slug', 'updated_at')->active()->get()->each(function (Product $product) use ($products_sitemaps) {
            $products_sitemaps->add(Url::create("catalog/{$product->slug}")
                ->setLastModificationDate($product->updated_at));
        });

        $products_sitemaps->writeToFile(public_path('products_sitemap.xml'));

        $brands_sitemaps = Sitemap::create();

        Brand::select('id', 'slug', 'updated_at')->get()->each(function (Brand $brand) use ($brands_sitemaps) {
            $brands_sitemaps->add(Url::create("/marque/{$brand->slug}")
                ->setLastModificationDate($brand->updated_at));
        });

        $brands_sitemaps->writeToFile(public_path('brands_sitemap.xml'));

        $subcategories_sitemaps = Sitemap::create();

        Subcategory::select('id', 'slug', 'updated_at')->get()->each(function (Subcategory $subcategory) use ($subcategories_sitemaps) {
            $subcategories_sitemaps->add(Url::create("/categorie/{$subcategory->slug}"));
        });

        $subcategories_sitemaps->writeToFile(public_path('subcategories_sitemap.xml'));
    }
}
