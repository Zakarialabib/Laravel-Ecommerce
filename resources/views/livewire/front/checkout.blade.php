<div>

    <h2 class="mb-14 text-5xl font-bold font-heading">{{ __('Checkout') }}</h2>
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4">
            <form wire:submit.prevent="checkout">
                <div class="flex mb-10 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blue-300 text-white">1</span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Delivery') }}</h3>
                </div>
                <div class="mb-12">
                    <label class="font-bold font-heading text-gray-600" for="">{{ __('E-mail address') }}</label>
                    <input wire:model="email"
                        class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                        type="email">
                </div>
                <div class="flex mb-10 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-purple-300 text-white">2</span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Shipping informations') }}</h3>
                </div>
                <div class="mb-12">
                    <div class="flex flex-wrap -mx-4 mb-10">
                        <div class="w-full md:w-1/2 px-4 mb-10 md:mb-0">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('First name') }}</label>
                            <input wire:model="firstname"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Last name') }}</label>
                            <input wire:model="lastname"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                    </div>
                    <div class="mb-10">
                        <label class="font-bold font-heading text-gray-600" for="">{{ __('Phone') }}</label>
                        <input wire:model="phone"
                            class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="text">
                    </div>
                    <div class="mb-10">
                        <label class="font-bold font-heading text-gray-600" for="">{{ __('Address') }}</label>
                        <input wire:model="address"
                            class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="text">
                    </div>

                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-2/3 px-4 mb-10 md:mb-0">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Country') }}</label>
                            <input wire:model="country"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-2/3 px-4 mb-10 md:mb-0">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('City') }}</label>
                            <input wire:model="city"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                    </div>
                </div>
                <div class="flex mb-10 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-orange-300 text-white">3</span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Shipping methods') }}</h3>
                </div>
                {{-- 
                <div class='flex mb-2 items-center'>
                    <x-select-list
                        class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        id="shipping_id" name="shipping_id" wire:model="shipping_id" :options="$this->listsForFields['shippings']" />
                </div>
                @if ($shipping_id)
                    @if ($shipping->is_pickup)
                        <div class="flex mb-8 items-center justify-between pb-5 border-b border-blue-100">
                            <span class="text-blue-50">{{ __('Shipping') }}</span>
                            <span class="text-xl font-bold font-heading text-white">0 DH</span>
                        </div>
                        <div class="flex mb-10 justify-between items-center">
                            <span
                                class="text-xl font-bold font-heading text-white">{{ __('Order total') }}</span>
                            <span class="text-xl font-bold font-heading text-white">
                                {{ $cartTotal }} DH
                            </span>
                        </div>
                    @else
                        <div class="flex mb-2 justify-between items-center">
                            <span class="text-blue-50">{{ __('Shipping cost') }}</span>
                            <span class="text-xl font-bold font-heading text-white">
                                {{ $shipping->cost }} DH
                        </div>
                        <div class="flex mb-10 justify-between items-center">
                            <span class="text-blue-50">{{ __('Shipping to') }}
                                {{ $shipping->title }}</span>
                            </span>
                            <span class="text-xl font-bold font-heading text-white">-</span>
                        </div>
                        <div class="flex mb-10 justify-between items-center">
                            <span
                                class="text-xl font-bold font-heading text-white">{{ __('Order total') }}</span>
                            <span class="text-xl font-bold font-heading text-white">
                                {{ $cartTotal + $shipping->cost }} DH
                            </span>
                        </div>
                    @endif
                @endif --}}
                <div class="mb-12">
                    <div class="mb-2 py-3 px-8 bg-white rounded-full">
                        <div class="flex flex-wrap items-center">
                            <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                <input type="radio" name="deliveryType" value="" checked>
                                <span class="ml-4 text-sm font-bold font-heading">{{ __('Standard delivery') }}</span>
                            </label>
                            <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">
                                {{ __('3-4 business days') }}</p>
                            <span class="sm:order-last ml-auto text-blue-300 font-bold font-heading">$3.00</span>
                        </div>
                    </div>
                    <div class="py-3 px-8 bg-white rounded-full">
                        <div class="flex flex-wrap items-center">
                            <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                <input type="radio" name="deliveryType" value="">
                                <span class="ml-4 text-sm font-bold font-heading">{{ __('Express') }}</span>
                            </label>
                            <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">Next day</p>
                            <span class="sm:order-last ml-auto text-blue-300 font-bold font-heading">$20.00</span>
                        </div>
                    </div>
                </div>
                <div class="flex mb-10 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-orange-300 text-white">3</span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Packaging Type') }}</h3>
                </div>
                <div class="mb-12">
                    <div class="mb-2 py-3 px-8 bg-white rounded-full">
                        <div class="flex flex-wrap items-center">
                            <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                <input type="radio" name="packagingType" value="" checked>
                                <span class="ml-4 text-sm font-bold font-heading">{{ __('Normal') }}</span>
                            </label>
                            <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">
                                {{ __('Carton') }}</p>
                            <span
                                class="sm:order-last ml-auto text-blue-300 font-bold font-heading">{{ __('Free') }}</span>
                        </div>
                    </div>
                    <div class="py-3 px-8 bg-white rounded-full">
                        <div class="flex flex-wrap items-center">
                            <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                <input type="radio" name="packagingType" value="">
                                <span class="ml-4 text-sm font-bold font-heading">{{ __('Gift') }}</span>
                            </label>
                            <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">
                                {{ __('Decoration') }}</p>
                            <span
                                class="sm:order-last ml-auto text-blue-300 font-bold font-heading">{{ '20 DH' }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex mb-10 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-pink-300 text-white">{{ $cartCount }} </span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Order summary') }}</h3>
                </div>
                <div>
                    <div class="flex flex-wrap -mx-4 mb-10">

                        <label class="flex px-4 w-full sm:w-auto items-center" for="">
                            <input type="radio" name="paymentType" value="">
                            <span class="ml-5 text-sm">{{ __('Cash on Delivery') }}</span>
                        </label>

                    </div>
                </div>
            </form>
        </div>
        <div class="w-full lg:w-1/2 px-4">
            <div class="py-16 px-6 md:px-14 bg-white">
                <div class="flex mb-12 items-center">
                    <h2 class="text-4xl font-bold font-heading">{{ __('Order summary') }}</h2>
                    <span
                        class="flex-shrink-0 inline-flex ml-4 w-8 h-8 items-center justify-center rounded-full bg-orange-300 text-white">{{ $cartCount }}</span>
                </div>
                <div class="mb-12 pb-16 border-b">
                    <div class="flex flex-wrap -mx-4 mb-10 items-center">
                        @foreach ($cartItems as $item)
                            <div class="self-stretch w-full lg:w-1/4 px-4">
                                <img class="mb-4 lg:mb-0 h-32 lg:h-42 object-contain"
                                    src="{{ asset('images/products/' . $item->model->image) }}"
                                    alt="{{ $item->name }}">
                            </div>
                            <div class="w-full md:w-3/4 px-4">
                                <div class="flex justify-between">
                                    <div class="pr-2">
                                        <h3 class="mb-2 text-xl font-bold font-heading">{{ $item->name }}</h3>
                                    </div>
                                    <span class="text-lg text-blue-300 font-bold font-heading">
                                        {{ $item->price }} DH</span>
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-500">{{ __('In Stock') }}</p>
                                    <div
                                        class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                        <div class="flex items-center">
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

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-12">
                    <div class="mb-10">
                        <div class="py-3 px-10 bg-blue-50 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Subtotal') }}</span>
                                <span class="font-bold font-heading">$89.67</span>
                            </div>
                        </div>
                        <div class="py-3 px-10 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Shipping') }}</span>
                                <span class="font-bold font-heading">$11.00</span>
                            </div>
                        </div>
                        <div class="py-3 px-10 bg-blue-50 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Tax') }}</span>
                                <span class="font-bold font-heading">$0.00</span>
                            </div>
                        </div>
                        <div class="py-3 px-10 rounded-full">
                            <div class="flex justify-between">
                                <span class="text-base md:text-xl font-bold font-heading">{{ __('Total') }}</span>
                                <span class="font-bold font-heading">$100.67</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <span class="inline-block mb-4 font-medium">{{ __('Apply discount code') }}:</span>
                    <div class="flex mb-12 flex-wrap lg:flex-nowrap items-center">
                        <input
                            class="mb-4 md:mb-0 mr-6 w-full px-8 py-4 placeholder-gray-800 font-bold font-heading border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="text" placeholder="SUMMER30X">
                        <a class="inline-block mb-4 md:mb-0 px-8 py-4 text-white font-bold font-heading uppercase bg-gray-800 hover:bg-gray-700 rounded-md"
                            href="#">{{ __('Apply') }}</a>
                    </div>
                </div>
                <a class="block w-full py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200"
                    href="#">{{ __('Confirm Order') }}</a>
            </div>
        </div>
    </div>
</div>
