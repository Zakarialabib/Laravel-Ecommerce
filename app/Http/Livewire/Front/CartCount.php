<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCount extends Component
{
    public $cartCount;

    public function mount()
    {
        $this->cartCount = Cart::instance('shopping')->count();
    }

    public $listeners = [
        'cartCountUpdated'
    ];

    
    public function cartCountUpdated()
    {
        $this->render();
    }
 
    public function render()
    { 

        return view('livewire.front.cart-count');
    }


}