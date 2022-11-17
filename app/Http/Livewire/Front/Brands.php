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

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

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
        
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 15;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Product())->orderable;

    }
    public function render()
    {
        return view('livewire.front.brands');
    }

    public function getProductsProperty()
    {
        switch ($this->sorting) {
            case 'name':
                $this->sortBy = 'name';
                $this->sortDirection = 'asc';
                break;
            case 'name-desc':
                $this->sortBy = 'name';
                $this->sortDirection = 'desc';
                break;
            case 'price':
                $this->sortBy = 'price';
                $this->sortDirection = 'asc';
                break;
            case 'price-desc':
                $this->sortBy = 'price';
                $this->sortDirection = 'desc';
                break;
            case 'date':
                $this->sortBy = 'created_at';
                $this->sortDirection = 'asc';
                break;
            case 'date-desc':
                $this->sortBy = 'created_at';
                $this->sortDirection = 'desc';
                break;
            default:
                $this->sortBy = 'id';
                $this->sortDirection = 'desc';
                break;
        }

        return Product::where('status', 1)
            ->when($this->brand_id, function ($query) {
                $query->where('brand_id', $this->brand_id);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getBrandsProperty()
    {
        return Brand::select('id', 'name','image','featured_image')->get();
    }
    

}
