<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductShow extends Component
{
    use LivewireAlert;

    public $product;
    public $relatedProducts;
    public $brand;
    public $category;
    public $quantity = 1;
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_qty;

    public $listeners = [
        'AddToCart'
    ];

    public $decreaseQuantity;
    public $increaseQuantity;

    public function decreaseQuantity()
    {
        $this->quantity = $this->quantity - 1;
    }

    public function increaseQuantity()
    {
        $this->quantity = $this->quantity + 1;
    }

     public function AddToCart($product_id)
    {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->product_name = $product->name;
        $this->product_price = $product->price;
        $this->product_qty = $this->quantity;

        Cart::instance('shopping')->add($this->product_id, $this->product_name, $this->product_qty, $this->product_price)->associate('Product');
        
        $this->emit('cartCountUpdated');

        $this->alert('success', __('Product Add to Cart successfully...!!'));
    }

    public function mount(Product $product)
    {
        $this->product = $product;


        $this->relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        $this->brand = Brand::where('id', $product->brand_id)->first();
        $this->category = Category::where('id', $product->category_id)->first();

    }

    public function render()
    {
        
        return view('livewire.front.product-show');
    }
}
