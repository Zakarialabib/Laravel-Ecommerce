<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to our store!</title>
</head>
<body>
    <h1>Welcome to our store!</h1>
    <p>Thank you for creating an account with us. We are excited to have you as a customer.</p>
    <p>Here is your account information:</p>
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Password: {{ $user->password }}</li>
    </ul>
    <p>Please keep this information safe for future reference.</p>
    <p>You can <a href="{{ route('account') }}">login to your account</a> here.</p>
    <p>We hope you enjoy shopping with us!</p>
</body>
</html>