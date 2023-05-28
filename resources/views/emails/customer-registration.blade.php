<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Welcome to')}} {{ Helpers::settings('site_title') }}!</title>
</head>
<body>
    <h1>{{__('Welcome to')}} {{ Helpers::settings('site_title') }}!</h1>
    <p>{{__('Thank you for creating an account with us. We are excited to have you as a customer')}}.</p>
    <p>{{__('Here is your account information')}}:</p>
    <ul>
        <li>{{__('Name')}}: {{ $user->name }}</li>
        <li>{{__('Email')}}: {{ $user->email }}</li>
        <li>{{__('Password')}}: {{ $user->password }}</li>
    </ul>
    <p>{{__('Please keep this information safe for future reference')}}.</p>
    <p>{{__('You can')}} <a href="{{ route('mon-compte') }}">{{__('login to your account')}}</a></p>
    <p>{{__('We hope you enjoy shopping with us')}}!</p>
</body>
</html>