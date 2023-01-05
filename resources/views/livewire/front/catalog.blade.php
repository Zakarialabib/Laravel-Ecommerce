<div>
    <div class="mx-auto px-4">
        <div class="mb-5 items-center justify-between bg-white py-4">
            <div class="w-full px-4 flex flex-wrap justify-between">
                <h2 class="lg:text-2xl sm:text-xl font-bold">
                    <span class="text-sm hover:text-orange-500 mr-4">
                        <a href="/">
                        <svg class="h-4 w-4 text-gray-500" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.6666 5.66667L9.66662 1.28333C9.20827 0.873372 8.6149 0.646725 7.99996 0.646725C7.38501 0.646725 6.79164 0.873372 6.33329 1.28333L1.33329 5.66667C1.0686 5.9034 0.857374 6.1938 0.713683 6.51854C0.569993 6.84328 0.497134 7.1949 0.499957 7.55V14.8333C0.499957 15.4964 0.763349 16.1323 1.23219 16.6011C1.70103 17.0699 2.33692 17.3333 2.99996 17.3333H13C13.663 17.3333 14.2989 17.0699 14.7677 16.6011C15.2366 16.1323 15.5 15.4964 15.5 14.8333V7.54167C15.5016 7.18797 15.4282 6.83795 15.2845 6.51474C15.1409 6.19152 14.9303 5.90246 14.6666 5.66667V5.66667ZM9.66662 15.6667H6.33329V11.5C6.33329 11.279 6.42109 11.067 6.57737 10.9107C6.73365 10.7545 6.94561 10.6667 7.16662 10.6667H8.83329C9.0543 10.6667 9.26626 10.7545 9.42255 10.9107C9.57883 11.067 9.66662 11.279 9.66662 11.5V15.6667ZM13.8333 14.8333C13.8333 15.0543 13.7455 15.2663 13.5892 15.4226C13.4329 15.5789 13.221 15.6667 13 15.6667H11.3333V11.5C11.3333 10.837 11.0699 10.2011 10.6011 9.73223C10.1322 9.26339 9.49633 9 8.83329 9H7.16662C6.50358 9 5.8677 9.26339 5.39886 9.73223C4.93002 10.2011 4.66662 10.837 4.66662 11.5V15.6667H2.99996C2.77894 15.6667 2.56698 15.5789 2.4107 15.4226C2.25442 15.2663 2.16662 15.0543 2.16662 14.8333V7.54167C2.16677 7.42335 2.19212 7.30641 2.24097 7.19865C2.28982 7.09089 2.36107 6.99476 2.44996 6.91667L7.44996 2.54167C7.60203 2.40807 7.79753 2.33439 7.99996 2.33439C8.20238 2.33439 8.39788 2.40807 8.54996 2.54167L13.55 6.91667C13.6388 6.99476 13.7101 7.09089 13.7589 7.19865C13.8078 7.30641 13.8331 7.42335 13.8333 7.54167V14.8333Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a> / <a
                            href="{{ URL::current() }}">{{ __('Catalog') }}</a> / </span>
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
                                        <x-button type="button"
                                            wire:click="filterProductCategories({{ $category->id }})" dangerOutline>
                                            {{ $category->name }} 
                                            <span class="text-sm ml-2">
                                                ({{ $category->products->where('status', 1)->count() }})
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
                                                ({{ $subcategory->products->where('status', 1)->count() }})
                                            </span>
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
                                    type="range" min="{{ $this->minPrice }}" max="{{ $this->maxPrice }}"
                                    wire:model="priceRange">
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
                    </div>
                    <div class="w-full px-2 mb-4">
                        <div class="py-6 px-2 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Brands') }}</a>
                            <div class="mt-6 -mb-2 flex overflow-x-scroll">
                                @foreach ($this->brands as $brand)
                                    <div class="w-1/2 px-2 mb-2">
                                        <x-button type="button" wire:click="filterProductBrands({{ $brand->id }})"
                                            warningOutline>
                                            {{ $brand->name }} 
                                            <span class="text-sm ml-2">
                                                ({{ $brand->products->where('status', 1)->count() }})
                                            </span>
                                        </x-button>
                                    </div>
                                @endforeach
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
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $category->name }} <small>
                                            ({{ $category->products->where('status', 1)->count() }})
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
                            type="range" min="{{ $this->minPrice }}" max="{{ $this->maxPrice }}"
                            wire:model="priceRange">
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
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
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
