<div>
    <div x-data="{ searchBox: {{ $searchBox ? 'true' : 'false' }} }" class="relative w-full rounded-lg" @click.away="searchBox = false">
        <div class="flex items-center lg:w-[20rem] md:w-[12rem]">
            <button type="button" @click="searchBox = !searchBox"
                class="h-full absolute z-20 top-0 px-2 flex items-center bg-beige-400 hover:bg-beige-200 transition focus:outline-none">
                <i class="fa fa-search text-gray-100"></i>
            </button>
            <input type="text" wire:model="search" placeholder="{{ __('Search for products') }}" autocomplete=""
                class="w-full border-0 focus:ring-transparent bg-gray-100 text-gray-900 text-xs focus:outline-none py-2 pl-10 pr-5 rounded-md">
            <button type="button" wire:click="clearSearch"
                class="h-full absolute z-20 top-0 text-md font-bold right-0 flex items-center text-gray-800 focus:outline-none">
                <i class="fa fa-times mr-4 text-gray-900"></i>
            </button>
        </div>
        @if (!empty($search))
            <div x-transition:enter="transition-all duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-all"
                x-transition:leave-start="opacity-25" x-transition:leave-end="opacity-0 hidden"
                class="absolute top-0 left-0 w-full mt-12 bg-white rounded-md shadow-xl overflow-y-auto max-h-52 z-50"
                wire:click="hideSearchResults">
                <ul>
                    @forelse ($results as $product)
                        <li class="flex items-center px-4 py-3 border-b border-gray-100">
                            <a href="{{ route('front.product', $product->slug) }}" class="flex">
                                <img src="{{ asset('images/products/' . $product->image) }}" alt=""
                                    loading="lazy" class="w-10 h-10 object-cover">
                                <div class="mx-4">
                                    <p class="font-semibold text-gray-700">{{ $product->name }}</p>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-4 py-3 text-gray-600">{{ __('No results found for') }}
                            "{{ $search }}"
                        </li>
                    @endforelse
                </ul>
            </div>
        @endif
    </div>
</div>
