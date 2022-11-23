<div>
    <section class="relative py-10 bg-gray-100">
        <div class="absolute top-0 left-0 w-full lg:w-2/5 h-64 lg:h-full bottom-0 bg-blue-300">
            <img class="absolute bottom-0 left-0 w-1/2 lg:w-auto" src="yofte-assets/elements/lines-order.svg" alt="">
            <img class="w-1/2 ml-auto lg:ml-0 lg:w-full h-full lg:h-auto object-cover"
                src="yofte-assets/images/placeholder-order.png" alt="">
        </div>
        <div class="mt-64 lg:mt-0 py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-end">
                    <div class="w-full lg:w-3/5 lg:pl-20 lg:ml-auto">
                        <h2 class="mb-8 text-5xl font-bold font-heading">{{ __('Thank you') }} {{ $order->user->fullName }} </h2>
                        <p class="mb-12 text-gray-500">{{ __('Your order is processing') }}</p>
                        <div class="flex flex-wrap mb-12">
                            <div class="mr-20">
                                <h3 class="text-gray-600">{{ __('Order Number') }}</h3>
                                <p class="text-blue-300 font-bold font-heading">{{ $order->reference }}</p>
                            </div>
                            <div class="mr-auto">
                                <h3 class="text-gray-600">{{ __('Date') }}</h3>
                                <p class="text-blue-300 font-bold font-heading">
                                    {{ $order->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <a class="inline-flex mt-6 md:mt-0 w-full lg:w-auto justify-center items-center py-4 px-6 border hover:border-gray-500 rounded-md font-bold font-heading"
                                href="#">
                                <svg width="16" height="20" viewbox="0 0 16 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 1V0.25C0.585786 0.25 0.25 0.585786 0.25 1L1 1ZM15 19V19.75C15.4142 19.75 15.75 19.4142 15.75 19H15ZM1 19H0.25C0.25 19.4142 0.585786 19.75 1 19.75L1 19ZM10 1L10.5303 0.46967C10.3897 0.329018 10.1989 0.25 10 0.25V1ZM15 6H15.75C15.75 5.80109 15.671 5.61032 15.5303 5.46967L15 6ZM15 18.25H1V19.75H15V18.25ZM1.75 19V1H0.25V19H1.75ZM1 1.75H10V0.25H1V1.75ZM14.25 6V19H15.75V6H14.25ZM9.46967 1.53033L14.4697 6.53033L15.5303 5.46967L10.5303 0.46967L9.46967 1.53033ZM8.25 1V5H9.75V1H8.25ZM11 7.75H15V6.25H11V7.75ZM8.25 5C8.25 6.51878 9.48122 7.75 11 7.75V6.25C10.3096 6.25 9.75 5.69036 9.75 5H8.25Z"
                                        fill="black"></path>
                                </svg>
                                <span class="ml-4">{{ __('View Invoice') }}</span>
                            </a>
                        </div>
                        <div class="mb-6 p-10 shadow-xl">
                            <div class="flex flex-wrap items-center -mx-4">
                                @foreach ($order->products as $product)
                                    <div class="w-full lg:w-2/6 px-4 mb-8 lg:mb-0">
                                        <img class="w-full h-32 object-contain"
                                            src="{{ asset('images/products/' . $product->image) }}" alt="">
                                    </div>
                                    <div class="w-full lg:w-4/6 px-4">
                                        <div class="flex">
                                            <div class="mr-auto">
                                                <h3 class="text-xl font-bold font-heading">{{ $product->name }}</h3>
                                                <p class="text-gray-500">{!! $product->description !!}</p>
                                                <p class="text-gray-500">
                                                    <span>{{ __('Quantity') }}:</span>
                                                    <span class="text-gray-900 font-bold font-heading">{{ $order->quantity }}</span>
                                                </p>
                                            </div>
                                            <span class="text-2xl font-bold font-heading text-blue-300">{{ $product->price }}
                                                DH</span>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-10">
                            <div class="py-3 px-10 bg-gray-100 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Subtotal') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ $order->subtotal }} DH
                                    </span>
                                </div>
                            </div>
                            <div class="py-3 px-10 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Shipping') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ $order->shipping }} DH
                                    </span>
                                </div>
                            </div>
                            <div class="py-3 px-10 bg-gray-100 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Tax') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ $order->tax }} DH
                                    </span>
                                </div>
                            </div>
                            <div class="py-3 px-10 rounded-full">
                                <div class="flex justify-between">
                                    <span
                                        class="text-base md:text-xl font-bold font-heading">{{ __('Order Total') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ $order->total }} DH
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10 py-10 px-4 bg-gray-100">
                            <div class="flex flex-wrap justify-around -mx-4">
                                <div class="w-full md:w-auto px-4 mb-6 md:mb-0">
                                    <h4 class="mb-6 font-bold font-heading">{{ __('Delivery Address') }}</h4>
                                    <p class="text-gray-500">
                                        {{ $order->address->address }}
                                    </p>
                                    <p class="text-gray-500">{{ $order->address->city }} - {{ $order->address->country }}
                                    </p>
                                </div>
                                <div class="w-full md:w-auto px-4 mb-6 md:mb-0">
                                    <h4 class="mb-6 font-bold font-heading">{{ __('Shipping informations') }}</h4>
                                    <p class="text-gray-500">
                                        {{ $order->user->email }}
                                    </p>
                                    <p class="text-gray-500">
                                        {{ $order->user->phone }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <a class="block text-center px-8 py-4 bg-orange-300 hover:bg-orange-400 text-white font-bold font-heading uppercase rounded-md transition duration-200"
                            href="{{ route('front.home') }}">
                            {{ __('Go back Shopping') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
