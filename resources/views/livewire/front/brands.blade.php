<div>
    <div class="container mx-auto px-4">
        <div class="-mx-4 mb-10 md:mb-5 items-center justify-between">
            <div class="w-full lg:mb-4 px-4 flex flex-row items-center">
                <h2 class="mb-1 text-2xl font-bold lg:px-5 sm:px-2">
                    {{ __('Brands') }}
                </h2>
                <div class="w-full sm:w-auto">
                    <select
                        class="px-5 py-3 mr-2 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                        id="sortBy" wire:model="sorting">
                        <option disabled>{{ __('Best Selling') }}</option>
                        <option value="name">{{ __('Order Alphabetic, A-Z') }}</option>
                        <option value="name-desc">{{ __('Order Alphabetic, Z-A') }}</option>
                        <option value="price">{{ __('Price, low to high') }}</option>
                        <option value="price-desc">{{ __('Price, high to low') }}</option>
                        <option value="date">{{ __('Date, new to old') }}</option>
                        <option value="date-desc">{{ __('Date, old to new') }}</option>
                    </select>

                    <select wire:model="perPage" name="perPage"
                        class="px-5 py-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="overflow-x-scroll flex sm-w-full py-2 lg:pl-5 sm:pl-0">
                @foreach ($this->brands as $brand)
                    <x-button type="button" primaryOutline class="mx-2"
                        wire:click="filterProductBrands({{ $brand->id }})">
                        {{ $brand->name }}</x-button>
                @endforeach
            </div>
            <div class="overflow-x-scroll flex py-2 sm:w-full lg:pl-5 sm:pl-0">
                @foreach ($this->categories as $category)
                    <x-button type="button" blackOutline class="mx-2"
                        wire:click="filterProductCategories({{ $category->id }})">{{ $category->name }}</x-button>
                @endforeach
                <div x-data="{ show: true }" x-init="window.setTimeout(() => show = false, 1000)" x-show.transition.fade.250ms="show"
                    x-transition:enter="transition-fade-in" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-fade-out"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    @foreach ($this->categories as $category)
                        @if ($category->id === $filterProductCategories)
                            @foreach ($category->subcategories as $subcategory)
                                <x-button type="button" blackOutline class="mx-2"
                                    wire:click="filterProductSubcategories({{ $subcategory->id }})">
                                    {{ $subcategory->name }}
                                </x-button>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-24">
            @forelse ($this->products as $product)
                <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 mb-6">
                    <div class="p-6 bg-gray-50">
                        @if ($product->is_discount)
                            <span
                                class="absolute top-0 left-0 ml-6 mt-6 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                -{{ $product->discount_percent }}%
                            </span>
                        @endif
                        <a class="block px-6 mt-6 mb-2" href="{{ route('front.product', $product->slug) }}">
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
                        {{ __('No products found') }}
                    </h3>
                </div>
            @endforelse
        </div>
        <div class="text-center">
            {{ $this->products->links() }}
        </div>
    </div>
</div>
