<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\FeaturedBanner;
use App\Models\Section;
use Illuminate\Support\Collection;

class Index extends Component
{

    public function getFeaturedProductsProperty()
    {
        return Product::where('featured', 1)->get();
    }

    public function getBestOffersProperty()
    {
        return Product::where('best', 1)->get();
    }

    public function getHotProductsProperty()
    {
        return Product::where('hot', 1)->get();
    }

    public function getBrandsProperty(): Collection
    {
        return Brand::where('status', 1)->get();
    }

    public function getSlidersProperty(): Collection
    {
        return Slider::where('featured', 1)->take(1)->get();
    }

    public function getFeaturedBannersProperty(): Collection
    {
        return FeaturedBanner::where('featured', 1)->take(1)->get();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::where('status', 1)->get();
    }

    
    public function render()
    {
        return view('livewire.front.index');
    }
}
