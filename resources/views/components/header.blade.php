<section class="relative">
    <nav class="flex justify-between bg-gray-100 border-b">
        <div class="px-12 py-8 flex w-full items-center">
            <a class="lg:mr-8 2xl:mr-20 text-3xl font-bold font-heading" href="{{ route('front.index') }}">
                {{ App\Helpers::settings('site_title') }}
                {{-- <img class="h-9" src="{{ App\Helpers::settings('site_logo') }}" alt="" width="auto"> --}}
            </a>

            <ul class="hidden xl:flex px-4 mx-auto font-semibold font-heading">
                <li class="mr-12"><a class="hover:text-gray-600" href="{{ route('front.categories') }}">
                        {{ __('Categories') }}
                    </a>
                </li>
                <li class="mr-12"><a class="hover:text-gray-600" href="{{ route('front.catalog') }}">
                        {{ __('Catalog') }}
                    </a>
                </li>
                <li><a class="hover:text-gray-600" href="{{ route('front.brands') }}">
                        {{ __('Brands') }}
                    </a>
                </li>
            </ul>
            <div class="hidden xl:flex items-center">

                @include('partials.front.search-box')

                <livewire:front.cart-count />
                
            </div>
        </div>
        @if (Auth::check())
            <x-dropdown align="right" width="60">
                <x-slot name="trigger">
                    <div class="py-8 px-6 flex w-full items-center">
                        <span class="bg-orange-500 rounded-md text-center text-white">
                            {{ Auth::user()->first_name }}
                        </span>
                    </div>
                </x-slot>

                <x-slot name="content">
                    {{-- if admin show dashboard and settings else show logout --}}
                    @if (auth()->user()->is_admin)
                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('admin.settings')">
                            {{ __('Settings') }}
                        </x-dropdown-link>
                    @endif

                    {{-- <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link> --}}

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @else
            <button class="flex-shrink-0 hidden xl:block px-8 border-l">
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="mr-2 font-medium">{{ __('Login') }} </a>
                    {{ __('or') }}
                    <a href="{{ route('register') }}" class="ml-2 font-medium"> {{ __('Register') }}</a>
                </div>
            </button>
        @endif
        <a class="xl:hidden flex mr-6 items-center text-gray-600" href="#">
            <svg class="mr-2" width="23" height="23" viewbox="0 0 23 23" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                    d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span class="inline-block w-6 h-6 text-center bg-white rounded-full font-semibold font-heading">3</span>
        </a>
        <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
            <svg width="20" height="12" viewbox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1 2H19C19.2652 2 19.5196 1.89464 19.7071 1.70711C19.8946 1.51957 20 1.26522 20 1C20 0.734784 19.8946 0.48043 19.7071 0.292893C19.5196 0.105357 19.2652 0 19 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1C0 1.26522 0.105357 1.51957 0.292893 1.70711C0.48043 1.89464 0.734784 2 1 2ZM19 10H1C0.734784 10 0.48043 10.1054 0.292893 10.2929C0.105357 10.4804 0 10.7348 0 11C0 11.2652 0.105357 11.5196 0.292893 11.7071C0.48043 11.8946 0.734784 12 1 12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10ZM19 5H1C0.734784 5 0.48043 5.10536 0.292893 5.29289C0.105357 5.48043 0 5.73478 0 6C0 6.26522 0.105357 6.51957 0.292893 6.70711C0.48043 6.89464 0.734784 7 1 7H19C19.2652 7 19.5196 6.89464 19.7071 6.70711C19.8946 6.51957 20 6.26522 20 6C20 5.73478 19.8946 5.48043 19.7071 5.29289C19.5196 5.10536 19.2652 5 19 5Z"
                    fill="#8594A5"></path>
            </svg>
        </a>
    </nav>
    </div>
    <div class="hidden navbar-menu fixed top-0 left-0 bottom-0 w-5/6 max-w-sm z-50">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav class="relative flex flex-col py-6 px-6 w-full h-full bg-white border-r overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-3xl font-bold font-heading" href="#">
                    <img class="h-9" src="yofte-assets/logos/yofte-logo.svg" alt="" width="auto">
                </a>
                <button class="navbar-close">
                    <svg class="h-2 w-2 text-gray-500 cursor-pointer" width="10" height="10" viewbox="0 0 10 10"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00002 1L1 9.00002M1.00003 1L9.00005 9.00002" stroke="black" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="flex mb-8 justify-between">
                @if (Auth::check())
                    <ul class="flex-col md:flex-row list-none items-center md:flex">
                        <x-dropdown align="left" width="60">
                            <x-slot name="trigger">
                                <div class="py-8 px-6 flex w-full items-center">
                                    <span class="bg-orange-500 rounded-md text-center text-white">
                                        {{ Auth::user()->first_name }}
                                    </span>
                                </div>
                            </x-slot>
                            <x-slot name="content">
                                {{-- if admin show dashboard and settings else show logout --}}
                                @if (auth()->user()->is_admin)
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('admin.settings')">
                                        {{ __('Settings') }}
                                    </x-dropdown-link>
                                @endif

                                {{-- <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link> --}}

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="flex items-center">
                            <img class="w-9 h-9 object-cover mr-2" src="yofte-assets/elements/avatar.svg"
                                alt="">
                            <span class="mr-2 font-medium">
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </span>
                        </div>
                @endif
                <div class="flex items-center">
                    <a class="mr-10" href="#">
                        <svg width="23" height="20" viewbox="0 0 23 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.4998 19.2061L2.70115 9.92527C1.92859 9.14433 1.41864 8.1374 1.24355 7.04712C1.06847 5.95684 1.23713 4.8385 1.72563 3.85053V3.85053C2.09464 3.10462 2.63366 2.45803 3.29828 1.96406C3.9629 1.47008 4.73408 1.14284 5.5483 1.00931C6.36252 0.875782 7.19647 0.939779 7.98144 1.19603C8.7664 1.45228 9.47991 1.89345 10.0632 2.48319L11.4998 3.93577L12.9364 2.48319C13.5197 1.89345 14.2332 1.45228 15.0182 1.19603C15.8031 0.939779 16.6371 0.875782 17.4513 1.00931C18.2655 1.14284 19.0367 1.47008 19.7013 1.96406C20.3659 2.45803 20.905 3.10462 21.274 3.85053V3.85053C21.7625 4.8385 21.9311 5.95684 21.756 7.04712C21.581 8.1374 21.071 9.14433 20.2984 9.92527L11.4998 19.2061Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <a class="flex items-center" href="#">
                        <svg class="mr-3" width="23" height="23" viewbox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        <span
                            class="inline-block w-6 h-6 text-center bg-gray-100 rounded-full font-semibold font-heading">3</span>
                    </a>
                </div>
            </div>
            <livewire:front.search-box />
            <ul class="text-3xl font-bold font-heading">
                <li class="mb-8"><a href="#">{{ __('Categories') }}</a></li>
                <li class="mb-8"><a href="{{ route('front.catalog') }}">{{ __('Collection') }}</a></li>
                <li><a href="#">{{ __('Brands') }}</a></li>
            </ul>
        </nav>
    </div>
</section>
