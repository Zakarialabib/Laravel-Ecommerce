<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Shipping;
use App\Models\Order;
use Carbon\Carbon;

class Checkout extends Component
{
    use LivewireAlert;

    public $listeners = ['checkout' => 'checkout'];
    // shipping_id
    public $payment_method;
    public $shipping_cost;
    public $first_name;
    public $last_name;

    public $email;
    public $address;
    public $city;
    public $country;
    public $phone;
    
    public $total;

    public $order_status;

    public $shipping_id;

    public $listsForFields = [];


    public function checkout()
    {
        
        $this->validate([
            'shipping_id' => 'required',
        ]);

        $shipping = Shipping::find($this->shipping_id);

        $order = Order::create([
            'reference' => Order::generateReference(),
            'shipping_id' => $this->shipping_id,
            'delivery_method' => $shipping->name,
            'payment_method' => $this->payment_method,
            'shipping_cost' => $shipping->cost,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'phone' => $this->phone,
            'total' => Cart::total(),
            'user_id' => auth()->user()->id,
            'order_status' => Order::STATUS_PENDING,
            'payment_status' => Order::PAYMENT_STATUS_PENDING,
        ]);

        foreach (Cart::content() as $item) {
            $order->orderItems()->create([
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        Cart::destroy();

        $this->alert('success', __('Order placed successfully!'));

        return redirect()->route('front.thankyou');
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

        $this->subTotal = Cart::instance('shopping')->subtotal();

        $this->tax = Cart::instance('shopping')->tax();
        
        $this->shipping = Shipping::find($this->shipping_id);

        $this->payment_method = 'cash';

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
