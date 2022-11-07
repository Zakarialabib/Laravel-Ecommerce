<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Shipping;

class Checkout extends Component
{
    public $listeners = ['checkout' => 'checkout'];
    // shipping_id
    // payment_method
    // shipping_cost
    // name
    // email
    // address
    // city
    // phone
    // total
    // order_status

    public $shipping_id;

    public $listsForFields = [];
    
    public function checkout()
    {
        dd('checkout');
    }

    public function updatedShippingId($value)
    {
        if ($value) {
            $this->shipping = Shipping::find($value);
            if ($this->shipping->is_pickup) {
                $cartTotal = Cart::instance('shopping')->total();
            } else {
                $cartTotal = Cart::instance('shopping')->total() + $this->shipping->cost;
            }
        } else {
            $cartTotal = Cart::instance('shopping')->total();
        }
        $this->emit('cartTotalUpdated', $cartTotal);
    }

    public function mount()
    {
        $this->cartTotal = Cart::instance('shopping')->total();
        
        $this->cartCount = Cart::instance('shopping')->count();

        $this->cartItems =  Cart::instance('shopping')->content();
        
        $this->shipping = Shipping::find($this->shipping_id);

        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.front.checkout');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['shippings'] = Shipping::pluck('title', 'id')->toArray();

    }
}
