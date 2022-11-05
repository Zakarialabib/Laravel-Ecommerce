@section('title', __('Checkout'))
<x-app-layout>
    <section class="py-10 bg-gray-100">
        <div class="container mx-auto px-10">
            <h2 class="mb-14 text-5xl font-bold font-heading">{{ __('Checkout') }}</h2>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/2 px-4">
                    <form action="">
                        <div class="flex mb-10 items-center">
                            <span
                                class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blue-300 text-white">1</span>
                            <h3 class="text-2xl font-bold font-heading">{{ __('Delivery') }}</h3>
                        </div>
                        <div class="mb-12">
                            <label class="font-bold font-heading text-gray-600"
                                for="">{{ __('E-mail address') }}</label>
                            <input
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
                                    <input
                                        class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                        type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-4">
                                    <label class="font-bold font-heading text-gray-600"
                                        for="">{{ __('Last name') }}</label>
                                    <input
                                        class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                        type="text">
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600"
                                    for="">{{ __('Phone') }}</label>
                                <input
                                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                    type="text">
                            </div>
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600"
                                    for="">{{ __('Address') }}</label>
                                <input
                                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                    type="text">
                            </div>

                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full md:w-2/3 px-4 mb-10 md:mb-0">
                                    <label class="font-bold font-heading text-gray-600"
                                        for="">{{ __('Country') }}</label>
                                    <input
                                        class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                        type="text">
                                </div>
                                <div class="w-full md:w-2/3 px-4 mb-10 md:mb-0">
                                    <label class="font-bold font-heading text-gray-600"
                                        for="">{{ __('City') }}</label>
                                    <input
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
                        <div class="mb-12">
                            <div class="mb-2 py-3 px-8 bg-white rounded-full">
                                <div class="flex flex-wrap items-center">
                                    <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                        <input type="radio" name="deliveryType" value="" checked>
                                        <span
                                            class="ml-4 text-sm font-bold font-heading">{{ __('Standard delivery') }}</span>
                                    </label>
                                    <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">
                                        {{ __('3-4 business days') }}</p>
                                    <span
                                        class="sm:order-last ml-auto text-blue-300 font-bold font-heading">$3.00</span>
                                </div>
                            </div>
                            <div class="py-3 px-8 bg-white rounded-full">
                                <div class="flex flex-wrap items-center">
                                    <label class="inline-flex mb-1 pr-4 py-2 items-center sm:border-r" for="">
                                        <input type="radio" name="deliveryType" value="">
                                        <span class="ml-4 text-sm font-bold font-heading">{{ __('Express') }}</span>
                                    </label>
                                    <p class="order-last w-full sm:w-auto pl-4 text-sm text-gray-500">Next day</p>
                                    <span
                                        class="sm:order-last ml-auto text-blue-300 font-bold font-heading">$20.00</span>
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
                                class="inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-pink-300 text-white">4</span>
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
                                class="flex-shrink-0 inline-flex ml-4 w-8 h-8 items-center justify-center rounded-full bg-orange-300 text-white">2</span>
                        </div>
                        <div class="mb-12 pb-16 border-b">
                            <div class="flex -mx-4 mb-8 flex-wrap items-center">
                                <div class="self-stretch w-full lg:w-1/4 px-4">
                                    <img class="mb-4 lg:mb-0 h-32 lg:h-42 object-contain"
                                        src="yofte-assets/images/waterbottle.png" alt="">
                                </div>
                                <div class="w-full md:w-3/4 px-4">
                                    <div class="flex justify-between">
                                        <div class="pr-2">
                                            <h3 class="mb-2 text-xl font-bold font-heading">BRILE water filter carafe
                                            </h3>
                                            <p class="mb-8 text-gray-500">Maecenas 0.7 commodo sit</p>
                                        </div>
                                        <span class="text-lg text-blue-300 font-bold font-heading">$29.89</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-500">In Stock</p>
                                        <div
                                            class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="2" viewbox="0 0 12 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.35">
                                                        <rect x="12" width="2" height="12"
                                                            transform="rotate(90 12 0)" fill="currentColor"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                            <input
                                                class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md"
                                                type="number" placeholder="1">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="12" viewbox="0 0 12 12"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.35">
                                                        <rect x="5" width="2" height="12"
                                                            fill="currentColor"></rect>
                                                        <rect x="12" y="5" width="2"
                                                            height="12" transform="rotate(90 12 5)"
                                                            fill="currentColor"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex -mx-4 mb-8 flex-wrap items-center">
                                <div class="self-stretch w-full lg:w-1/4 px-4">
                                    <img class="mb-4 lg:mb-0 h-32 lg:h-42 object-contain"
                                        src="yofte-assets/images/basketball.png" alt="">
                                </div>
                                <div class="w-full md:w-3/4 px-4">
                                    <div class="flex justify-between">
                                        <div class="pr-2">
                                            <h3 class="mb-2 text-xl font-bold font-heading">Nike basketball ball</h3>
                                            <p class="mb-8 text-gray-500">Lorem ipsum dolor L</p>
                                        </div>
                                        <span class="text-lg text-blue-300 font-bold font-heading">$59.78</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-500">In Stock</p>
                                        <div
                                            class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="2" viewbox="0 0 12 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.35">
                                                        <rect x="12" width="2" height="12"
                                                            transform="rotate(90 12 0)" fill="currentColor"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                            <input
                                                class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md"
                                                type="number" placeholder="2">
                                            <button class="py-2 hover:text-gray-700">
                                                <svg width="12" height="12" viewbox="0 0 12 12"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.35">
                                                        <rect x="5" width="2" height="12"
                                                            fill="currentColor"></rect>
                                                        <rect x="12" y="5" width="2"
                                                            height="12" transform="rotate(90 12 5)"
                                                            fill="currentColor"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                        <span
                                            class="text-base md:text-xl font-bold font-heading">{{ __('Total') }}</span>
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
    </section>
</x-app-layout>
