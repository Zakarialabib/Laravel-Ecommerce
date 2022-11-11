<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Cart,
    Models\User,
    Models\Order,
    Models\Product,
    Models\OrderTrack,
    Models\Generalsetting
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class OrderController extends Controller
{

    public function index()
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

 
}
