<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BrandPage extends Component
{
    use WithPagination;

    public int $perPage;

    public array $paginationOptions;

    public $brand;

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
        $this->brand = Brand::findOrFail($brand->id);
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.brand-page');
    }

    public function getBrandProductsProperty()
    {
        return Product::active()
            ->where('brand_id', $this->brand->id)
            ->when($this->category_id, function ($query) {
                return $query->where('category_id', $this->category_id);
            })
            ->when($this->subcategory_id, function ($query) {
                return $query->where('subcategory_id', $this->subcategory_id);
            })
            ->paginate($this->perPage);
    }

    public function getCategoriesProperty()
    {
        return Category::active()->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::active()->get();
    }
}
