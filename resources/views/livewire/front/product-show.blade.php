<div>
    <section class="py-10">
        <div class="container mx-auto px-10">
            <div class="flex flex-wrap -mx-4 mb-14">
                <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                    <div class="relative mb-10" style="height: 564px;">
                        <a class="absolute top-1/2 left-0 ml-8 transform translate-1/2" href="#">
                            <svg width="10" height="18" viewbox="0 0 10 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 16.0185C9.268 16.2905 9.268 16.7275 9 16.9975C8.732 17.2675 8.299 17.2685 8.031 16.9975L0.201 9.0895C-0.067 8.8195 -0.067 8.3825 0.201 8.1105L8.031 0.2025C8.299 -0.0675 8.732 -0.0675 9 0.2025C9.268 0.4735 9.268 0.9115 9 1.1815L1.859 8.6005L9 16.0185Z"
                                    fill="#1F40FF"></path>
                            </svg>
                        </a>
                        <img class="object-cover w-full h-full" loading="lazy" src="{{ asset('images/products/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        <a class="absolute top-1/2 right-0 mr-8 transform translate-1/2" href="#">
                            <svg width="10" height="18" viewbox="0 0 10 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.19922 1.1817C-0.0687795 0.909696 -0.0687794 0.472695 0.19922 0.202695C0.46722 -0.0673054 0.90022 -0.0683048 1.16822 0.202695L8.99822 8.11069C9.26622 8.3807 9.26622 8.81769 8.99822 9.08969L1.16822 16.9977C0.900219 17.2677 0.467218 17.2677 0.199219 16.9977C-0.0687809 16.7267 -0.0687808 16.2887 0.199219 16.0187L7.34022 8.5997L0.19922 1.1817Z"
                                    fill="#1F40FF"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap -mx-2">
                        {{-- check if product->gallery is true  --}}
                        @if($product->gallery)
                        @foreach (json_decode($product->gallery) as $image)
                            <div class="w-1/2 sm:w-1/4 p-2">
                                <a class="block border border-blue-300" href="#">
                                    <img class="object-cover w-full h-32 cursor-pointer" loading="lazy"
                                        src="{{ asset('images/products/' . $image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <div>
                        <div class="mb-5 pb-5 border-b">
                            <span class="text-gray-500">
                                {{ $product->category->name }}
                            </span>
                            <h2 class="mt-2 mb-6 max-w-xl text-5xl md:text-6xl font-bold font-heading">
                                {{ $product->name }}
                            </h2>
                            <div class=" flex items-center mb-8">
                                <div class="flex items-center">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $product->reviews->avg('rating'))
                                            <svg class="w-4 h-4 text-orange-500 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-orange-500 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-500 font-body">{{ $product->reviews->count() }}
                                        {{ __('Reviews') }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="inline-block mb-8 text-2xl font-bold font-heading text-blue-300">
                            <span>
                                {{ $product->price }} DH
                            </span>
                            @if ($product->old_price)
                                <span class="text-gray-500 line-through">
                                    -{{ $product->discount }}%
                                </span>
                                <span class="font-normal text-base text-gray-400 line-through">
                                    {{ $product->old_price }} DH
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="flex mb-12">
                        <div class="mr-6">
                            <div
                                class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                <button wire:click="decreaseQuantity('{{ $product->id }}')"
                                    class="py-2 hover:text-gray-700">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                                <input
                                    class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md"
                                    value="{{ $quantity }}" wire:model="quantity">
                                <button wire:click="increaseQuantity('{{ $product->id }}')"
                                    class="py-2 hover:text-gray-700">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V6a1 1 0 011-1z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <a class="block hover:bg-orange-400 text-center text-white font-bold font-heading py-5 px-8 rounded-md uppercase transition duration-200 bg-orange-500 cursor-pointer"
                                wire:click="AddToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                                {{ __('Add to cart') }}
                            </a>
                        </div>
                    </div>
                    <div class="mb-14 items-center">
                        <div class="w-full">
                            <a class="ml-auto sm:ml-0 flex-shrink-0 inline-flex mr-4 items-center justify-center w-16 h-16 rounded-md border hover:border-gray-500"
                                href="#">
                                <svg class="w-6 h-6" width="27" height="27" viewbox="0 0 27 27" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.4993 26.2061L4.70067 16.9253C3.9281 16.1443 3.41815 15.1374 3.24307 14.0471C3.06798 12.9568 3.23664 11.8385 3.72514 10.8505V10.8505C4.09415 10.1046 4.63318 9.45803 5.29779 8.96406C5.96241 8.47008 6.73359 8.14284 7.54782 8.00931C8.36204 7.87578 9.19599 7.93978 9.98095 8.19603C10.7659 8.45228 11.4794 8.89345 12.0627 9.48319L13.4993 10.9358L14.9359 9.48319C15.5192 8.89345 16.2327 8.45228 17.0177 8.19603C17.8026 7.93978 18.6366 7.87578 19.4508 8.00931C20.265 8.14284 21.0362 8.47008 21.7008 8.96406C22.3654 9.45803 22.9045 10.1046 23.2735 10.8505V10.8505C23.762 11.8385 23.9306 12.9568 23.7556 14.0471C23.5805 15.1374 23.0705 16.1443 22.298 16.9253L13.4993 26.2061Z"
                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <a class="flex-shrink-0 inline-flex items-center justify-center w-16 h-16 rounded-md border hover:border-gray-500"
                                href="#">
                                <svg class="w-6 h-6" width="24" height="23" viewbox="0 0 24 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.01328 18.9877C2.05682 16.7902 2.71436 12.9275 6.3326 9.87096L6.33277 9.87116L6.33979 9.86454L6.3398 9.86452C6.34682 9.85809 8.64847 7.74859 13.4997 7.74859C13.6702 7.74859 13.8443 7.75111 14.0206 7.757L14.0213 7.75702L14.453 7.76978L14.6331 7.77511V7.59486V3.49068L21.5728 10.5736L14.6331 17.6562V13.6558V13.5186L14.4998 13.4859L14.1812 13.4077C14.1807 13.4075 14.1801 13.4074 14.1792 13.4072M2.01328 18.9877L14.1792 13.4072M2.01328 18.9877C7.16281 11.8391 14.012 13.3662 14.1792 13.4072M2.01328 18.9877L14.1792 13.4072M23.125 10.6961L23.245 10.5736L23.125 10.4512L13.7449 0.877527L13.4449 0.571334V1V6.5473C8.22585 6.54663 5.70981 8.81683 5.54923 8.96832C-0.317573 13.927 0.931279 20.8573 0.946581 20.938L0.946636 20.9383L1.15618 22.0329L1.24364 22.4898L1.47901 22.0885L2.041 21.1305L2.04103 21.1305C4.18034 17.4815 6.71668 15.7763 8.8873 15.0074C10.9246 14.2858 12.6517 14.385 13.4449 14.4935V20.1473V20.576L13.7449 20.2698L23.125 10.6961Z"
                                        fill="black" stroke="black" stroke-width="0.35"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-8 text-gray-500 font-bold font-heading uppercase">SHARE IT</span>
                        <a class="mr-1 w-8 h-8" href="#">
                            <img src="yofte-assets/buttons/facebook-circle.svg" alt="">
                        </a>
                        <a class="mr-1 w-8 h-8" href="#">
                            <img src="yofte-assets/buttons/instagram-circle.svg" alt="">
                        </a>
                        <a class="w-8 h-8" href="#">
                            <img src="yofte-assets/buttons/twitter-circle.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Show description tab by default and hide others until click alpinejs --}}

        <div x-data="{ activeTab: 'description' }" class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4 mb-10">
                <div class="w-1/2 md:w-auto">
                    <button @click="activeTab = 'description'"
                        :class="activeTab === 'description' ? 'bg-gray-100' : ''"
                        class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                        {{ __('Description') }}
                    </button>
                </div>
                <div class="w-1/2 md:w-auto">
                    <button @click="activeTab = 'reviews'" :class="activeTab === 'reviews' ? 'bg-gray-100' : ''"
                        class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                        {{ __('Reviews') }}
                    </button>
                </div>
                <div class="w-1/2 md:w-auto">
                    <button @click="activeTab = 'shipping'" :class="activeTab === 'shipping' ? 'bg-gray-100' : ''"
                        class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                        {{ __('Shipping & Returns') }}
                    </button>
                </div>
                <div class="w-1/2 md:w-auto">
                    <button @click="activeTab = 'brands'" :class="activeTab === 'brands' ? 'bg-gray-100' : ''"
                        class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                        {{ __('Product Brand') }}
                    </button>
                </div>
            </div>
            <div x-show="activeTab === 'description'" class="px-5">
                <div role="description" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0">
                    <h3 class="mb-8 text-3xl font-bold font-heading text-orange-500">{{ __('Description') }}</h3>
                    <p class="max-w-2xl mb-8 text-gray-500 font-body">
                        {!! $product->description !!}
                    </p>
                </div>
            </div>
            <div x-show="activeTab === 'reviews'" class="px-5">
                <div role="reviews" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0">
                    <h3 class="mb-8 text-3xl font-bold font-heading text-orange-500">{{ __('Reviews') }}</h3>
                    {{-- show review or  make review --}}
                    @if (auth()->check())
                        @if ($product->reviews->where('user_id', auth()->user()->id)->count() > 0)
                            <div class="mb-8">
                                <h4 class="mb-4 text-2xl font-bold font-heading text-orange-500">
                                    {{ __('Your Review') }}</h4>
                                <div class="flex items-center">
                                    <input type="hidden" name="rating" id="rating" value="0">
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" id="user_id"
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="review_id" id="review_id"
                                        value="{{ $product->reviews->where('user_id', auth()->user()->id)->first()->id }}">
                                    <textarea name="review" id="review" cols="30" rows="10"
                                        class="w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500">{{ $product->reviews->where('user_id', auth()->user()->id)->first()->review }}</textarea>
                                </div>
                                <div class="flex items-center mt-4">
                                    <button
                                        class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">{{ __('Sebd Review') }}</button>
                                </div>
                            </div>
                        @else
                            <div class="mb-8">
                                <h4 class="mb-4 text-2xl font-bold font-heading text-orange-500">
                                    {{ __('Make Review') }}</h4>
                                <div class="flex items-center">
                                    <input type="hidden" name="rating" id="rating" value="0">
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" id="user_id"
                                        value="{{ auth()->user()->id }}">
                                    <textarea name="review" id="review" cols="30" rows="10"
                                        class="w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500"></textarea>
                                </div>
                                <div class="flex items-center">
                                    <button
                                        class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">{{ __('Sebd Review') }}</button>
                                </div>
                        @endif
                    @endif
                </div>
            </div>
            <div x-show="activeTab === 'shipping'" class="px-5">
                <div role="shipping" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0">
                    <h3 class="mb-8 text-3xl font-bold font-heading text-orange-500">
                        {{ __('Shipping & Returns') }}
                    </h3>
                    <p class="max-w-2xl mb-8 text-gray-500 font-body">
                        {{-- {!! $product->shipping !!} --}}
                    </p>

                </div>
            </div>
            <div x-show="activeTab === 'brands'" class="px-5">
                <h3 class="mb-8 text-3xl font-bold font-heading text-orange-500">{{ __('Brand Products') }}</h3>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 -mx-2 px-2">
                    @foreach ($brand_products as $product)
                        <div class="bg-white rounded-lg shadow-2xl">
                            <div class="relative text-center">
                                <a href="{{ route('front.product', $product->slug) }}">
                                    <img class="w-full h-64 object-cover rounded-t-lg"
                                        src="{{ asset('images/products/' . $product->image) }}" alt="">
                                </a>
                                <div class="absolute top-0 right-0 px-4 py-2 bg-orange-500 rounded-bl-lg">
                                    <span class="text-white font-bold font-heading">{{ $product->price }}$</span>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                <a href="{{ route('front.product', $product->slug) }}"
                                    class="block mb-2 text-lg font-bold font-heading text-orange-500 hover:text-orange-400">{{ $product->name }}</a>
                                <div class="flex items-center mb-4">
                                    <div class="flex items-center">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $product->reviews->avg('rating'))
                                                <svg class="w-4 h-4 text-orange-500 fill-current"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-orange-500 fill-current"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span
                                        class="ml-2 text-sm text-gray-500 font-body">{{ $product->reviews->count() }}
                                        {{ __('Reviews') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
