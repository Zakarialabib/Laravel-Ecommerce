<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('New Order Form')}}</title>
</head>
<body>
    <h1>{{__('New Order Form')}}</h1>
    <p>{{__('A new order form has been submitted')}}.</p>
    <p>{{__('Here are the details')}}:</p>
    <ul>
        <li>{{__('Name')}}: {{ $order->name }}</li>
        <li>{{__('Phone')}}: {{ $order->phone }}</li>
        <li>{{__('Address')}}: {{ $order->address }}</li>
    </ul>
    <p>{{__('Thank you for your order!')}}</p>
</body>
</html>