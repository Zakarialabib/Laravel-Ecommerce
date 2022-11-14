<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddToCart extends Component
{
    use LivewireAlert;
    
    public $product;
    public $quantity = 1;

    public $listeners = [
        'AddToCart'
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function AddToCart($product_id)
    {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->product_name = $product->name;
        $this->product_price = $product->price;
        $this->product_qty = $this->quantity;

        Cart::instance('shopping')->add($this->product_id, $this->product_name, $this->product_qty, $this->product_price)->associate('App\Models\Product');
        
        $this->emit('cartCountUpdated');

        $this->alert('success',
            __('Product added to cart successfully!'),
            [
                'position' =>  'center',
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  '', 
                'confirmButtonText' =>  'Ok', 
                'cancelButtonText' =>  'Cancel', 
                'showCancelButton' =>  false, 
                'showConfirmButton' =>  false, 
            ]
        );
    }

    public function render()
    {
        return view('livewire.front.add-to-cart');
    }
}
