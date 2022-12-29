<div>
    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4 mb-14">
                <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                    <x-product-carousel :image="$product->image" :gallery="$product->gallery" :video="$product->embeded_video" />
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <div>
                        <div class="mb-5 pb-5 border-b">
                            <span class="text-gray-500">
                                @isset($product->brand)
                                    <a
                                        href="{{ route('front.brandPage', $product->brand->slug) }}">{{ $product->brand->name }}</a>
                                @endisset /
                                {{ $product->category->name }}
                                @isset($product->subcategory)
                                    / {{ $product->subcategory->name }}
                                @endisset
                            </span>
                            <h2 class="mt-2 mb-6 max-w-xl text-5xl md:text-4xl font-bold font-heading">
                                {{ $product->name }}
                            </h2>
                            <div class="flex items-center">
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
                                {{ $product->price }}DH
                            </span>
                            @if ($product->old_price)
                                <span class="text-gray-500 line-through">
                                    -{{ $product->discount }}%
                                </span>
                                <span class="font-normal text-base text-gray-400 line-through">
                                    {{ $product->old_price }}DH
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="flex mb-5 pb-5 border-b">
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
                            @if ($product->status == 1)
                                <a class="block hover:bg-orange-400 text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase transition duration-200 bg-orange-500 cursor-pointer"
                                    wire:click="AddToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                                    {{ __('Add to cart') }}
                                </a>
                            @else
                                <div class="text-sm font-bold">
                                    <span class="text-red-500">● {{ __('Out of Stock') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <livewire:front.order-form :product="$product" />

                    <ul class="my-4 ">
                        <li class="text-gray-500 py-1">
                            <i class="text-blue-600 fa fa-check" aria-hidden="true"></i> {{ __('Fast delivery') }}
                        </li>
                        <li class="text-gray-500 py-1">
                            <i class="text-blue-600 fa fa-check" aria-hidden="true"></i>
                            {{ __('Watch specialist over 40 years of experience') }}
                        </li>
                        <li class="text-gray-500 py-1">
                            <i class="text-blue-600 fa fa-check" aria-hidden="true"></i>
                            <strong>{{ __('Official dealer') }}</strong>
                        </li>
                    </ul>

                    <div class="flex items-center">
                        <span class="mr-8 text-gray-500 font-bold font-heading uppercase">{{ __('SHARE IT') }}</span>
                        <a class="mr-1 w-8 h-8" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="mr-1 w-8 h-8" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="w-8 h-8" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="w-8 h-8" href="#">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <div x-data="{ activeTab: 'description' }" class="container mx-auto px-4 border bg-white shadow-xl">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                <div
                    class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                    <button @click="activeTab = 'description'"
                        :class="activeTab === 'description' ? 'text-orange-400' : ''">
                        {{ __('Description') }}
                    </button>
                </div>
                <div
                    class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                    <button @click="activeTab = 'reviews'" :class="activeTab === 'reviews' ? 'text-orange-400' : ''">
                        {{ __('Reviews') }}
                    </button>
                </div>
                <div
                    class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                    <button @click="activeTab = 'shipping'" :class="activeTab === 'shipping' ? 'text-orange-400' : ''">
                        {{ __('Shipping & Returns') }}
                    </button>
                </div>
                <div
                    class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                    <button @click="activeTab = 'brands'" :class="activeTab === 'brands' ? 'text-orange-400' : ''">
                        {{ __('Product Brand') }}
                    </button>
                </div>
            </div>
            <div x-show="activeTab === 'description'" class="px-5 mb-10">
                <div role="description" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0">
                    <p class="mb-8 max-w-2xl text-gray-500 font-body">
                        {!! $product->description !!}
                    </p>
                </div>
            </div>
            <div x-show="activeTab === 'reviews'" class="px-5 mb-10">
                <div role="reviews" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0">
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
                                <div class="flex items-center my-4">
                                    <button
                                        class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">{{ __('Send Review') }}</button>
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
                                <div class="flex items-center my-4">
                                    <button class="px-8 py-2 text-white bg-orange-500 rounded-lg focus:outline-none">
                                        {{ __('Send Review') }}
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div x-show="activeTab === 'shipping'" class="px-5 mb-10">
                <div role="shipping" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0">
                    <p class="mb-8 max-w-2xl text-gray-500 font-body">
                        {{-- {!! $product->shipping !!} --}}
                    </p>
                </div>
            </div>
            <div x-show="activeTab === 'brands'" class="px-5 mb-10">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 -mx-2 px-2">
                    @foreach ($brand_products as $product)
                        <div class="bg-white rounded-lg shadow-2xl">
                            <div class="relative text-center">
                                <a href="{{ route('front.product', $product->slug) }}">
                                    <img class="w-full h-auto object-cover rounded-t-lg"
                                        src="{{ asset('images/products/' . $product->image) }}" alt="">
                                </a>
                                <div class="absolute top-0 right-0 px-4 py-2 bg-orange-500 rounded-bl-lg">
                                    <span class="text-white font-bold font-heading">{{ $product->price }}DH</span>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                <a href="{{ route('front.product', $product->slug) }}"
                                    class="block mb-2 text-lg font-bold font-heading text-orange-500 hover:text-orange-400">{{ $product->name }}</a>
                                <div class="flex justify-center mb-4">
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
