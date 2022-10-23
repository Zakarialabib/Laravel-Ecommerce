<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;

class SearchBox extends Component
{

    public $listeners = ['updatedSearch' => 'search'];
    
    public $search = '';
    public $results = [];
    public $brands = [];
    public $categories = [];
    public $minPrice = 0;
    public $maxPrice = 0;
    public $minPriceRange = 0;
    public $maxPriceRange = 0;
    public $selectedBrand = null;
    public $selectedCategory = null;
    public $selectedPrice = null;
    
    public function mount($search = null)
    {
        $this->search = $search;
        $this->results = Product::where('name', 'like', '%' . $this->search . '%')->get();
        $this->brands = Product::select('brand_id')->distinct()->get();
        $this->categories = Product::select('category_id')->distinct()->get();
        $this->minPrice = Product::min('price');
        $this->maxPrice = Product::max('price');
        $this->minPriceRange = $this->minPrice;
        $this->maxPriceRange = $this->maxPrice;
    }

    public function updatedSearch()
    {
        $this->results = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        return view('livewire.front.search-box');
    }


}
