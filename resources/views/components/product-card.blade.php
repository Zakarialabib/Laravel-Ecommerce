@props(['product'])

<div class="px-3 mb-10 bg-white rounded-lg shadow-2xl">
    <div class="relative text-center">
        <a href="{{ route('front.product', $product->slug) }}">
            <img class="w-full h-auto object-cover rounded-t-lg" src="{{ asset('images/products/' . $product->image) }}"
                onerror="this.onerror=null; this.remove();" alt="{{ $product->name }}">
        </a>
        <div class="absolute top-0 right-0 px-4 py-2 bg-orange-500 rounded-bl-lg">
            <span class="text-white font-bold font-heading">{{ $product->price }}DH</span>
        </div>
        @if ($product->old_price)
            <div
                class="absolute top-0 left-0 px-2 py-1 text-xs font-bold font-heading bg-transparent border-2 border-red-500 rounded-full text-red-500">
                -{{ $product->discount }}%
            </div>
        @endif
    </div>
    <div class="p-4 text-center">
        <a href="{{ route('front.product', $product->slug) }}"
            class="block mb-2 text-lg font-bold font-heading text-orange-500 hover:text-orange-400">{{ $product->name }}</a>
        @if ($product->status == 1)
            <div class="text-sm font-bold">
                <span class="text-green-500">● {{ __('in Stock') }}</span>
            </div>
        @else
            <div class="text-sm font-bold">
                <span class="text-red-500">●
                    {{ __('Out of Stock') }}</span>
            </div>
        @endif
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
        <div class="flex justify-between">
            <livewire:front.add-to-cart :product="$product" :key="$product->id" />
        </div>
    </div>
</div>
