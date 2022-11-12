<div>
    @if ($cartCount > 0)
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                    <svg class="mr-3" width="23" height="23" viewbox="0 0 23 23" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                    <span class="inline-block w-6 h-6 text-center bg-gray-100 rounded-full font-semibold font-heading text-gray-900">
                        {{ $cartCount }}
                    </span>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="py-1">
                    <ul>
                        @foreach ($cartItems as $item)
                            <li>
                                <a href="{{ route('front.product', $item->model->slug) }}">
                                    <img src="{{ asset('images/products/' . $item->model->image) }}" alt="{{ $item->model->name }}"
                                        class="w-20 h-20 object-cover">
                                    <span class="text-sm font-semibold font-heading">{{ $item->model->name }}</span>

                                    <div class="flex items-center text-white">
                                        <button wire:click="decreaseQuantity('{{ $item->model->slug }}')"
                                            class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                                    clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </button>
                                        <span class="text-gray-700 mx-2">{{ $item->qty }}</span>
                                        <button wire:click="increaseQuantity('{{ $item->model->slug }}')"
                                            class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V6a1 1 0 011-1z"
                                                    clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <span>{{ $item->price }} DH</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between px-4 py-3">
                        <span>{{ __('Total') }}</span>
                        <span class="total">{{ $cartTotal }} DH</span>
                    </div>
                    <div class="flex justify-between px-4 py-3">
                        {{-- show showCart with alpinejs  --}}
                        <a class="text-sm font-semibold font-heading cursor-pointer" @click="showCart = true">
                            {{ __('View cart') }}
                        </a>
                        <a href="{{ route('front.checkout') }}" class="text-sm font-semibold font-heading cursor-pointer">
                            {{ __('Checkout') }}
                        </a>
                    </div>
                </div>
            </x-slot>
        </x-dropdown>
    @else
        <a class="flex items-center">
            <svg class="mr-3" width="23" height="23" viewbox="0 0 23 23" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
            <span class="inline-block w-6 h-6 text-center bg-gray-100 rounded-full font-semibold font-heading">
                {{ $cartCount }}
            </span>
        </a>
    @endif
    <livewire:front.cart-bar />

</div>

