<div>
    <div class="relative" x-data="{ open: false }">
        <div class="fixed inset-0 overflow-hidden hidden" wire:ignore.self x-show="showCart"
             x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                    <div class="w-screen max-w-md">
                        <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                            <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-medium text-gray-900">{{ __('Cart') }}</h2>
                                    <div class="ml-3 h-7 flex items-center">
                                        <button x-on:click="showCart = false"
                                            class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            <span class="sr-only">{{ __('Close panel') }}</span>
                                            <svg class="h-6 w-6" x-description="Heroicon name: outline/x"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                @foreach ($cartItems as $item)
                                    <div class="flex flex-wrap -mx-4 mb-10 items-center">
                                        <div class="w-full md:w-1/3 mb-6 md:mb-0 px-4">
                                            <div class="flex h-32 items-center justify-center bg-gray-100">
                                                {{-- <img class="h-full object-contain"
                                                    src="{{ asset('images/products/' . $item->model->image) }}"
                                                    alt="{{ $item->name }}"> --}}
                                            </div>
                                        </div>
                                        <div class="w-full md:w-2/3 px-4">
                                            <div>
                                                <h3 class="mb-1 text-xl font-bold font-heading">{{ $item->name }}</h3>
                                                <div class="flex flex-wrap items-center justify-between">
                                                    <div
                                                        class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                                        <div class="flex items-center">
                                                            <button wire:click="decreaseQuantity('{{ $item->model->slug }}')"
                                                                class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20"
                                                                    fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                                                        clip-rule="evenodd">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                            <span
                                                                class="text-gray-700 mx-2">{{ $item->qty }}</span>
                                                            <button wire:click="increaseQuantity('{{ $item->model->slug }}')"
                                                                class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                                <svg class="h-5 w-5" viewBox="0 0 20 20"
                                                                    fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <p class="text-lg text-blue-500 font-bold font-heading">
                                                            {{ $item->price }} DH</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-6 md:p-12 bg-gray-900">
                            <h2 class="mb-6 text-4xl font-bold font-heading text-white">{{ __('Cart totals') }}</h2>
                            <div class="flex mb-8 items-center justify-between pb-5 border-b border-blue-100">
                                <span class="text-blue-50">{{ __('Subtotal') }}</span>
                                <span class="text-xl font-bold font-heading text-white">{{ $cartTotal }} DH</span>
                            </div>
                            <a class="block w-full py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200"
                                href="{{ route('front.checkout') }}">{{ __('Go to Checkout') }}</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
