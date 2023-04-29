<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryPage extends Component
{
    use WithPagination;

    public $listeners = [
        'load-more' => 'loadMore',
    ];

    public int $perPage = 25;

    public $sorting;

    public array $paginationOptions = [25, 50, 100];

    public array $sortingOptions;

    public $subcategory;
    
    public $brand_id;

    public function getBrandsProperty()
    {
        return Brand::active()->get();
    }

    public function filterProducts($type, $value)
    {
        switch ($type) {
            case 'brand':
                $this->brand_id = $value;

                break;
        }
        $this->resetPage();
    }

    public function clearFilter($filter)
    {
        switch ($filter) {
            case 'brand':
                $this->brand_id = null;

                break;
        }
        $this->resetPage();
    }

    public function mount($subcategory)
    {
        $this->subcategory = Subcategory::findOrFail($subcategory->id);

        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
    }

    public function loadMore()
    {
        $this->perPage += 25;
    }

    public function render(): View|Factory
    {
        $query = Product::active()
            ->where('subcategories', 'like', '%"'.$this->subcategory->id.'"%')
            ->when($this->brand_id, function ($query) {
                return $query->where('brand_id', $this->brand_id);
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

        return view('livewire.front.subcategory-page', [
            'products' => $products,
        ]);
    }
}
