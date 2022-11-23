<?php

namespace App\Http\Livewire\Front;

use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartBar extends Component
{
    use LivewireAlert;

    public $decreaseQuantity;

    public $increaseQuantity;

    public $removeFromCart;

    public $showCart = false;

    public $listeners = [
        'showCart',
        'hideCart',
        'decreaseQuantity',
        'increaseQuantity',
        'removeFromCart',
        'cartBarUpdated',
    ];

    public $shipping;

    public $shipping_id;

    public array $listsForFields = [];

    public function showCart()
    {
        $this->showCart = true;
    }

    // decreaseQuantity

    public function decreaseQuantity($rowId)
    {
        // dd(Cart::get($rowId));

        $item = Cart::instance('shopping')->get($rowId);
        $qty = $item->qty - 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('cartBarUpdated');
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

    public function cartbarUpdated()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();
    }

    public function mount()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();

        $this->shipping = Shipping::find($this->shipping_id);

        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.front.cart-bar');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['shippings'] = Shipping::pluck('title', 'id')->toArray();
    }
}
