<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;

class Categories extends Component
{
    use WithPagination, WithSorting;

    public $listenrs = ['filterProducts'];

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    public $category_id;
    public $subcategory_id;

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
    // filterProducts({{ $category->id }})

    public function filterProducts($category_id)
    {
        $this->category_id = $category_id;
        $this->resetPage();
    }

    public function mount()
    {
        $this->sorting = 'default';
        
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 15;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Product())->orderable;

    }
    public function render()
    {

        if ($this->sorting == 'name') {
            $products = Product::orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'name-desc') {
            $products = Product::orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price') {
            $products = Product::orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date') {
            $products = Product::orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting == 'date-desc') {
            $products = Product::orderBy('created_at', 'desc')->paginate($this->perPage);
        } elseif ($this->category_id) {
            $products = Product::where('category_id', $this->category_id)->paginate($this->perPage);
        
        } else {
            $products = Product::paginate($this->perPage);
        }

        $popular_products = Product::inRandomOrder()->limit(8)->get();
        
        $categories = Category::with('subcategories')->get();
        $brands = Brand::all();

        return view('livewire.front.categories', compact('products', 'popular_products', 'categories', 'brands'));
    }
}
