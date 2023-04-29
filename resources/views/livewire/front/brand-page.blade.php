@section('meta')
    <meta itemprop="url" content="{{ URL::current() }}">
    <meta property="og:title" content="{{ $brand->meta_title }}">
    <meta property="og:description" content="{!! $brand->meta_description !!}">
    <meta property="og:url" content="{{ URL::current() }}">
    <meta property="og:image" content="{{ asset('images/brands/' . $brand->image) }}">
@endsection

<div>
    <div class="w-full px-4 mx-auto" x-data="{ showSidebar: false }">

        <div class="relative bg-white overflow-hidden mb-5">
            <img class="absolute right-0 top-0 md:w-1/2 sm:w-full h-full object-cover"
                src="{{ asset('images/brands/' . $brand->featured_image) }}" alt="{{ $brand->name }}" loading="lazy">
            <div class="relative max-w-xl pl-6 lg:pl-20 py-10 bg-white bg-opactity-75">
                <span
                    class="px-3 py-1 border border-blue-500 rounded-full text-xs text-blue-500 font-bold font-heading uppercase">
                    {{ $brand->name }}
                </span>
                <div class="mt-6 mb-8">
                    <img class="h-auto" src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}"
                        loading="lazy">
                </div>
                <p class="mb-10 px-5 text-md text-gray-800">
                    {{ $brand->description }}
                </p>
                <div class="w-full lg:w-auto justify-center gap-2 lg:mb-4 px-4 flex flex-wrap items-center">
                    <button @click="showSidebar = true" type="button"
                        class="flex lg:hidden items-center justify-center w-12 h-12 text-gray-600 hover:text-beige-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <select wire:model="perPage" name="perPage"
                        class="lg:px-4 md:px-2 py-2 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-beige-500">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <select
                        class="lg:px-4 md:px-2 py-2 bg-white text-gray-700 rounded border border-gray-100 text-xs focus:shadow-outline-blue focus:border-beige-500"
                        id="sortBy" wire:model="sorting">
                        <option selected>{{ __('Choose filters') }}</option>
                        @foreach ($sortingOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <!-- Mobile sidebar -->
            <div x-show="showSidebar" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full" @click.away="showSidebar = false"
                class="fixed top-0 left-0 bottom-0 bg-white z-50 w-5/6 max-w-sm lg:hidden px-6 pt-10 overflow-y-scroll"
                x-cloak>
                <div class="py-4" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openCategory, 'fa-caret-down': !openCategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach ($this->categories as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterProducts('category', {{ $category->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-beige-500 hover:underline">
                                        {{ $category->name }} <small>
                                            ({{ $category->products()->active()->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-t border-gray-900 mt-4 py-2"></div>
                <div class="py-4" x-data="{ openSubcategory: true }">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-bold font-heading">{{ __('Subcategory') }}</h3>
                        <button @click="openSubcategory = !openSubcategory">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openSubcategory, 'fa-caret-down': !openSubcategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openSubcategory">
                        @foreach ($this->subcategories as $subcategory)
                            <li class="mb-2">
                                <button type="button"
                                    wire:click="filterProducts('subcategory', {{ $subcategory->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-beige-500 hover:underline">
                                        {{ $subcategory->name }} <small>
                                            ({{ $subcategory->products()->active()->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($subcategory_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('subcategory')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>
                <div class="border-t border-gray-900 mt-4 py-2"></div>
                <div class="py-4">
                    <h3 class="mb-4 text-2xl font-bold font-heading">{{ __('Price budget') }}</h3>
                    <div class="flex flex-col justify-between  gap-2">
                        <span class="inline-block text-lg font-bold font-heading text-beige-500">
                            <p class="">{{ __('Min Price') }}</p>
                            <x-input type="text" wire:model="minPrice" placeholder="350" />
                        </span>
                        <span class="inline-block text-lg font-bold font-heading text-beige-500">
                            <p class="">{{ __('Max Price') }}</p>
                            <x-input type="text" wire:model="maxPrice" placeholder="1000" />
                        </span>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openCategory, 'fa-caret-down': !openCategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach ($this->categories as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterProducts('category', {{ $category->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-beige-500 hover:underline">
                                        {{ $category->name }} <small>
                                            ({{ $category->products()->active()->count() }})
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
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openSubcategory, 'fa-caret-down': !openSubcategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openSubcategory">
                        @foreach ($this->subcategories as $subcategory)
                            <li class="mb-2">
                                <button type="button"
                                    wire:click="filterProducts('subcategory', {{ $subcategory->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-beige-500 hover:underline">
                                        {{ $subcategory->name }} <small>
                                            ({{ $subcategory->products()->active()->count() }})
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($subcategory_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('subcategory')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>

                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-4 text-2xl font-bold font-heading">{{ __('Price budget') }}</h3>
                    <div class="flex md:flex-col justify-between space-y-2">
                        <span class="inline-block text-lg font-bold font-heading text-beige-500 hover:underline">
                            <p class="">{{ __('Min Price') }}</p>
                            <x-input type="text" wire:model="minPrice" placeholder="350" />
                        </span>
                        <span class="inline-block text-lg font-bold font-heading text-beige-500 hover:underline">
                            <p class="">{{ __('Max Price') }}</p>
                            <x-input type="text" wire:model="maxPrice" placeholder="1000" />
                        </span>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/4 px-4" x-data="{ loading: false }">

                <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 
 xs:grid-cols-2 mb-10" id="product-container">
                    @forelse ($brandproducts as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="w-full">
                            <h3 class="text-3xl font-bold font-heading text-blue-900">
                                {{ __('No brand products found') }}
                            </h3>
                        </div>
                    @endforelse
                </div>
                <div class="flex justify-center mt-10" x-show="!loading && '{{ $brandproducts->hasMorePages() }}'">
                    <div x-intersect="() => { $wire.loadMore(() => loading = false) }"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 transform translate-y-10"
                        x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex items-center justify-center text-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM20 12a8 8 0 01-8 8v4c4.627 0 10-5.373 10-12h-4zm-2-5.291A7.962 7.962 0 0120 12h4c0-3.042-1.135-5.824-3-7.938l-3 2.647z">
                                </path>
                            </svg>
                            <span>{{ __('Loading...') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
