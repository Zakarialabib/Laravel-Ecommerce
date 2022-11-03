<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;

class Brands extends Component
{
    use WithPagination, WithSorting;
    // newest
    // price
    // most-popular

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    public $maxPrice;
    public $minPrice;

    public $category_id;
    public $subcategory_id;
    public $brand_id;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
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

    public function filterProducts($brand_id)
    {
        $this->brand_id = $brand_id;
        $this->resetPage();
    }

    public function mount()
    {
        $this->sorting = 'default';
        $this->minPrice = 100;
        $this->maxPrice = 100000;
        
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 15;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Product())->orderable;

    }
    public function render()
    {

        if ($this->sorting == 'name') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'name-desc') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date-desc') {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->orderBy('created_at', 'desc')->paginate($this->perPage);
        } elseif ($this->brand_id) {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->where('brand_id', $this->brand_id)->paginate($this->perPage);
        } else {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->paginate($this->perPage);

        }

        $popular_products = Product::inRandomOrder()->limit(8)->get();
        
        $categories = Category::with('subcategories')->get();
        $brands = Brand::all();

        return view('livewire.front.brands', compact('products', 'popular_products', 'categories', 'brands'));
    }
}
