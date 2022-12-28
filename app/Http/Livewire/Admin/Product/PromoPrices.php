<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;

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
        $products = Product::where('status', 1)->get();

        foreach ($products as $product) {
            if ($this->copyPriceToOldPrice) {
                $product->old_price = $product->price;
            } else {
                $product->price = $product->price * (1 + $this->percentage / 100);
            }

            $product->save();
        }
    }
    
    public function render()
    {
        return view('livewire.admin.product.promo-prices');
    }

}
