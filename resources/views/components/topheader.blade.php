<div class="px-6 py-2 bg-red-600 text-white">
    <div class="flex items-center justify-center md:justify-between">
        <p class="text-xs text-center font-semibold font-heading hover:text-gray-400">
            BADR LUXURY - SINCE 1983 - THE BEST OF EVERYTHING
        </p>
        @if (Auth::check())
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <div class="py-5 px-6 flex w-full items-center">
                        <div class="flex items-center">
                            <span
                                class="bg-orange-500 rounded-md text-center text-white px-6 py-2 cursor-pointer text-sm font-semibold font-heading">
                                {{ Auth::user()->first_name }}
                            </span>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="content">
                    {{-- if admin show dashboard and settings else show logout --}}
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
            <button class="flex-shrink-0 hidden md:block px-8 border-l">
                <div class="flex items-center text-white">
                    <a href="{{ route('login') }}" class="mr-2 text-xs text-center font-semibold font-heading  hover:text-gray-4">{{ __('Login') }} </a>
                    {{ __('or') }}
                    <a href="{{ route('register') }}" class="ml-2 text-xs text-center font-semibold font-heading  hover:text-gray-4"> {{ __('Register') }}</a>
                </div>
            </button>
        @endif
    </div>
</div>
