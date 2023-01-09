<div>
    <div class="w-full px-4 mx-auto">
        <div class="mb-10 items-center justify-between bg-white py-4">
            <div class="w-full lg:mb-4 px-4 flex flex-wrap justify-between">
                <div class="py-4 flex items-center flex-wrap">
                    <ul class="flex flex-wrap items-center">
                        <li class="inline-flex items-center">
                            <a href="/" class="text-gray-600 hover:text-blue-500">
                                <svg class="w-5 h-auto fill-current mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                                </svg>
                            </a>
                            <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                        </li>
                        <li class="inline-flex items-center">
                            <a href="{{ URL::current() }}" class="text-gray-600 hover:text-blue-500">
                                {{ __('Catalog') }}
                            </a>

                            <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                        </li>
                        <li class="inline-flex items-center ml-2">
                            <p class="lg:text-2xl sm:text-xl font-bold text-gray-600 hover:text-blue-500">
                                {{ $products->count() }} {{ __('Watches') }}
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="w-full sm:w-auto flex justify-center my-2 overflow-x-scroll">
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
            <div class="flex flex-wrap w-full lg:hidden px-3">
                <div class="w-full px-2 mb-4" x-data="{ openFilters: false }">
                    <div class="py-6 px-3 text-center bg-gray-50">
                        <div class="flex justify-between mb-8">
                            <h3 class="text-xl font-bold font-heading">{{ __('Filters') }}</h3>
                            <button @click="openFilters = !openFilters">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div x-show="openFilters">
                            <div class="w-full px-2 overflow-x-scroll bg-gray-50">
                                <ul class="my-6 w-full flex">
                                    <a class="font-bold font-heading" href="#">{{ __('Categories') }}</a>
                                    @foreach ($this->categories as $category)
                                        <li class="w-1/2 px-2 mb-2">
                                            <x-button type="button"
                                                wire:click="filterProductCategories({{ $category->id }})"
                                                dangerOutline>
                                                {{ $category->name }}
                                                <span class="text-sm ml-2">
                                                    ({{ $category->count() }})
                                                </span>
                                            </x-button>
                                        </li>
                                    @endforeach

                                    @foreach ($this->subcategories as $subcategory)
                                        <li class="w-1/2 px-2 mb-2">
                                            <x-button type="button"
                                                wire:click="filterProductSubcategories({{ $subcategory->id }})"
                                                dangerOutline>
                                                {{ $subcategory->name }}
                                                <span class="text-sm ml-2">
                                                    ({{ $subcategory->count() }})
                                                </span>
                                            </x-button>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mb-6 text-center w-full">
                                    <a class="font-bold font-heading" href="#">{{ __('Price') }}</a>
                                    <div class="mt-6 -mb-2">
                                        <input class="w-full mb-4 outline-none appearance-none rounded cursor-pointer"
                                            type="text" wire:model="minPrice">
                                        <input class="w-full mb-4 outline-none appearance-none rounded cursor-pointer"
                                            type="text" wire:model="maxPrice">
                                        <div class="flex justify-between">
                                            <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                                {{ $this->minPrice }}
                                            </span>
                                            <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                                {{ $this->maxPrice }}
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full mb-6 text-center">
                                    <a class="font-bold font-heading" href="#">{{ __('Brands') }}</a>
                                    <div class="mt-6 -mb-2 flex overflow-x-scroll">
                                        @foreach ($this->brands as $brand)
                                            <div class="w-1/2 px-2 mb-2">
                                                <x-button type="button"
                                                    wire:click="filterProductBrands({{ $brand->id }})"
                                                    warningOutline>
                                                    {{ $brand->name }}
                                                    <span class="text-sm ml-2">
                                                        ({{ $brand->count() }})
                                                    </span>
                                                </x-button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block w-1/4 px-3">
                    <div class="mb-6 p-4 bg-gray-50" x-data="{ openCategory: true }">
                        <div class="flex justify-between mb-8">
                            <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                            <button @click="openCategory = !openCategory">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                        </div>
                        <ul x-show="openCategory">
                            @foreach ($this->categories as $category)
                                <li class="mb-2">
                                    <button type="button" wire:click="filterProductCategories({{ $category->id }})">
                                        <span
                                            class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                            {{ $category->name }} <small>
                                                ({{ $category->count() }})
                                            </small>
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-6 p-4 bg-gray-50" x-data="{ openSubcategory: true }">
                        <div class="flex justify-between mb-8">
                            <h3 class="text-xl font-bold font-heading">{{ __('Subcategory') }}</h3>
                            <button @click="openSubcategory = !openSubcategory">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                        </div>
                        <ul x-show="openSubcategory">
                            @foreach ($this->subcategories as $subcategory)
                                <li class="mb-2">
                                    <button type="button"
                                        wire:click="filterProductSubcategories({{ $subcategory->id }})">
                                        <span
                                            class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                            {{ $subcategory->name }} <small>
                                                ({{ $subcategory->count() }})
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
                            <input class="w-full mb-4 outline-none appearance-none rounded cursor-pointer"
                                type="text" wire:model="minPrice">
                            <input class="w-full mb-4 outline-none appearance-none rounded cursor-pointer"
                                type="text" wire:model="maxPrice">
                            <div class="flex justify-between">
                                <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                    {{ $this->minPrice }}
                                </span>
                                <span class="inline-block text-lg font-bold font-heading text-blue-300">
                                    {{ $this->maxPrice }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 p-4 bg-gray-50" x-data="{ openbrands: true }">
                        <div class="flex justify-between mb-8">
                            <h3 class="text-xl font-bold font-heading">{{ __('Brands') }}</h3>
                            <button @click="openbrands = !openbrands">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                        </div>
                        <ul x-show="openbrands" class="flex flex-wrap items-center">
                            @foreach ($this->brands as $brand)
                                <li class="mx-2 mb-2">
                                    <button type="button" wire:click="filterProductBrands({{ $brand->id }})">
                                        <span
                                            class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                            {{ $brand->name }} <small> ({{ $brand->products->count() }})</small>
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="w-full lg:w-3/4 px-4" wire:loading.class.delay="opacity-50">
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
