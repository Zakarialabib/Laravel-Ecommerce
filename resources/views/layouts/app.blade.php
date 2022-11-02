<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $site_title = \App\Models\Settings::get('key', 'site_title');
        $site_description = \App\Models\Settings::get('key', 'site_description');
        $site_keywords = \App\Models\Settings::get('key', 'site_keywords');
        $site_logo = \App\Models\Settings::get('key', 'site_logo');
        $site_favicon = \App\Models\Settings::get('key', 'site_favicon');
    @endphp
    <title>
        @yield('title') - 
        @if($site_title)
            {{ $site_title }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($site_title)
        <meta name="title" content="{{ $site_title }}">
    @else
    <meta name="title" content="@yield('meta_title')">
    @endif
  
    @if($site_favicon)
        <link rel="icon" href="{{ asset('storage/'.$site_favicon) }}" type="image/x-icon">
    @else
    <link rel="icon" type="image/png" sizes="32x32" href="shuffle-for-tailwind.png">
    @endif

    {{-- Styles --}}
    @vite('resources/css/app.css')
    @livewireStyles
    @stack('styles')
    
    
</head>
<body class="antialiased bg-body text-body font-body">
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
        