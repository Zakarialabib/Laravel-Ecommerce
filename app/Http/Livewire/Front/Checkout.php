<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Checkout extends Component
{
    use LivewireAlert;

    public $listeners = [
        'checkout'            => 'checkout',
        'checkoutCartUpdated' => '$refresh',
    ];

    public $decreaseQuantity;

    public $increaseQuantity;

    public $removeFromCart;

    public $payment_method;

    public $shipping_cost;

    public $first_name;

    public $last_name;

    public $email;

    public $address;

    public $city;

    public $country = 'Maroc';

    public $phone;

    public $password;

    public $total;

    public $order_status;

    public $shipping_id;

    public $listsForFields = [];

    public function checkout()
    {
        $this->validate([
            'shipping_id' => 'required',
            'first_name'  => 'required',
            'phone' => 'required',
        ]);

        if (Cart::instance('shopping')->count() == 0) {
            $this->alert('error', __('Your cart is empty'));
        }

        $shipping = Shipping::find($this->shipping_id);

        $order = Order::create([
            'reference'        => Order::generateReference(),
            'shipping_id'      => $this->shipping_id,
            'delivery_method'  => $shipping->title,
            'payment_method'   => $this->payment_method,
            'shipping_cost'    => $shipping->cost,
            'first_name'       => $this->first_name,
            'shipping_name'    => $this->first_name.'-'.$this->last_name,
            'last_name'        => $this->last_name,
            'email'            => $this->email,
            'address'          => $this->address,
            'shipping_address' => $this->address,
            'city'             => $this->city,
            'shipping_city'    => $this->city,
            'phone'            => $this->phone,
            'shipping_phone'   => $this->phone,
            'total'            => floatval(Cart::instance('shopping')->total()),
            'user_id'          => auth()->user()->id,
            'order_status'     => Order::STATUS_PENDING,
            'payment_status'   => Order::PAYMENT_STATUS_PENDING,
        ]);

        foreach (Cart::instance('shopping') as $order) {
            $orderProduct = new OrderProduct([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $order->qty,
                'price'      => $order->price,
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
            $cost = floatval($this->shipping->cost);

            if ($this->shipping->is_pickup) {
                $cartTotal = Cart::instance('shopping')->total();
            } else {
                $total = floatval(Cart::instance('shopping')->total());
                $cartTotal = $total + $cost;
            }
        } else {
            $cartTotal = Cart::instance('shopping')->total();
        }
        $this->emit('cartTotalUpdated', $cartTotal);
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
        } catch (Exception $e) {
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

    public function getShippingProperty()
    {
        return Shipping::find($this->shipping_id);
    }

    public function mount()
    {
        $this->cartTotal = Cart::instance('shopping')->total();

        $this->cartItems = Cart::instance('shopping')->content();

        $this->subTotal = Cart::instance('shopping')->subtotal();

        $this->payment_method = 'cash';

        $this->initListsForFields();
    }


    public function render(): View|Factory
    {
        return view('livewire.front.checkout');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['shippings'] = Shipping::pluck('title', 'id')->toArray();
    }
}
