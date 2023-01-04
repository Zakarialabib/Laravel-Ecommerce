@props(['product'])

<div class="mb-5 bg-white rounded-lg shadow-2xl">
    <div class="relative text-center">
        <a href="{{ route('front.product', $product->slug) }}">
            <img class="w-full h-auto object-cover rounded-t-lg pt-4"
                src="{{ asset('images/products/' . $product->image) }}" onerror="this.onerror=null; this.remove();"
                alt="{{ $product->name }}">
            <meta itemprop="image" content="{{ asset('images/products/' . $product->image) }}">
        </a>
        <div class="absolute top-0 right-0 mb-3 p-2 bg-orange-500 rounded-bl-lg">
            <span class="text-white font-bold text-sm">{{ $product->price }}DH</span>
        </div>
        @if ($product->old_price)
            <div class="absolute top-0 left-0 p-2 bg-red-600 rounded-br-lg">
                <span class="text-white font-bold text-md">
                    <small>{{ $product->old_price }} </small> - {{ $product->discount }}% 
                </span>
            </div>
        @endif
    </div>
    <div class="px-2 py-4 text-center">
        <a href="{{ route('front.product', $product->slug) }}"
            class="block mb-2 text-md font-bold font-heading text-orange-500 hover:text-orange-400">
            {{ Str::limit($product->name, 35) }}
        </a>
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
        @if($product?->reviews)
        <div class="flex justify-center mb-4">
            <div class="flex items-center">
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $product->reviews->avg('rating'))
                        <svg class="w-4 h-4 text-orange-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-orange-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 17.27l-5.18 2.73 1-5.81-4.24-3.63 5.88-.49L12 6.11l2.45 5.51 5.88.49-4.24 3.63 1 5.81z" />
                        </svg>
                    @endif
                @endfor
            </div>
            <span class="ml-2 text-sm text-gray-500 font-body">
                {{ $product->reviews->count() }} {{ __('Reviews') }}
            </span>
        </div>
        @endif
        <div class="flex justify-center">
            <livewire:front.add-to-cart :product="$product" :key="$product->id" />
        </div>
    </div>
</div>
