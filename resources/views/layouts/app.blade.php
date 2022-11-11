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

    <meta name="title" content="{{ Helpers::settings('seo_meta_title') }}">
    <meta name="description" content="{{ Helpers::settings('seo_meta_description') }}">
    <meta property="og:description" content="{{ Helpers::settings('seo_meta_description') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('front.index') }}" />
    <meta property="og:site_name" content="{{ Helpers::settings('company_name') }}" />
    <meta name="author" content="{{ Helpers::settings('company_name') }}">

    <meta name="robots" content="all,follow">

    <link rel="icon" href="{{ asset('images/' . Helpers::settings('site_favicon')) }}" type="image/x-icon">
    
    {{-- Styles --}}
    @vite('resources/css/app.css')
    
    @livewireStyles
    
    @stack('styles')
     <!-- Head Tags -->

     @if ( Helpers::settings('head_tags') != null)

     {!! Helpers::settings('head_tags') !!}
     
     @endif
 
</head>
<body class="antialiased bg-body text-body font-body" x-data="{ showCart: false }">
    <!-- Body Tags -->
 
    @if ( Helpers::settings('body_tags') != null )
 
    {!! Helpers::settings('body_tags') !!}
    
    @endif

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
        