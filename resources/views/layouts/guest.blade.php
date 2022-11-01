<!DOCTYPE html>
<html x-data="mainState" :class="{ dark: isDarkMode }" class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') || {{ config('app.name') }}</title>
    <!-- Styles -->

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">

    @vite('resources/css/app.css')

</head>

<body class="antialiased bg-body text-body font-body" dir="rtl">
    <main>
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>

</html>
