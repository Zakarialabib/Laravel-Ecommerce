<div>
    <h2 class="mb-14 text-5xl font-bold font-heading">{{ __('Checkout') }}</h2>
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4">
            <form wire:submit.prevent="checkout">
                @if( auth()->check() )
                <div class="flex mb-5 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blue-300 text-white">1</span>
                    <h3 class="text-2xl font-bold font-heading">
                        {{ __('Already have an account ?') }}
                    </h3>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full px-2 md:w-1/2">
                        <label class="font-bold font-heading text-gray-600"
                            for="">{{ __('E-mail address') }}</label>
                        <input wire:model="email"
                            class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="email">
                    </div>
                    <div class="w-full px-2 md:w-1/2">
                        <label class="font-bold font-heading text-gray-600"
                            for="">{{ __('Password') }}</label>
                        <input wire:model="password"
                            class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="email">
                    </div>
                </div>
                @else
                <div class="flex mb-5 items-center">
                    <div class="w-full px-2">
                        <label class="font-bold font-heading text-gray-600"
                            for="">{{ __('E-mail address') }}</label>
                        <input wire:model="email"
                            class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                            type="email">
                    </div>
                </div>
                @endif

                <div class="flex mb-5 items-center">
                    <span
                        class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-purple-300 text-white">2</span>
                    <h3 class="text-2xl font-bold font-heading">{{ __('Shipping informations') }}</h3>
                </div>
                <div class="flex mb-5 items-center">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('First name') }}</label>
                            <input wire:model="first_name"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Last name') }}</label>
                            <input wire:model="last_name"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Phone') }}</label>
                            <input wire:model="phone"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Address') }}</label>
                            <input wire:model="address"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>

                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Country') }}</label>
                            <input wire:model="country"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text" value="Maroc">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('City') }}</label>
                            <input wire:model="city"
                                class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('Payment method') }}</label>
                            <div class="flex flex-wrap -mx-4 mb-5">
                                <label class="flex px-4 w-full sm:w-auto items-center" for="">
                                    <input type="radio" name="paymentType" value="cash" wire:model="payment_method"
                                        checked>
                                    <span class="ml-5 text-sm">{{ __('Cash on Delivery') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-5 w-full md:w-1/2 px-4">
                            <div>
                                <label class="font-bold font-heading text-gray-600">
                                    {{ __('Shipping methods') }}
                                </label>
                                <x-select-list
                                    class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                    id="shipping_id" name="shipping_id" wire:model="shipping_id" :options="$this->listsForFields['shippings']" />
                            </div>

                        </div>
                        <div class="py-3 px-4 w-full">
                            @if ($shipping_id)
                                @if ($shipping->is_pickup)
                                    <div class="flex mb-8 items-center justify-between pb-5 border-b border-blue-100">
                                        <span class="text-blue-50">{{ __('Shipping') }}</span>
                                        <span class="text-xl font-bold font-heading text-white">0 DH</span>
                                    </div>
                                    <div class="flex mb-5 justify-between items-center">
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
                                    <div class="flex mb-5 justify-between items-center">
                                        <span class="text-blue-50">{{ __('Shipping to') }}
                                            {{ $shipping->title }}</span>
                                        </span>
                                        <span class="text-xl font-bold font-heading text-white">-</span>
                                    </div>
                                    <div class="flex mb-5 justify-between items-center">
                                        <span
                                            class="text-xl font-bold font-heading text-white">{{ __('Order total') }}</span>
                                        <span class="text-xl font-bold font-heading text-white">
                                            {{ $cartTotal + $shipping->cost }} DH
                                        </span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full lg:w-1/2 px-4">
            <div class="py-16 px-6 md:px-14 bg-white">
                <div class="flex mb-5 items-center">
                    <h2 class="text-4xl font-bold font-heading">{{ __('Order summary') }}</h2>
                </div>
                <div class="mb-5 pb-10 border-b">
                    <div class="flex flex-wrap -mx-4 mb-5 items-center">
                        @foreach ($cartItems as $item)
                            <div class="w-full px-4">
                                <div class="self-stretch w-full lg:w-1/4 px-4">
                                    <img class="mb-4 lg:mb-0 h-32 lg:h-42 object-contain"
                                        src="{{ asset('images/products/' . $item->model->image) }}"
                                        alt="{{ $item->name }}">
                                </div>
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
                <div class="mb-5">
                    <div class="mb-5">
                        <div class="py-3 px-10 bg-blue-50 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Subtotal') }}</span>
                                <span class="font-bold font-heading">
                                    {{ $subTotal }} DH
                                </span>
                            </div>
                        </div>
                        <div class="py-3 px-10 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Shipping') }}</span>
                                <span class="font-bold font-heading">
                                    {{ $shipping }} DH
                                </span>
                            </div>
                        </div>
                        <div class="py-3 px-10 bg-blue-50 rounded-full">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Tax') }}</span>
                                <span class="font-bold font-heading">
                                    {{ $tax }} DH
                                </span>
                            </div>
                        </div>
                        <div class="py-3 px-10 rounded-full">
                            <div class="flex justify-between">
                                <span class="text-base md:text-xl font-bold font-heading">{{ __('Total') }}</span>
                                <span class="font-bold font-heading">
                                    {{ $cartTotal }} DH
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    class="block w-full py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200"
                    type="button" wire:click="checkout">
                    {{ __('Confirm Order') }}
                </button>
            </div>
        </div>
    </div>
</div>
