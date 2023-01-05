<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class BrandPage extends Component
{
    use WithPagination;

    public int $perPage;

    public array $paginationOptions;

    public $brand;

    public $brand_id;

    public $category_id;

    public $subcategory_id;

    public $filterProductCategories;
    public $filterProductSubcategories;

    public function filterProductCategories($category_id)
    {
        $this->category_id = $category_id;
        $this->resetPage();
    }

    public function filterProductSubcategories($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
        $this->resetPage();
    }

    public function mount($brand)
    {
        $this->brand = $brand;
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
    }

    public function render(): View|Factory
    {
        // where status is true
        $brand_products = Product::where('status', 1)
            ->when($this->brand_id, function ($query) {
                return $query->where('brand_id', $this->brand_id);
            })
            ->where('category_id', $this->category_id)
            ->where('subcategory_id', $this->subcategory_id)
            ->paginate($this->perPage);

        return view('livewire.front.brand-page', compact('brand_products'));
    }

    public function getCategoriesProperty()
    {
        return Category::where('status', 1)->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::where('status', 1)->get();
    }
}
