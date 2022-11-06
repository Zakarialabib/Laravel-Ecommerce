<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCount extends Component
{
    public $cartCount;

    public $decreaseQuantity;
    public $increaseQuantity;
    public $removeFromCart;

    public $cartTotal;
    public $cartItems;

    public function mount()
    {
        $this->cartCount = Cart::instance('shopping')->count();
        $this->cartTotal = Cart::instance('shopping')->total();
        $this->cartItems = Cart::instance('shopping')->content();
    }

    protected $listeners = [
        'cartCountUpdated'
    ];

    public function decreaseQuantity($rowId)
    {
        $cart = Cart::instance('shopping')->get($rowId);
        
        $qty = $cart->qty - 1;
        
        Cart::instance('shopping')->update($rowId, $qty);
    }

    public function increaseQuantity($rowId)
    {
        $cart = Cart::instance('shopping')->get($rowId);
        
        $qty = $cart->qty + 1;
        
        Cart::instance('shopping')->update($rowId, $qty);
    }

    public function removeFromCart($rowId)
    {
        Cart::instance('shopping')->remove($rowId);
    }
    
    public function render()
    {
        $cartCount = Cart::instance('shopping')->count();        

        return view('livewire.front.cart-count', compact('cartCount'));
    }

    public function cartCountUpdated()
    {
        $this->render();
    }


}