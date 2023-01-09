<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentGateway;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;

    public $listeners = [
        'checkout'            => 'checkout',
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
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
            'first_name'  => 'required',
            'phone'       => 'required',
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
            'total'            => $this->cartTotal,
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

        if ($this->payment_method == 'paypal') {
            $cartItems = Cart::instance('shopping')->content();

            $product['items'] = [
                [
                    'name'  => 'Nike Joyride 2',
                    'price' => 112,
                    'desc'  => 'Running shoes for Men',
                    'qty'   => 2,
                ],
            ];

            $product['order_id'] = 1;
            $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
            $product['return_url'] = route('success.payment');
            $product['cancel_url'] = route('cancel.payment');
            $product['total'] = 224;

            $paypalModule = new ExpressCheckout();

            $res = $paypalModule->setExpressCheckout($product);
            $res = $paypalModule->setExpressCheckout($product, true);

            return redirect($res['paypal_link']);
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
        $this->cartTotal = $this->calculateCartTotal();
    }

    public function calculateCartTotal()
    {
        $total = Cart::instance('shopping')->total();
        $shipping = Shipping::find($this->shipping_id);
        $cost = $shipping->cost;
        $this->cartTotal = $total + $cost;

        return $this->cartTotal;
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
                'position'          => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'confirm',
                'onConfirmed'       => 'confirmed',
                'showCancelButton'  => true,
                'cancelButtonText'  => 'cancel',
            ]
        );
    }

    public function getShippingsProperty()
    {
        return Shipping::select('id', 'title')->get();
    }

    public function getPaymentMethodsProperty()
    {
        return PaymentGateway::active()->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.checkout');
    }
}
