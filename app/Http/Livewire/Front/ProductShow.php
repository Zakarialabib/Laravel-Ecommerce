<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductShow extends Component
{
    use LivewireAlert;

    public $product;
    
    public $listeners = [
        'AddToCart'
    ];

     public function AddToCart($product)
    {
        Cart::add($product->id, $product->name, 1, $product->price);

        $this->alert('success', __('Product Add to Cart successfully...!!'));
    }

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.front.product-show');
    }
}
