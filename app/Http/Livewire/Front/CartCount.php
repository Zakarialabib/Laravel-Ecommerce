<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCount extends Component
{
    public $cartCount;

    public $listeners = [
        'cartCountUpdated'
    ];

    public function getCartCountProperty()
    {
        return Cart::instance('shopping')->count();
    }

    public function cartCountUpdated()
    {
        $this->reset();
    }
    
    public function render()
    { 
        return view('livewire.front.cart-count');
    }



}