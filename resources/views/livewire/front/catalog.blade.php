<div>
    <div class="mx-auto px-4">
        <div class="mb-10 items-center justify-between bg-white py-4">
            <div class="w-full lg:mb-4 px-4 flex flex-wrap justify-between">
                <h2 class="lg:text-2xl sm:text-xl font-bold">
                    {{ $products->where('status', 1)->count() }} {{ __('Watches') }}
                </h2>
                <div class="w-full sm:w-auto">
                    <select
                        class="px-5 py-3 mr-2 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                        id="sortBy" wire:model="sorting">
                        <option disabled>{{ __('Best Selling') }}</option>
                        <option value="name">{{ __('Order Alphabetic, A-Z') }}</option>
                        <option value="name-desc">{{ __('Order Alphabetic, Z-A') }}</option>
                        <option value="price">{{ __('Price, low to high') }}</option>
                        <option value="price-desc">{{ __('Price, high to low') }}</option>
                        <option value="date">{{ __('Date, new to old') }}</option>
                        <option value="date-desc">{{ __('Date, old to new') }}</option>
                    </select>
                    <select
                        class="px-5 py-3 mr-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                        id="perPage" wire:model="perPage">
                        <option value="20" selected>20 {{ __('Items') }}</option>
                        <option value="50">50 {{ __('Items') }}</option>
                        <option value="100">100 {{ __('Items') }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full lg:hidden px-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full px-2 mb-4">
                        <div class="py-6 px-2 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Category') }}</a>
                            <ul class="mt-6 -mb-2 flex overflow-x-scroll">
                                @foreach ($this->categories as $category)
                                    <li class="w-1/2 px-2 mb-2">
                                        <x-button type="button" wire:click="filterProductCategories({{ $category->id }})"
                                            dangerOutline>
                                            {{ $category->name }} <small> ({{ $category->products->where('status', 1)->count() }})</small>
                                        </x-button>
                                    </li>
                                @endforeach

                                @foreach ($this->subcategories as $subcategory)
                                    <li class="w-1/2 px-2 mb-2">
                                        <x-button type="button"
                                            wire:click="filterProductSubcategories({{ $subcategory->id }})" dangerOutline>
                                            {{ $subcategory->name }} <small>
                                                ({{ $subcategory->products->where('status', 1)->count() }})
                                            </small>
                                        </x-button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="w-full px-2 mb-4">
                        <div class="py-6 px-4 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Price') }}</a>
                            <div class="mt-6 -mb-2">
                                <input
                                    class="w-full mb-4 outline-none appearance-none bg-gray-100 h-1 rounded cursor-pointer"
                                    type="range" min="1" max="10000" value="50">
                                <div class="flex justify-between">
                                    <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                        {{ $minPrice }}
                                    </span>
                                    <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                        {{ $maxPrice }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 mb-4">
                        <div class="py-6 px-2 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Brands') }}</a>
                            <div class="mt-6 -mb-2 flex overflow-x-scroll">
                                @foreach ($this->brands as $brand)
                                    <div class="w-1/2 px-2 mb-2">
                                        <x-button type="button" wire:click="filterProductBrands({{ $brand->id }})"
                                            warningOutline>
                                            {{ $brand->name }} <small> ({{ $brand->products->where('status', 1)->count() }})</small>
                                        </x-button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Category') }}</h3>
                    <ul>
                        @foreach ($this->categories as $category)
                            <li class="mx-2 mb-2">
                                <button type="button" wire:click="filterProductCategories({{ $category->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $category->name }} <small> ({{ $category->products->where('status', 1)->count() }})</small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                        @foreach ($this->subcategories as $subcategory)
                            <li class="mb-2">
                                <button type="button" wire:click="filterProductSubcategories({{ $subcategory->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $subcategory->name }} <small>
                                            ({{ $subcategory->products->where('status', 1)->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Price') }}</h3>
                    <div>
                        <input class="w-full mb-4 outline-none appearance-none bg-gray-100 h-1 rounded cursor-pointer"
                            type="range" min="1" max="100" value="50">
                        <div class="flex justify-between">
                            <span
                                class="inline-block text-lg font-bold font-heading text-blue-300">{{ $minPrice }}</span>
                            <span
                                class="inline-block text-lg font-bold font-heading text-blue-300">{{ $maxPrice }}</span>
                        </div>
                    </div>
                </div>
                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Brands') }}</h3>
                    <ul class="flex flex-wrap items-center">
                        @foreach ($this->brands as $brand)
                            <li class="mx-2 mb-2">
                                <button type="button" wire:click="filterProductBrands({{ $brand->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $brand->name }} <small> ({{ $brand->products->count() }})</small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-3/4 px-4">
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
