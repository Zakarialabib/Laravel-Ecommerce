<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="preconnect" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="prefetch" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="prerender" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="preload" href="{{ request()->getSchemeAndHttpHost() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Head Tags -->
    @if (Helpers::settings('head_tags'))
        {!! Helpers::settings('head_tags') !!}
    @endif

    <title>
        @yield('title') || {{ Helpers::settings('site_title') }}
    </title>


    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="title" content="{{ Helpers::settings('seo_meta_title') }}">
        <meta name="description" content="{{ Helpers::settings('seo_meta_description') }}">
        <meta property="og:title" content="{{ Helpers::settings('site_title') }}">
        <meta property="og:description" content="{{ Helpers::settings('seo_meta_description') }}">
        <meta property="og:url" content="{{ route('front.index') }}" />
    @endif

    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ Helpers::settings('company_name') }}" />
    <meta name="author" content="{{ Helpers::settings('company_name') }}">
    {{-- <link rel="canonical" href="{{ URL::current() }}"> --}}
    <meta name="robots" content="all,follow">

    <link rel="icon" href="{{ asset('images/' . Helpers::settings('site_favicon')) }}" type="image/x-icon">

    {{-- Styles --}}
    @vite('resources/css/app.css')

    @livewireStyles

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    @stack('styles')
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-body font-body" x-data="{ showCart: false }">
    <!-- Body Tags -->

    @if (Helpers::settings('body_tags'))
        {!! Helpers::settings('body_tags') !!}
    @endif
    
    <section class="relative">

        <x-topheader />

        <x-header />

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset

        <x-footer />

        <x-whatsapp />

    </section>

    @vite('resources/js/app.js')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')
    <x-core-web-vital-core-web-component/>
</body>

</html>
