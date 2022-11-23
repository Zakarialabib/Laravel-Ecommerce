<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class BrandPage extends Component
{
    use WithPagination;

    public int $perPage;

    public array $paginationOptions;

    public function mount($brand)
    {
        $this->brand = $brand;
        $this->perPage = 15;
        $this->paginationOptions = [25, 50, 100];
    }

    public function render()
    {
        // where status is true
        $brand_products = Product::where('status', 1)
            ->where('brand_id', $this->brand->id)
            ->paginate($this->perPage);

        return view('livewire.front.brand-page', compact('brand_products'));
    }
}
