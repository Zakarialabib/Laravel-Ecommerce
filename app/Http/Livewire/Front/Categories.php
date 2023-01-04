<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Categories extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    public $category_id;

    public $subcategory_id;
    public $sorting;

    public $filterProductCategories;
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

    public function getCategoriesProperty()
    {
        return Category::where('status', 1)->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::where('status', 1)->get();
    }

    public function render(): View|Factory
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

        $products =  Product::where('status', 1)
            ->where('category_id', $this->category_id)
            ->where('subcategory_id', $this->subcategory_id)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.front.categories', compact('products'));
    }
}
