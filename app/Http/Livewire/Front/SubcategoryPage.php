<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryPage extends Component
{
    use WithPagination;

    public int $perPage;

    public array $paginationOptions;

    public $subcategory;

    public function mount($subcategory)
    {
        $this->subcategory = Subcategory::findOrFail($subcategory->id);
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
    }

    public function render(): View|Factory
    {
        $subcategory_products = Product::active()
            ->where('subcategory_id', $this->subcategory->id)
            ->paginate($this->perPage);

        return view('livewire.front.subcategory-page', compact('subcategory_products'));
    }
}
