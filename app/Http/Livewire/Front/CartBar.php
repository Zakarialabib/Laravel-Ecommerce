<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartBar extends Component
{
    use LivewireAlert;

    public $decreaseQuantity;

    public $increaseQuantity;

    public $removeFromCart;

    public $cartTotal;

    // public $cartItems;

    public $showCart = false;

    public $productId;

    public $listeners = [
        'showCart',
        'hideCart',
        'cartBarUpdated',
        'confirmed',
    ];

    public $shipping;

    public $shipping_id;

    public function confirmed()
    {
        Cart::instance('shopping')->remove($this->productId);
        $this->emit('cartCountUpdated');
        $this->emit('cartBarUpdated');
    }

    public function showCart()
    {
        $this->showCart = true;
    }

    public function decreaseQuantity($rowId)
    {
        $cartItem = Cart::instance('shopping')->get($rowId);
        $qty = $cartItem->qty - 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('cartBarUpdated');
    }

    public function increaseQuantity($rowId)
    {
        $cartItem = Cart::instance('shopping')->get($rowId);
        $qty = $cartItem->qty + 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('cartBarUpdated');
    }

    public function removeFromCart($rowId)
    {
        $this->productId = $rowId;

        $this->confirm(
            __('Remove from cart ?'),
            [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'confirm',
                'onConfirmed' => 'confirmed',
                'showCancelButton' => true,
                'cancelButtonText' => 'cancel',
            ]
        );
    }

    public function cartBarUpdated()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();
    }

    public function getCartItemsProperty()
    {
        return Cart::instance('shopping')->content();
    }

    public function getSubTotalProperty()
    {
        return Cart::instance('shopping')->subtotal();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.cart-bar');
    }
}
