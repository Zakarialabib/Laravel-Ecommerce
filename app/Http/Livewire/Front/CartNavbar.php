<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;

class CartNavbar extends Component
{
    public function addToCartNav($id)
    {
        $products = Product::findOrFail($id);
           
        $cart = session()->get('cart', []);
        
   
        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "id"=>$products->id,
                "name" => $products->name,
                "qty" => 1,
                "order_amount" => $products->order_amount,
                
            ];
        }
          
        session()->put('cart', $cart);
    
        
        
        $this->emit('increment');
        $this->emit('some-event');
        
    }
    
    public function removeFromCartNav($id){
        $products = Product::findOrFail($id);
           
        $cart = session()->get('cart', []);
        $itemId=$cart[$id]['qty'];

        
   
        if(isset($cart[$id]) && $cart[$id]['qty'] > "1") {
            $cart[$id]['qty']--;
        } 
        elseif($itemId== 1){
           
                unset($cart[$id]);
            }
        
        
        else {
            $cart[$id] = [
                "id"=>$products->id,
                "name" => $products->name,
                "qty" => 1,
                "order_amount" => $products->order_amount,
            
                
            ];
        }
          
        session()->put('cart', $cart);


        $this->emit('decrement');
        $this->emit('some-event');
    }  
    public function render()
    {
        return view('livewire.cart-navbar');
    }
}