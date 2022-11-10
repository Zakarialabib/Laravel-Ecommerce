<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\FeaturedBanner;
use App\Models\Section;

class Index extends Component
{
    public $products;
    public $sliders;
    public $blogs;
    public $brands;
    public $featuredbanner;
    public $sections;

    public function mount()
    {
        $this->products = Product::where('featured', 1)->get();
        $this->sliders = Slider::where('status', 1)->take(1)->get();
        $this->blogs = Blog::where('status', 1)->get();
        $this->brands = Brand::where('status', 1)->get();
        $this->featuredbanner = FeaturedBanner::where('status', 1)->take(1)->get();
        $this->featuredProducts = Product::where('featured', 1)->get();
        $this->bestOffers = Product::where('best', 1)->get();
        $this->hotProducts = Product::where('hot', 1)->get();
        
        $this->sections = Section::where('status', 1)->get();
    }
    
    public function render()
    {
        return view('livewire.front.index');
    }
}
