<?php

declare(strict_types=1);

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
    
    public $cartItems;

    public $cartTotal;

    public $showCart = false;

    public $listeners = [
        'showCart',
        'hideCart',
        'cartBarUpdated',
    ];

    public $shipping;

    public $shipping_id;

    public array $listsForFields = [];

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
        try {
            Cart::instance('shopping')->remove($rowId);
            $this->emit('cartCountUpdated');
            $this->alert(
                'success',
                __('Product removed from cart successfully!'),
                [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'toast'             => true,
                    'text'              => '',
                    'confirmButtonText' => 'Ok',
                    'cancelButtonText'  => 'Cancel',
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]
            );
        } catch (\Exception $e) {
            $this->alert(
                'error',
                __('An error occurred while trying to remove the product from the cart: '.$e->getMessage()),
                [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'toast'             => true,
                    'text'              => '',
                    'confirmButtonText' => 'Ok',
                    'cancelButtonText'  => 'Cancel',
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]
            );
        }
    }    

    public function cartBarUpdated()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();

        $this->mount();
    }

    public function mount()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();

        $this->shipping = Shipping::find($this->shipping_id);

        // dd($this->all());
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
