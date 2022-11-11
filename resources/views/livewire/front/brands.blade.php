<div>
    <div class="container mx-auto px-10">
        <div class="flex flex-wrap -mx-4 mb-10 items-center justify-between">
            <div class="w-full lg:w-auto px-4 flex flex-wrap items-center">
                <div class="w-full sm:w-auto mb-4 sm:mb-0 mr-5">
                    <select
                        class="pl-8 py-4 bg-white text-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                        id="sortBy" wire:model="sorting">
                        <option disabled>{{ __('Best Selling') }}</option>
                        <option value="name">{{ __('Order Alphabetic, A-Z') }}</option>
                        <option value="name-desc">{{ __('Order Alphabeticy, Z-A') }}</option>
                        <option value="price">{{ __('Price, low to high') }}</option>
                        <option value="price-desc">{{ __('Price, high to low') }}</option>
                        <option value="date">{{ __('Date, new to old') }}</option>
                        <option value="date-desc">{{ __('Date, old to new') }}</option>
                    </select>

                    <select
                        class="pl-8 py-4 bg-white text-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                        id="perPage" wire:model="pagesize">
                        <option value="20" selected>20 Items</option>
                        <option value="50">50 Items</option>
                        <option value="100">100 Items</option>
                    </select>
                </div>

                <div class="flex flex-wrap ml-3 -mx-5">
                    @foreach ($brands as $brand)
                        <x-button type="button" primaryOutline class="mx-2" wire:click="filterProducts({{ $brand->id }})">
                            {{ $brand->name }}</x-button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-24">
            @foreach ($products as $product)
                <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6">
                    <div class="p-6 bg-gray-50">
                        @if ($product->is_discount)
                            <span
                                class="absolute top-0 left-0 ml-6 mt-6 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                -{{ $product->discount_percent }}%
                            </span>
                        @endif
                        <a class="block px-6 mt-6 mb-2" href="{{ route('front.product', $product->slug) }}">
                            <img class="mb-5 mx-auto h-56 w-full object-contain"
                            loading="lazy" src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                            <h3 class="mb-2 text-xl font-bold font-heading">
                                {{ $product->name }}
                            </h3>
                            <p class="text-lg font-bold font-heading text-blue-500">
                                <span>
                                    {{ $product->price }} DH
                                </span>
                                <span class="text-xs text-gray-500 font-semibold font-heading line-through">
                                    {{ $product->old_price }} DH
                                </span>
                            </p>
                        </a>
                        <a class="ml-auto mr-2 flex items-center justify-center w-12 h-12 border rounded-lg hover:border-gray-500"
                            href="#">
                            <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="5" width="2" height="12" fill="#161616"></rect>
                                <rect x="12" y="5" width="2" height="12"
                                    transform="rotate(90 12 5)" fill="#161616"></rect>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
