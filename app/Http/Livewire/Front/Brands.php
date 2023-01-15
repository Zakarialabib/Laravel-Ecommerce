<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Brands extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    public $category_id;

    public $subcategory_id;

    public $brand_id;

    public $sorting;

    public $filterProductCategories;
    public $filterProductBrands;
    public $filterProductSubcategories;

    protected $queryString = [
        'search'        => [
            'except' => '',
        ],
        'sortBy'        => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function filterProductBrands($brand_id)
    {
        $this->brand_id = $brand_id;
        $this->resetPage();
    }

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

    public function mount()
    {
        $this->sorting = 'default';
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Product::active()->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->sorting == 'name') {
            $products = $query->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'name-desc') {
            $products = $query->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price') {
            $products = $query->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price-desc') {
            $products = $query->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date') {
            $products = $query->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date-desc') {
            $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        } elseif ($this->brand_id) {
            $products = $query->where('brand_id', $this->brand_id)->paginate($this->perPage);
        } elseif ($this->category_id) {
            $products = $query->where('category_id', $this->category_id)->paginate($this->perPage);
        } elseif ($this->subcategory_id) {
            $products = $query->where('subcategory_id', $this->subcategory_id)->paginate($this->perPage);
        } else {
            $products = $query->paginate($this->perPage);
        }

        return view('livewire.front.brands', compact('products'));
    }

    public function getBrandsProperty()
    {
        return Brand::select('id', 'name', 'image', 'featured_image')->get();
    }

    public function getCategoriesProperty()
    {
        return Category::active()->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::active()->get();
    }
}
