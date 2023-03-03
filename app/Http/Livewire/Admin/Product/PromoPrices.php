<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PromoPrices extends Component
{
    public $percentage;
    public $copyPriceToOldPrice;

    public $promoModal = false;

    public $listeners = [
        'promoModal',
    ];

    public function promoModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->promoModal = true;
    }

    public function update()
    {
        $products = Product::active()->get();

        foreach ($products as $product) {
            if ($this->copyPriceToOldPrice) {
                $product->old_price = $product->price;
            } else {
                $product->price = $product->price * (1 + $this->percentage / 100);
            }

            $product->save();
        }
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.promo-prices');
    }
}
