<!DOCTYPE html>
<html x-data="mainState" :class="{ dark: isDarkMode, rtl: isRtl }" class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>
        @yield('title') || {{ Helpers::settings('site_title') }}
    </title>
    <!-- Styles -->
   
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/' . Helpers::settings('site_favicon')) }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.css" integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

    @vite('resources/css/app.css')
    @stack('styles')

</head>

<body class="antialiased bg-body text-body font-body"  dir="ltr">
    <div @resize.window="handleWindowResize">
        <div class="min-h-screen">
            <!-- Sidebar -->
            <x-sidebar.sidebar />
            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen pl-2"
                :class="{
                    'lg:ml-64': isSidebarOpen,
                    'lg:ml-16': !isSidebarOpen,
                }"
                style="transition-property: margin; transition-duration: 150ms;">

                <!-- Navigation Bar-->
                <x-navbar />

                <main class="pt-5 flex-1">
                    @yield('content')
                    @isset($slot)
                    {{ $slot }}
                    @endisset
                </main>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @vite('resources/js/app.js')

    @livewireScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.js" integrity="sha512-sa449wQ9TM6SvZV7TK7Zx/SjVR6bc7lR8tRz1Ar4/R6X2jOLaFln/9C+6Ak2OkAKZ/xBAKJ94dQMeYa0JT1RLg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('sweetalert::alert')

    <x-livewire-alert::scripts />

    @stack('scripts')
    

</body>

</html>
