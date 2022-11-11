<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;

class Catalog extends Component
{
    use WithPagination, WithSorting;
    
    public $view;

    public int $perPage;

    protected $listeners = ['changeView','filterCategories','filterSubCategories','filterBrands'];

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
    // filterProducts $category_id,$brand_id,$subcategory_id

    public function filterCategories($category_id)
    {
        $this->category_id = $category_id;
        $this->resetPage();
    }
    public function filterSubCategories($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
        $this->resetPage();
    }
    public function filterBrands($brand_id)
    {
        $this->brand_id = $brand_id;
        $this->resetPage();
    }

      public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
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

        $this->view = 'grid';

    }

    public function changeView($view)
    {

        $this->view = $view;
        
        $this->emit('changeView', $view);

    }
    // change view grid or list
    // $this->sorting
    

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
        } elseif ($this->category_id) {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->where('category_id', $this->category_id)->paginate($this->perPage);
        
        } else {
            $products = Product::whereBetween('price',[$this->minPrice,$this->maxPrice])->paginate($this->perPage);

        }

        $popular_products = Product::inRandomOrder()->limit(4)->get();
        
        $categories = Category::with('subcategories')->get();
        $brands = Brand::all();

        return view('livewire.front.catalog', compact('products', 'popular_products', 'categories', 'brands'));
    }
}
