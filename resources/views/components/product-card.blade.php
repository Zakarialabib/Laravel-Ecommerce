@props(['product'])

<div itemprop="itemListElement" itemscope itemtype="https://schema.org/Product">
    <div itemprop="brand" content="{{ $product->brand->name }}"></div>
    <div itemprop="sku" content="{{ $product->code }}"></div>
    <div itemprop="description" content="{{ $product->description }}"></div>

    <div class="mb-5 bg-white rounded-lg shadow-2xl sm:w-full">
        <div class="relative text-left">
            <a href="{{ route('front.product', $product->slug) }}" class="flex justify-center" itemprop="url">
                <img class="lg:h-[250px] md:h-[150px] object-fill py-2"
                    src="{{ asset('images/products/' . $product->image) }}"
                    alt="{{ $product->name }}" loading="lazy" />
                <meta itemprop="image" content="{{ asset('images/products/' . $product->image) }}" />
            </a>

            @if ($product->old_price && $product->discount != 0)
                <div class="absolute top-0 right-0 mb-3 p-2 bg-red-500 rounded-bl-lg">
                    <span class="text-white font-bold text-sm">
                        - {{ $product->discount }}%
                    </span>
                </div>
            @endif
        </div>
        <div class="px-2 pb-4 text-left">
            <div class="w-full flex-none text-sm flex items-center justify-center text-gray-600">
                @if ($product->reviews->isNotEmpty())
                    <div class="rating" itemprop="aggregateRating" itemscope
                        itemtype="https://schema.org/AggregateRating">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->reviews->avg('rating'))
                                    <svg class="w-4 h-4 text-orange-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-sm text-gray-500 font-body">
                                {{ $product->reviews->count() }} {{ __('Reviews') }}
                            </span>
                            <meta itemprop="ratingCount" content="{{ $product->reviews->count() }}">
                            <meta itemprop="ratingValue" content="{{ $product->reviews->avg('rating') }}">
                        </div>
                    </div>
                @endif

                @if ($product->status == 1)
                    <div class="text-sm font-bold">
                        <span class="text-green-500">● {{ __('In Stock') }}</span>
                    </div>
                @else
                    <div class="text-sm font-bold">
                        <span class="text-red-500">●
                            {{ __('Out of Stock') }}</span>
                    </div>
                @endif

            </div>

            <a href="{{ route('front.product', $product->slug) }}">
                <h4 class="block text-center mb-2 lg:text-md md:text-sm font-bold font-heading hover:text-beige-400"
                    itemprop="name">
                    {{ Str::limit($product->name, 40) }}</h4>
            </a>

            <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <p class="text-center text-beige-400 hover:text-beige-800 font-bold text-md mt-2"><span
                        itemprop="price">{{ $product->price }}</span>DH

                    @if ($product->old_price && $product->discount != 0)
                        <del class="ml-4 text-black">{{ $product->old_price }} DH </del>
                    @endif
                </p>

                <meta itemprop="priceValidUntil" content="{{ now()->addWeek()->toIso8601String() }}">
                <meta itemprop="priceCurrency" content="MAD">
                <meta itemprop="availability"
                    content="{{ $product->status ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
            </div>

            <div class="flex justify-center">
                <livewire:front.add-to-cart :product="$product" :key="$product->id" />
            </div>
        </div>
    </div>
</div>
