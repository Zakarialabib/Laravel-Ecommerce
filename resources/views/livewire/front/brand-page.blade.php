<div>
    <div class="container mx-auto">
        <div class="w-full px-4 mb-6">
            <div class="relative bg-white overflow-hidden">
                <img class="absolute right-0 top-0 md:w-1/2 sm:w-full h-full object-cover"
                    src="{{ asset('images/brands/' . $brand->featured_image) }}" alt="{{ $brand->name }}">
                <div class="relative max-w-xl pl-6 lg:pl-20 py-10 bg-white bg-opactity-75">
                    <span
                        class="px-3 py-1 border border-blue-500 rounded-full text-xs text-blue-500 font-bold font-heading uppercase">
                        {{ $brand->name }}
                    </span>
                    <div class="mt-6 mb-8">
                        <img class="h-auto" src="{{ asset('images/brands/' . $brand->image) }}"
                            alt="{{ $brand->name }}">
                    </div>
                    <p class="mb-10 px-5 text-md text-gray-800">
                        {{ $brand->description }}
                    </p>
                    <div class="w-full lg:w-auto lg:mb-4 px-4 flex flex-wrap items-center">
                        <select wire:model="perPage" name="perPage"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($paginationOptions as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-4 flex flex-wrap -mx-2 mb-20">
            @forelse ($brand_products as $product)
                <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 mb-6">
                    <div class="p-4 bg-gray-50">
                        @if ($product->is_discount)
                            <span
                                class="absolute top-0 left-0 ml-6 mt-6 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                -{{ $product->discount_percent }}%
                            </span>
                        @endif
                        <a class="block px-2 my-2" href="{{ route('front.product', $product->slug) }}">
                            <img class="mb-5 mx-auto h-56 w-full object-contain" loading="lazy"
                                src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                            <h3 class="mb-2 text-xl font-bold font-heading">
                                {{ $product->name }}
                            </h3>
                            <p class="text-lg font-bold font-heading text-blue-500">
                                <span>
                                    {{ $product->price }}DH
                                </span>
                                @if ($product->old_price)
                                    <span class="text-xs text-gray-500 font-semibold font-heading line-through">
                                        {{ $product->old_price }}DH
                                    </span>
                                @endif
                            </p>
                        </a>
                        <livewire:front.add-to-cart :product="$product" :key="$product->id" />
                    </div>
                </div>
            @empty
                <div class="w-full">
                    <h3 class="text-3xl font-bold font-heading text-blue-900">
                        {{ __('No brand products found') }}
                    </h3>
                </div>
            @endforelse
        </div>
        <div class="text-center">
            {{ $brand_products->links() }}
        </div>
    </div>
</div>
