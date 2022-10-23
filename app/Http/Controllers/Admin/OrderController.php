<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Cart,
    Models\User,
    Models\Order,
    Models\Product,
    Models\OrderTrack,
    Classes\GeniusMailer,
    Models\Generalsetting
};
use Illuminate\Http\Request;
use Datatables;
use Session;

class OrderController extends AdminBaseController
{
    //*** GET Request
    public function index(Request $request)
    {
        return view('admin.order.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('admin.order.details',compact('order','cart'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('admin.order.invoice',compact('order','cart'));
    }

    public function emailsub(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = [
                    'to' => $request->to,
                    'subject' => $request->subject,
                    'body' => $request->message,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);                
        }
        else
        {
            $data = 0;
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            $mail = mail($request->to,$request->subject,$request->message,$headers);
            if($mail) {   
                $data = 1;
            }
        }

        return response()->json($data);
    }

    public function printpage($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('admin.order.print',compact('order','cart'));
    }

    public function license(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        $cart['items'][$request->license_key]['license'] = $request->license;
        $new_cart = json_encode($cart);
        $order->cart = $new_cart;
        $order->update();       
        $msg = __('Successfully Changed The License Key.');
        return redirect()->back()->with('license',$msg);
    }

    public function edit($id)
    {
        $data = Order::find($id);
        return view('admin.order.delivery',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Logic Section
        $data = Order::findOrFail($id);
        $gs = Generalsetting::findOrFail(1);
        $input = $request->all();
        if($request->has('status')){
            if ($data->status == "completed"){

                // Then Save Without Changing it.
                    $input['status'] = "completed";
                    $data->update($input);
                    //--- Logic Section Ends
            
                //--- Redirect Section          
                $msg = __('Status Updated Successfully.');
                return response()->json($msg);    
                //--- Redirect Section Ends     

                }else{
                if ($input['status'] == "completed"){
        
                    foreach($data->vendororders as $vorder)
                    {
                        $uprice = User::find($vorder->user_id);
                        $uprice->current_balance = $uprice->current_balance + $vorder->price;
                        $uprice->update();
                    }

                    if( User::where('id', $data->affilate_user)->exists() ){
                        $auser = User::where('id', $data->affilate_user)->first();
                        $auser->affilate_income += $data->affilate_charge;
                        $auser->update();
                    }

                    if( $data->affilate_users != null ){
                        $ausers = json_decode($data->affilate_users, true);
                        foreach($ausers as $auser){
                            $user = User::find($auser['user_id']);
                            if($user){
                                $user->affilate_income += $auser['charge'];
                                $user->update();
                            }
                        }
                    }

                    $maildata = [
                        'to' => $data->customer_email,
                        'subject' => 'Your order '.$data->order_number.' is Confirmed!',
                        'body' => "Hello ".$data->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.",
                    ];
        
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);                

                } if ($input['status'] == "declined"){

                    // Refund User Wallet If Any
                    if($data->user_id != 0){
                        if($data->wallet_price != 0){
                            $user = User::find($data->user_id);
                            if( $user ){
                                $user->balance = $user->balance + $data->wallet_price;
                                $user->save();
                            }
                        }
                    }

                    $cart = json_decode($data->cart, true);

                    // Restore Product Stock If Any
                    foreach($cart->items as $prod)
                    {
                        $x = (string)$prod['stock'];
                        if($x != null)
                        {
            
                            $product = Product::findOrFail($prod['item']['id']);
                            $product->stock = $product->stock + $prod['qty'];
                            $product->update();               
                        }
                    }

                    // Restore Product Size Qty If Any
                    foreach($cart->items as $prod)
                    {
                        $x = (string)$prod['size_qty'];
                        if(!empty($x))
                        {
                            $product = Product::findOrFail($prod['item']['id']);
                            $x = (int)$x;
                            $temp = $product->size_qty;
                            $temp[$prod['size_key']] = $x;
                            $temp1 = implode(',', $temp);
                            $product->size_qty =  $temp1;
                            $product->update();               
                        }
                    }

                    $maildata = [
                        'to' => $data->customer_email,
                        'subject' => 'Your order '.$data->order_number.' is Declined!',
                        'body' => "Hello ".$data->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);
                    
                }

                $data->update($input);

                if($request->track_text)
                {
                        $title = ucwords($request->status);
                        $ck = OrderTrack::where('order_id','=',$id)->where('title','=',$title)->first();
                        if($ck){
                            $ck->order_id = $id;
                            $ck->title = $title;
                            $ck->text = $request->track_text;
                            $ck->update();  
                        }
                        else {
                            $data = new OrderTrack;
                            $data->order_id = $id;
                            $data->title = $title;
                            $data->text = $request->track_text;
                            $data->save();            
                        }    
                } 

            //--- Redirect Section          
            $msg = __('Status Updated Successfully.');
            return response()->json($msg);    
            //--- Redirect Section Ends    
        
            }
        }

        $data->update($input);
        //--- Redirect Section          
        $msg = __('Data Updated Successfully.');
        return redirect()->back()->with('success',$msg);    
        //--- Redirect Section Ends  

    }

    public function product_submit(Request $request)
    {
       
        $order_id = $request->order_id;
        $order = Order::find($order_id);
        $sku = $request->sku;
        $product = Product::whereStatus(1)->where('sku',$sku)->first();
        $data = array();
        if(!$product){
            $data[0] = false;
            $data[1] = __('No Product Found');
        }else{
            $data[0] = true;
            $data[1] = $product->id;
        }
        return response()->json($data);
    }

    public function product_show($id)
    {
        $data['productt'] = Product::find($id);
        $data['curr'] = $this->curr;
        return view('admin.order.add-product',$data);
    }

    public function addcart($id)
    {
       
        $order = Order::find($id);
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ','-',$_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (double)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $affilate_user = isset($_GET['affilate_user']) ? $_GET['affilate_user'] : '0';
        $keys =  $_GET['keys'];
        $keys = explode(",",$keys);
        $values = $_GET['values'];
        $values = explode(",",$values);
        $prices = $_GET['prices'];
        $prices = explode(",",$prices);
        $keys = $keys == "" ? '' : implode(',',$keys);
        $values = $values == "" ? '' : implode(',',$values );
        $size_price = ($size_price / $order->currency_value);
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes','minimum_qty']);

        if($prod->user_id != 0){
        $prc = $prod->price + $this->gs->fixed_commission + ($prod->price/100) * $this->gs->percentage_commission;
        $prod->price = round($prc,2);
        }
        if(!empty($prices)){
            if(!empty($prices[0])){
                foreach($prices as $data){
                    $prod->price += ($data / $order->currency_value);
                }
            }
        }

        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        if(empty($size))
        {
            if(!empty($prod->size))
            { 
            $size = trim($prod->size[0]);
            } 
            $size = str_replace(' ','-',$size);          
        }
 
        if(empty($color))
        {
            if(!empty($prod->color))
            { 
            $color = $prod->color[0];
                    
            }          
        }
        $color = str_replace('#','',$color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        if(!empty($cart->items)){
            if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)])){
                $minimum_qty = (int)$prod->minimum_qty;
                if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] < $minimum_qty ){
                    return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                }
            }
            else{
                if($prod->minimum_qty != null){
                    $minimum_qty = (int)$prod->minimum_qty;
                    if($qty < $minimum_qty){
                        return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                    } 
                }
            }
        }else{
            $minimum_qty = (int)$prod->minimum_qty;
            if($prod->minimum_qty != null){
                if($qty < $minimum_qty){
                    return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                } 
            }
        }
        
        $cart->addnum($prod, $prod->id, $qty, $size,$color,$size_qty,$size_price,$size_key,$keys,$values,$affilate_user);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return redirect()->back()->with('unsuccess',__('This item is already in the cart.'));
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return redirect()->back()->with('unsuccess',__('Out Of Stock.'));
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return redirect()->back()->with('unsuccess',__('Out Of Stock.'));
            }           
        }

        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];       
        $o_cart = json_decode($order->cart, true);

        $order->totalQty = $order->totalQty + $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
        $order->pay_amount = $order->pay_amount + $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];

        $prev_qty = 0;
        $prev_price = 0;

        if(!empty($o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)])){
            $prev_qty = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
            $prev_price = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];
        }

        $prev_qty += $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
        $prev_price += $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];

        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)] = $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)];
        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] = $prev_qty;
        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'] = $prev_price;
        $order->cart = json_encode($o_cart);
        $order->update();
        return redirect()->back()->with('success',__('Successfully Added To Cart.'));
    } 


    public function product_edit($id,$itemid,$orderid)
    {

        $product = Product::find($itemid);
        $order = Order::find($orderid);
        $cart = json_decode($order->cart, true);
        $data['productt'] = $product;
        $data['item_id'] = $id;
        $data['prod'] = $id;
        $data['order'] = $order;
        $data['item'] = $cart['items'][$id];
        $data['curr'] = $this->curr;

        return view('admin.order.edit-product',$data);
    }


    public function updatecart($id)
    {
        $order = Order::find($id);
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ','-',$_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (double)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $affilate_user = isset($_GET['affilate_user']) ? $_GET['affilate_user'] : '0';
        $keys =  $_GET['keys'];
        $keys = explode(",",$keys);
        $values = $_GET['values'];
        $values = explode(",",$values);
        $prices = $_GET['prices'];
        $prices = explode(",",$prices);
        $keys = $keys == "" ? '' : implode(',',$keys);
        $values = $values == "" ? '' : implode(',',$values );

        $item_id = $_GET['item_id'];


        $size_price = ($size_price / $order->currency_value);
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes','minimum_qty']);

        if($prod->user_id != 0){
        $prc = $prod->price + $this->gs->fixed_commission + ($prod->price/100) * $this->gs->percentage_commission;
        $prod->price = round($prc,2);
        }
        if(!empty($prices)){
            if(!empty($prices[0])){
                foreach($prices as $data){
                    $prod->price += ($data / $order->currency_value);
                }
            }
        }

        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        if(empty($size))
        {
            if(!empty($prod->size))
            { 
            $size = trim($prod->size[0]);
            } 
            $size = str_replace(' ','-',$size);          
        }
 
        if(empty($color))
        {
            if(!empty($prod->color))
            { 
            $color = $prod->color[0];
                    
            }          
        }
        $color = str_replace('#','',$color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        if(!empty($cart->items)){
            if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)])){
                $minimum_qty = (int)$prod->minimum_qty;
                if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] < $minimum_qty ){
                    return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                }
            }
            else{
                if($prod->minimum_qty != null){
                    $minimum_qty = (int)$prod->minimum_qty;
                    if($qty < $minimum_qty){
                        return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                    } 
                }
            }
        }else{
            $minimum_qty = (int)$prod->minimum_qty;
            if($prod->minimum_qty != null){
                if($qty < $minimum_qty){
                    return redirect()->back()->with('unsuccess',__('Minimum Quantity is:').' '.$prod->minimum_qty);
                } 
            }
        }
        
        $cart->addnum($prod, $prod->id, $qty, $size,$color,$size_qty,$size_price,$size_key,$keys,$values,$affilate_user);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return redirect()->back()->with('unsuccess',__('This item is already in the cart.'));
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return redirect()->back()->with('unsuccess',__('Out Of Stock.'));
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return redirect()->back()->with('unsuccess',__('Out Of Stock.'));
            }           
        }

        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];       
        $o_cart = json_decode($order->cart, true);

        if(!empty($o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)])){

            $cart_qty = $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
            $cart_price =  $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];

            $prev_qty = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
            $prev_price = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];

            $temp_qty = 0;
            $temp_price = 0;

            if($o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] < $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty']){

                $temp_qty = $cart_qty - $prev_qty;
                $temp_price = $cart_price - $prev_price;

                $order->totalQty += $temp_qty;
                $order->pay_amount += $temp_price;
                $prev_qty += $temp_qty;
                $prev_price += $temp_price;

            }elseif($o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty']){

                $temp_qty = $prev_qty - $cart_qty;
                $temp_price = $prev_price - $cart_price;

                $order->totalQty -= $temp_qty;
                $order->pay_amount -= $temp_price;
                $prev_qty -= $temp_qty;
                $prev_price -= $temp_price;

            }

        }
        else{

            $order->totalQty -= $o_cart['items'][$item_id]['qty'];

            $order->pay_amount -= $o_cart['items'][$item_id]['price'];

            unset($o_cart['items'][$item_id]);



            $order->totalQty = $order->totalQty + $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
            $order->pay_amount = $order->pay_amount + $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];
    
            $prev_qty = 0;
            $prev_price = 0;
    
            if(!empty($o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)])){
                $prev_qty = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
                $prev_price = $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];
            }
    
            $prev_qty += $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'];
            $prev_price += $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'];


        }

        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)] = $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)];
        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] = $prev_qty;
        $o_cart['items'][$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['price'] = $prev_price;

        $order->cart = json_encode($o_cart);

        $order->update();
        return redirect()->back()->with('success',__('Successfully Updated The Cart.'));

    } 


    public function product_delete($id,$orderid)
    {


        $order = Order::find($orderid);
        $cart = json_decode($order->cart, true);

        $order->totalQty = $order->totalQty - $cart['items'][$id]['qty'];
        $order->pay_amount = $order->pay_amount - $cart['items'][$id]['price'];
        unset( $cart['items'][$id]);
        $order->cart = json_encode($cart);

        $order->update();


        return redirect()->back()->with('success',__('Successfully Deleted From The Cart.'));
    }


}
