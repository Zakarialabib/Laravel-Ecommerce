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
    public function getFeaturedProductsProperty(): Collection
    {
        return Product::where('featured', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBestOffersProperty(): Collection
    {
        return Product::where('best', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getHotProductsProperty(): Collection
    {
        return Product::where('hot', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBrandsProperty(): Collection
    {
        return Brand::with('products')->active()->get();
    }

    public function getSlidersProperty(): Collection
    {
        return Slider::active()->get();
    }

    public function getFeaturedbannerProperty()
    {
        return FeaturedBanner::where('featured', 1)->first();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::where('status', 1)->limit(4)->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index');
    }
}
