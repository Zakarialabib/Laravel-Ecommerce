<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\FeaturedBanner;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Index extends Component
{
    public function getFeaturedProductsProperty()
    {
        return Product::where('featured', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBestOffersProperty()
    {
        return Product::where('best', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getHotProductsProperty()
    {
        return Product::where('hot', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBrandsProperty(): Collection
    {
        return Brand::with('products')->where('status', 1)->get();
    }

    public function getSlidersProperty(): Collection
    {
        return Slider::where('status', 1)->get();
    }

    public function getFeaturedbannerProperty()
    {
        return FeaturedBanner::where('featured', 1)->first();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::where('status', 1)->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index');
    }
}
