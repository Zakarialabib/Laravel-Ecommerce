<div>
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-4 mb-10 md:mb-5 items-center justify-between">
            <div class="w-full lg:w-auto px-4 flex flex-wrap items-center">
                <div class="w-full sm:w-auto">
                    <select
                        class="px-5 py-3 mr-2 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
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
                        class="px-5 py-3 mr-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                        id="perPage" wire:model="pagesize">
                        <option value="20" selected>20 Items</option>
                        <option value="50">50 Items</option>
                        <option value="100">100 Items</option>
                    </select>
                </div>

                <button type="button" class="md:hidden inline-block mr-3 h-full p-4 bg-white rounded-md border"
                    wire:click="changeView('list')">
                    <svg width="20" height="24" viewbox="0 0 20 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="4" height="4" rx="2" fill="#2B51C6"></rect>
                        <rect x="8" width="4" height="4" rx="2" fill="#2B51C6"></rect>
                        <rect x="16" width="4" height="4" rx="2" fill="#2B51C6"></rect>
                        <rect y="10" width="4" height="4" rx="2" fill="#2B51C6"></rect>
                        <rect x="8" y="10" width="4" height="4" rx="2" fill="#2B51C6">
                        </rect>
                        <rect x="16" y="10" width="4" height="4" rx="2" fill="#2B51C6">
                        </rect>
                        <rect y="20" width="4" height="4" rx="2" fill="#2B51C6"></rect>
                        <rect x="8" y="20" width="4" height="4" rx="2" fill="#2B51C6">
                        </rect>
                        <rect x="16" y="20" width="4" height="4" rx="2" fill="#2B51C6">
                        </rect>
                    </svg>
                </button>
                <button type="button" class="md:hidden inline-block h-full p-4 hover:bg-white border rounded-md group"
                    wire:click="changeView('grid')">
                    <svg class="text-gray-200 group-hover:text-blue-300" width="28" height="24"
                        viewbox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="4" height="4" rx="2" fill="currentColor"></rect>
                        <rect x="8" width="4" height="4" rx="2" fill="currentColor"></rect>
                        <rect x="16" width="4" height="4" rx="2" fill="currentColor"></rect>
                        <rect x="24" width="4" height="4" rx="2" fill="currentColor">
                        </rect>
                        <rect y="10" width="4" height="4" rx="2" fill="currentColor">
                        </rect>
                        <rect x="8" y="10" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                        <rect x="16" y="10" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                        <rect x="24" y="10" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                        <rect y="20" width="4" height="4" rx="2" fill="currentColor">
                        </rect>
                        <rect x="8" y="20" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                        <rect x="16" y="20" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                        <rect x="24" y="20" width="4" height="4" rx="2"
                            fill="currentColor"></rect>
                    </svg>
                </button>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full lg:hidden px-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full px-2 mb-4">
                        <div class="py-6 px-2 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Category') }}</a>
                            <ul class="mt-6 -mb-2 flex overflow-x-scroll">
                                @forelse ($categories as $category)
                                    <li class="w-1/2 px-2 mb-2">
                                        <x-button type="button" wire:click="filterCategories({{ $category->id }})"
                                            dangerOutline>{{ $category->name }}</x-button>
                                        <ul class="hidden text-left mt-2">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li class="w-1/2 px-2 mb-2">
                                                    <x-button type="button"
                                                        wire:click="filterSubCategories({{ $subcategory->id }})"
                                                        dangerOutline>{{ $subcategory->name }}</x-button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @empty
                                    <div class="w-full">
                                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                                            {{ __('No products found') }}
                                        </h3>
                                    </div>
                                @endforelse
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
                        <div class="py-6 px-4 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#">{{ __('Brands') }}</a>
                            <div class="mt-6 -mb-2 flex overflow-x-scroll">
                                @foreach ($brands as $brand)
                                    <div class="w-1/2 px-2 mb-2">
                                        <x-button type="button" wire:click="filterBrands({{ $brand->id }})"
                                            warningOutline>
                                            {{ $brand->name }}
                                        </x-button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-8 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Category') }}</h3>
                    {{-- make tree categories and subcategories  --}}
                    <ul class="px-4 -mx-4">
                        @foreach ($categories as $category)
                            <li class="mx-2 mb-2">
                                <button type="button" wire:click="filterCategories({{ $category->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $category->name }}
                                    </span>
                                </button>
                                <ul>
                                    @foreach ($category->subcategories as $subcategory)
                                        <li class="mb-2">
                                            <button type="button"
                                                wire:click="filterSubCategories({{ $subcategory->id }})">
                                                <span
                                                    class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                                    {{ $subcategory->name }}
                                                </span>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-6 p-8 bg-gray-50">
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
                <div class="mb-6 p-8 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Brands') }}</h3>
                    <ul class="flex flex-wrap items-center -mx-4">
                        @foreach ($brands as $brand)
                            <li class="mx-2 mb-2">
                                <x-button type="button" class="mx-2"
                                    wire:click="filterBrands({{ $brand->id }})" dangerOutline>
                                    {{ $brand->name }}
                                </x-button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-3/4 px-3">
                @if ($view == 'list')
                    <div class="w-full lg:w-3/4 px-3">
                        @foreach ($products as $product)
                            <div class="relative mb-6 bg-gray-50">
                                @if ($product->old_price)
                                    <span
                                        class="top-0 left-0 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                        -{{ $product->discount }}%
                                    </span>
                                @endif
                                <div class="flex flex-wrap items-center -mx-4 px-8 md:px-20 py-12">
                                    <div class="w-full md:w-1/4 px-4 mb-4 md:mb-0">
                                        <a href="#">
                                            <img class="mx-auto md:mx-0 w-40 h-52 object-contain"
                                                src="{{ asset('images/products/' . $product->image) }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="w-full md:w-3/4 px-4">
                                        <a class="block mb-8" href="{{ route('front.product', $product->slug) }}">
                                            <h3 class="mb-2 text-xl font-bold font-heading">{{ $product->name }}</h3>
                                            <p class="mb-6 text-lg font-bold font-heading text-blue-500">
                                                <span>{{ $product->price }}DH</span>
                                                @if ($product->old_price)
                                                    <span
                                                        class="text-xs text-gray-500 font-semibold font-heading line-through">{{ $product->old_price }}</span>
                                                @endif
                                            </p>
                                            <p class="max-w-md text-gray-500">
                                                {{ Str::limit($product->description, 150) }}
                                            </p>
                                        </a>
                                        <div class="flex flex-wrap items-center justify-between">
                                            <a class="inline-block w-full md:w-auto mb-4 md:mb-0 md:mr-4 text-center bg-orange-300 hover:bg-orange-400 text-white font-bold font-heading py-4 px-8 rounded-md uppercase"
                                                href="#">{{ __('Add to cart') }}</a>
                                            <div class="ml-auto">
                                                <a class="flex-shrink-0 inline-flex mr-4 items-center justify-center w-14 h-14 rounded-md border hover:border-gray-500"
                                                    href="#">
                                                    <svg class="w-6 h-6" width="27" height="27"
                                                        viewbox="0 0 27 27" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.4993 26.2061L4.70067 16.9253C3.9281 16.1443 3.41815 15.1374 3.24307 14.0471C3.06798 12.9568 3.23664 11.8385 3.72514 10.8505V10.8505C4.09415 10.1046 4.63318 9.45803 5.29779 8.96406C5.96241 8.47008 6.73359 8.14284 7.54782 8.00931C8.36204 7.87578 9.19599 7.93978 9.98095 8.19603C10.7659 8.45228 11.4794 8.89345 12.0627 9.48319L13.4993 10.9358L14.9359 9.48319C15.5192 8.89345 16.2327 8.45228 17.0177 8.19603C17.8026 7.93978 18.6366 7.87578 19.4508 8.00931C20.265 8.14284 21.0362 8.47008 21.7008 8.96406C22.3654 9.45803 22.9045 10.1046 23.2735 10.8505V10.8505C23.762 11.8385 23.9306 12.9568 23.7556 14.0471C23.5805 15.1374 23.0705 16.1443 22.298 16.9253L13.4993 26.2061Z"
                                                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                                <a class="flex-shrink-0 inline-flex items-center justify-center w-14 h-14 rounded-md border hover:border-gray-500"
                                                    href="#">
                                                    <svg class="w-6 h-6" width="24" height="23"
                                                        viewbox="0 0 24 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2.01328 18.9877C2.05682 16.7902 2.71436 12.9275 6.3326 9.87096L6.33277 9.87116L6.33979 9.86454L6.3398 9.86452C6.34682 9.85809 8.64847 7.74859 13.4997 7.74859C13.6702 7.74859 13.8443 7.75111 14.0206 7.757L14.0213 7.75702L14.453 7.76978L14.6331 7.77511V7.59486V3.49068L21.5728 10.5736L14.6331 17.6562V13.6558V13.5186L14.4998 13.4859L14.1812 13.4077C14.1807 13.4075 14.1801 13.4074 14.1792 13.4072M2.01328 18.9877L14.1792 13.4072M2.01328 18.9877C7.16281 11.8391 14.012 13.3662 14.1792 13.4072M2.01328 18.9877L14.1792 13.4072M23.125 10.6961L23.245 10.5736L23.125 10.4512L13.7449 0.877527L13.4449 0.571334V1V6.5473C8.22585 6.54663 5.70981 8.81683 5.54923 8.96832C-0.317573 13.927 0.931279 20.8573 0.946581 20.938L0.946636 20.9383L1.15618 22.0329L1.24364 22.4898L1.47901 22.0885L2.041 21.1305L2.04103 21.1305C4.18034 17.4815 6.71668 15.7763 8.8873 15.0074C10.9246 14.2858 12.6517 14.385 13.4449 14.4935V20.1473V20.576L13.7449 20.2698L23.125 10.6961Z"
                                                            fill="black" stroke="black" stroke-width="0.35"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif ($view == 'grid')
                    <div class="flex flex-wrap -mx-3 mb-24">
                        @foreach ($products as $product)
                            <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 mb-6">
                                <div class="p-2 bg-gray-50">
                                    @if ($product->old_price)
                                        <span
                                            class="top-0 left-0 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                            -{{ $product->discount }}%
                                        </span>
                                    @endif
                                    <a class="block px-2 mt-2 mb-2"
                                        href="{{ route('front.product', $product->slug) }}">
                                        <img class="mb-5 mx-auto h-56 w-full object-contain" loading="lazy"
                                            src="{{ asset('images/products/' . $product->image) }}" alt="">
                                        <h3 class="mb-2 text-xl font-bold font-heading">
                                            {{ Str::limit($product->name, 30) }}
                                        </h3>
                                        <p class="text-lg font-bold font-heading text-blue-500">
                                            <span>
                                                {{ $product->price }}DH
                                            </span>
                                            <span
                                                class="text-xs text-gray-500 font-semibold font-heading line-through">
                                                {{ $product->old_price }}DH
                                            </span>
                                        </p>
                                    </a>

                                    <livewire:front.add-to-cart :product="$product" :key="$product->id" />

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <h2 class="mb-16 md:mb-24 text-4xl md:text-5xl font-bold font-heading">{{ __('Discover our products') }}</h2>
        <div class="flex flex-wrap -mx-3 mb-24">
            @foreach ($popular_products as $product)
                <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 mb-6">
                    <div class="p-2 bg-gray-50">
                        @if ($product->old_price)
                            <span
                                class="top-0 left-0 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                -{{ $product->discount }}%
                            </span>
                        @endif
                        <a class="block px-2 mt-2 mb-2" href="{{ route('front.product', $product->slug) }}">
                            <img class="mb-5 mx-auto h-56 w-full object-contain"
                                src="{{ asset('images/products/' . $product->image) }}" alt="">
                            <h3 class="mb-2 text-xl font-bold font-heading">
                                {{ Str::limit($product->name, 30) }}
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
            @endforeach
        </div>
    </div>
    <div class="text-center">
        {{ $products->links() }}
    </div>
</div>
