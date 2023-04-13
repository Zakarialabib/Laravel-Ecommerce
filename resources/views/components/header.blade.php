<div x-data="{ isMenuOpen: false, isSidebar: false }">
    <div class="relative">
        <nav class="flex bg-beige-100 border-b">
            <div class="px-4 lg:px-12 py-5 flex w-full items-center justify-between">
                <a class="lg:mr-8 2xl:mr-20 lg:text-3xl sm:text-xl font-bold font-heading text-white"
                    href="{{ route('front.index') }}">
                    <img class="w-auto h-14 bg-black mix-blend-exclusion"
                        src="{{ asset('images/' . Helpers::settings('site_logo')) }}" loading="lazy"
                        alt="{{ Helpers::settings('site_title') }}" />
                </a>

                <div class="hidden md:flex text-beige-800 items-center justify-center space-x-4">
                    @foreach (\App\Helpers::getActiveCategories() as $category)
                        <a href="{{ route('front.categories') }}?c={{ $category->id }}"
                            class="lg:text-md md:text-sm text-center uppercase font-semibold font-heading hover:text-beige-400 hover:underline">
                            {{ $category->name }}
                        </a>
                    @endforeach
                    <button type="button"
                        class="lg:text-md md:text-sm text-center uppercase font-semibold font-heading hover:text-beige-400 hover:underline"
                        x-on:click="isMenuOpen = !isMenuOpen" mouseenter="isMenuOpen = true"
                        @click.away="isMenuOpen = false">
                        {{ __('Brands') }} <small
                            class="inline-block align-middle text-gray-600 opacity-75">&#9660;</small>
                    </button>
                </div>


                <div class="hidden md:flex items-center text-beige-800 space-x-2">

                    <livewire:front.search-box />

                    <livewire:front.cart-count />
                    @if (Auth::check())
                        <x-dropdown align="right" width="56">
                            <x-slot name="trigger">
                                <div class="flex items-center text-beige-800 px-4">
                                    <i class="fa fa-caret-down ml-2"></i> {{ Auth::user()->first_name }}
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                @if (Auth::user()->isAdmin())
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('admin.settings')">
                                        {{ __('Settings') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('front.myaccount') }}">
                                        {{ __('My account') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-beige-800"></div>

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
                        <x-dropdown align="right" width="56">
                            <x-slot name="trigger">
                                <div class="flex items-center text-beige-800 pr-4">
                                    <i class="fa fa-user ml-2"></i>
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('login')">
                                    {{ __('Login') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-end mr-5 md:hidden self-center w-1/2">


                <livewire:front.cart-count />

            </div>

            <button type="button" class="self-center mr-8 md:hidden" @click="isSidebar = !isSidebar">
                <svg width="30" height="22" viewbox="0 0 20 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 2H19C19.2652 2 19.5196 1.89464 19.7071 1.70711C19.8946 1.51957 20 1.26522 20 1C20 0.734784 19.8946 0.48043 19.7071 0.292893C19.5196 0.105357 19.2652 0 19 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1C0 1.26522 0.105357 1.51957 0.292893 1.70711C0.48043 1.89464 0.734784 2 1 2ZM19 10H1C0.734784 10 0.48043 10.1054 0.292893 10.2929C0.105357 10.4804 0 10.7348 0 11C0 11.2652 0.105357 11.5196 0.292893 11.7071C0.48043 11.8946 0.734784 12 1 12H19C19.2652 12 19.5196 11.8946 19.7071 11.7071C19.8946 11.5196 20 11.2652 20 11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10ZM19 5H1C0.734784 5 0.48043 5.10536 0.292893 5.29289C0.105357 5.48043 0 5.73478 0 6C0 6.26522 0.105357 6.51957 0.292893 6.70711C0.48043 6.89464 0.734784 7 1 7H19C19.2652 7 19.5196 6.89464 19.7071 6.70711C19.8946 6.51957 20 6.26522 20 6C20 5.73478 19.8946 5.48043 19.7071 5.29289C19.5196 5.10536 19.2652 5 19 5Z"
                        fill="#8594A5"></path>
                </svg>
            </button>
        </nav>
        <div class="absolute z-10 top-full left-0 w-full max-w-screen-xl bg-white rounded-md shadow-lg""
            x-show.transition="isMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90" x-cloak>
            <div class="grid grid-cols-3 gap-4 p-6">
                @foreach (\App\Helpers::getActiveBrands() as $brand)
                    <a class="block mb-5" href="{{ route('front.brandPage', $brand->slug) }}">
                        <p class="mb-3 text-lg font-bold font-heading text-blue-900">
                            {{ $brand->name }}
                        </p>
                        <div class="relative">
                            <img class="w-full h-24 object-contain" loading="lazy"
                                src="{{ asset('images/brands/' . $brand->image) }}"
                                onerror="this.onerror=null; this.remove();" alt="{{ $brand->name }}">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="fixed top-0 left-0 bottom-0 w-5/6 max-w-sm z-50 overflow-y-scroll" 
            x-show="isSidebar"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
            @click.away="isSidebar = false"
            x-cloak>
            <div class="fixed inset-0 bg-gray-800 opacity-25 transition-opacity" 
            x-transition:enter="transition ease-out duration-100" x-transition:leave="transition ease-in duration-100"
            x-on:click="isSidebar = false"></div>
            {{-- <div class="fixed inset-0 bg-gray-800 opacity-25"></div> --}}
            <nav class="relative flex flex-col py-6 px-6 w-full h-full bg-white border-r overflow-y-scroll">
                <div class="flex items-center mb-2">
                    <a class="mr-auto lg:text-3xl sm:text-xl font-bold font-heading" href="{{ route('front.index') }}">
                        <img class="w-auto h-14" src="{{ asset('images/' . Helpers::settings('site_logo')) }}"
                            alt="{{ Helpers::settings('site_title') }}" loading="lazy" />
                    </a>
                    <button @click="isSidebar = false" type="button">
                        <svg class="h-5 w-5 text-gray-500 cursor-pointer" width="10" height="10"
                            viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00002 1L1 9.00002M1.00003 1L9.00005 9.00002" stroke="black" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                <div class="border-t border-gray-900 mt-4 py-2"></div>

                <div class="flex justify-center px-2 my-4">
                    <livewire:front.search-box />
                </div>

                <div class="border-t border-gray-900 mt-6 py-2"></div>

                <ul class="lg:text-3xl sm:text-xl font-bold font-heading mb-4" x-data="{ isCategory: false }">
                    <li class="mb-2 hover:underline hover:text-beige-500">
                        <button @click="isCategory = !isCategory" type="button">
                            {{ __('Categories') }}
                            <i class="fas fa-angle-down pl-5"></i>
                        </button>
                    </li>
                    <ul x-show="isCategory" class="py-2 space-y-4 font-semibold font-heading">
                        @foreach (\App\Helpers::getActiveCategories() as $category)
                            <li>
                                <a href="{{ route('front.categories') }}?c={{ $category->id }}"
                                    class="text-lg text-beige-800 text-center font-semibold leading-5 font-heading hover:text-gray-800 hover:underline">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </ul>

                <div class="border-t border-gray-900 py-2"></div>

                <ul class="lg:text-3xl sm:text-xl font-bold font-heading mb-4" x-data="{ isBrand: false }">
                    <li class="mb-2 hover:underline hover:text-beige-500">
                        <button @click="isBrand = !isBrand" type="button">
                            {{ __('Brands') }}
                            <i class="fas fa-angle-down pl-5"></i>
                        </button>
                    </li>
                    <ul x-show="isBrand" class="py-2 space-y-4 font-semibold font-heading">
                        @foreach (\App\Helpers::getActiveBrands() as $brand)
                            <li>
                                <a href="{{ route('front.brands') }}?c={{ $brand->id }}"
                                    class="text-lg text-beige-800 text-center font-semibold leading-5 font-heading hover:text-gray-800 hover:underline">
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </ul>

                <div class="border-t border-gray-900 py-2"></div>

                <div class="flex justify-between">
                    @if (Auth::check())
                        <div class="w-full lg:text-3xl sm:text-xl font-bold font-heading">
                            <div class="py-3">
                                <a href="#" class="hover:text-beige-500">
                                    {{ Auth::user()->first_name }}
                                </a>
                            </div>
                            @if (Auth::user()->isAdmin())
                                <div class="py-3">
                                    <a class="hover:text-beige-500" href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                </div>
                                <div class="py-3">
                                    <a class="hover:text-beige-500" href="{{ route('admin.settings') }} ">
                                        {{ __('Settings') }}
                                    </a>
                                </div>
                            @else
                                <div class="py-3">
                                    <a class="hover:text-beige-500" href="{{ route('front.myaccount') }}">
                                        {{ __('My account') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="border-t border-gray-900 py-2"></div>
                        <div class="w-full lg:text-3xl sm:text-xl font-bold font-heading">
                            <div class="py-3">
                                <a class="hover:text-beige-500" href="{{ route('login') }}">{{ __('Login') }} </a>
                            </div>
                            {{ __('or') }}
                            <div class="py-3">
                                <a class="hover:text-beige-500" href="{{ route('register') }}">
                                    {{ __('Register') }}</a>
                            </div>
                        </div>
                    @endif
                </div>

            </nav>
        </div>
    </div>
</div>

<livewire:front.cart-bar />
