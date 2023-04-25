<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Order Confirmation for ')}} {{ $user->name }}</title>
</head>
<body>
    <h1>{{__('Order Confirmation for ')}} {{ $user->name }}</h1>
    <p>{{__('Thank you for order!')}}</p>
    <p>{{__('Here are the details of your order')}}:</p>
    <ul>
        <li>{{__('Order Number')}}: {{ $order->id }}</li>
        <li>{{__('Order Date')}}: {{ $order->created_at }}</li>
        <li>{{__('Shipping Method')}}: {{ $order->delivery_method }}</li>
        <li>{{__('Payment Method')}}: {{ $order->payment_method }}</li>
        <li>{{__('Shipping Address')}}: {{ $order->shipping_address }}</li>
        <li>{{__('Billing Address')}}: {{ $order->billing_address }}</li>
        <li>{{__('Items Ordered')}}:</li>
        <ul>
            @foreach ($order->order_products as $order_product)
                <li>{{ $order_product->product->name }} x {{ $order_product->qty }}</li>
            @endforeach
        </ul>
        <li>{{__('Subtotal')}}: {{ $order->subtotal }}</li>
        <li>{{__('Tax')}}: {{ $order->tax }}</li>
        <li>{{__('Shipping')}}: {{ $order->shipping }}</li>
        <li>{{__('Total')}}: {{ $order->total }}</li>
    </ul>
    <p>{{__('Your order has been shipped and you will receive an email with tracking information shortly.')}}</p>
    <p>{{__('Thank you for shopping with us!')}}</p>
</body>
</html>