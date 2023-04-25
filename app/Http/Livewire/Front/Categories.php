<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    use WithSorting;

    public $listeners = [
        'load-more' => 'loadMore',
    ];

    public int $perPage;

    public array $paginationOptions;

    public $category_id;

    public $subcategory_id;

    public $brand_id;

    public $sorting;

    public $sortingOptions;

    public $selectedFilters = [];

    protected $queryString = [
        'category_id'    => ['except' => '', 'as' => 'c'],
        'subcategory_id' => ['except' => '', 'as' => 's'],
        'sorting'        => ['except' => '', 'as' => 'f'],
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function filterProducts($type, $value)
    {
        switch ($type) {
            case 'category':
                $this->category_id = $value;

                break;
            case 'subcategory':
                $this->subcategory_id = [$value];
                $this->selectedFilters['subcategory'] = Subcategory::find($value)->name;

                break;
            case 'brand':
                $this->brand_id = $value;

                break;
        }
        $this->resetPage();
    }

    public function clearFilter($filter)
    {
        switch ($filter) {
            case 'category':
                $this->category_id = null;
                unset($this->selectedFilters['category']);

                break;
            case 'subcategory':
                $this->subcategory_id = null;
                unset($this->selectedFilters['subcategory']);

                break;
            case 'brand':
                $this->brand_id = null;
                unset($this->selectedFilters['brand']);

                break;
        }
        $this->resetPage();
    }

    public function mount()
    {
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
    }

    public function getCategoriesProperty()
    {
        return Category::active()->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::active()->get();
    }

    public function loadMore()
    {
        $this->perPage += 25;
    }

    public function render(): View|Factory
    {
        $query = Product::active()
            ->when($this->category_id, function ($query) {
                return $query->where('category_id', $this->category_id);
            })
            ->when($this->subcategory_id, function ($query) {
                return $query->whereIn('subcategories', $this->subcategory_id);
            });

        if ($this->sorting === 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sorting === 'name-desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sorting === 'price') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sorting === 'price-desc') {
            $query->orderBy('price', 'desc');
        } elseif ($this->sorting === 'date') {
            $query->orderBy('created_at', 'asc');
        } elseif ($this->sorting === 'date-desc') {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate($this->perPage);

        return view('livewire.front.categories', [
            'products' => $products,
        ]);
    }
}
