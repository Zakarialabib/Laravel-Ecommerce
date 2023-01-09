<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\FeaturedBanner;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Index extends Component
{
    public function getSubcategoriesProperty(): Collection
    {
        return Subcategory::with('products')
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();
    }
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
        return Brand::with('products')->get();
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
        return Section::active()->limit(4)->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index');
    }
}
