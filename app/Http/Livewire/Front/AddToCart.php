<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AddToCart extends Component
{
    use LivewireAlert;

    public $product;

    public $product_id;

    public $product_name;

    public $product_price;

    public $product_qty;

    public $quantity = 1;

    public $listeners = [
        'AddToCart',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function AddToCart(Product $product_id)
    {
        Cart::instance('shopping')->add($product_id, $this->quantity)->associate('App\Models\Product');

        $this->emit('cartCountUpdated');

        // If the user cancels the confirmation, display a success message using Livewire's `alert` method
        $this->alert(
            'success',
            __('Product added to cart successfully!'),
            [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
                'confirmButtonText' => 'Ok',
                'cancelButtonText' => 'Cancel',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]
        );
    }

    public function render(): View|Factory
    {
        return view('livewire.front.add-to-cart');
    }
}
