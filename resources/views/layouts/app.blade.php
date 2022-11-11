<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>
        @yield('title') || {{ Helpers::settings('site_title') }}
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if( Helpers::settings('site_title') )
        <meta name="title" content="{{ Helpers::settings('site_title') }}">
    @else
    <meta name="title" content="@yield('meta_title')">
    @endif

    <link rel="icon" href="{{ asset('images/settings' . Helpers::settings('site_favicon')) }}" type="image/x-icon">
    
    {{-- Styles --}}
    @vite('resources/css/app.css')
    
    @livewireStyles
    
    @stack('styles')
    
</head>
<body class="antialiased bg-body text-body font-body" x-data="{ showCart: false }">
    <div class="">
                
      <section class="relative">
       <x-header />

       @yield('content')

       @isset($slot)
       {{ $slot }}
        @endisset
       
       <x-footer />

        </section>
    </div>
    @vite('resources/js/app.js')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')
</body>
</html>
        