<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class SubcategoryPage extends Component
{
    use WithPagination;

    public int $perPage;

    public array $paginationOptions;

    public $subcategory;

    public $subcategory_id;

    public $filterProductSubcategories;

    public function filterProductSubcategories($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
        $this->resetPage();
    }

    public function mount($subcategory)
    {
        $this->subcategory = $subcategory;
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
    }

    public function render(): View|Factory
    {
        // where status is true
        $subcategory_products = Product::active()
            ->where('subcategory_id', $this->subcategory_id)
            ->paginate($this->perPage);

        return view('livewire.front.subcategory-page', compact('subcategory_products'));
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::where('status', 1)->get();
    }
}
