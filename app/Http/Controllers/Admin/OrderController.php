<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Order;
use Illuminate\Http\Request;

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

        return view('admin.order.details', compact('order', 'cart'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);

        return view('admin.order.invoice', compact('order', 'cart'));
    }

}
