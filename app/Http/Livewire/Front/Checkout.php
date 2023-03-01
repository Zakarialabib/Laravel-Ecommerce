<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;

    public $listeners = [
        'checkout' => 'checkout',
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
    ];

    public $decreaseQuantity;

    public $increaseQuantity;

    public $removeFromCart;

    public $payment_method = 'cash';

    public $shipping_cost;

    public $first_name;

    public $last_name;

    public $email;

    public $address;

    public $city;

    public $shipping;

    public $country = 'Maroc';

    public $phone;

    public $password;

    public $total;

    public $order_status;

    public $shipping_id;

    public $cartTotal;

    public $productId;

    public function confirmed()
    {
        Cart::instance('shopping')->remove($this->productId);
        $this->emit('cartCountUpdated');
        $this->emit('checkoutCartUpdated');
    }

    public function getCartItemsProperty()
    {
        return Cart::instance('shopping')->content();
    }

    public function getSubTotalProperty()
    {
        return Cart::instance('shopping')->subtotal();
    }

    public function checkout()
    {
        $this->validate([
            'shipping_id' => 'required',
            'first_name' => 'required',
            'phone' => 'required',
        ]);

        if (Cart::instance('shopping')->count() === 0) {
            $this->alert('error', __('Your cart is empty'));
        }

        $shipping = Shipping::find($this->shipping_id);

        if (! auth()->check()) {
            $user = User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'city' => $this->city,
                'country' => $this->country,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            Auth::login($user);
        }

        $order = Order::create([
            'reference' => Order::generateReference(),
            'shipping_id' => $this->shipping_id,
            'delivery_method' => $shipping->title,
            'payment_method' => $this->payment_method,
            'shipping_cost' => $shipping->cost,
            'first_name' => $this->first_name,
            'shipping_name' => $this->first_name.'-'.$this->last_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'shipping_address' => $this->address,
            'city' => $this->city,
            'shipping_city' => $this->city,
            'phone' => $this->phone,
            'shipping_phone' => $this->phone,
            'total' => $this->cartTotal,
            'user_id' => auth()->user()->id,
            'order_status' => Order::STATUS_PENDING,
            'payment_status' => Order::PAYMENT_STATUS_PENDING,
        ]);

        foreach (Cart::instance('shopping') as $item) {
            $orderProduct = new OrderProduct([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'qty' => $item->qty,
                'price' => $item->price,
                'user_id' => auth()->user()->id,
                'total' => $item->total,
            ]);

            $orderProduct->save();
        }

        Cart::instance('shopping')->destroy();

        $this->alert('success', __('Order placed successfully!'));

        return redirect()->route('front.thankyou', ['order' => $order->id]);
    }

    public function updatedShippingId($value)
    {
        if ($value) {
            $this->shipping = Shipping::find($value);
        }
    }

    public function updateCartTotal()
    {
        if ($this->shipping_id) {
            $shipping = Shipping::find($this->shipping_id);
            $cost = $shipping->cost;
            $total = Cart::instance('shopping')->total();

            if ($cost > 0) {
                $this->cartTotal = $total + $cost;
            } else {
                $this->cartTotal = $total;
            }
        }
    }

      public function decreaseQuantity($rowId)
      {
          $cartItem = Cart::instance('shopping')->get($rowId);
          $qty = $cartItem->qty - 1;
          Cart::instance('shopping')->update($rowId, $qty);
          $this->emit('checkoutCartUpdated');
      }

    public function increaseQuantity($rowId)
    {
        $cartItem = Cart::instance('shopping')->get($rowId);
        $qty = $cartItem->qty + 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('checkoutCartUpdated');
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

    public function getShippingsProperty()
    {
        return Shipping::select('id', 'title')->get();
    }

    public function getCartTotalProperty()
    {
        return Cart::instance('shopping')->total();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.checkout');
    }
}
