<div>
    <div x-data="{ searchBox: false }" class="relative">
        <div class="flex items-center max-w-xs rounded-lg">
            <button type="button" @click="searchBox = !searchBox"
                class="flex items-center justify-center w-10 h-10 text-gray-100 rounded-l-lg focus:outline-none">
                <svg class="mr-5 text-gray-900" width="35" height="35" viewbox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">

                    <path d="M17.5 17.1309L12.5042 11.9551" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path
                        d="M7.27524 13.8672C10.8789 13.8672 13.8002 10.945 13.8002 7.34033C13.8002 3.73565 10.8789 0.813477 7.27524 0.813477C3.67159 0.813477 0.750244 3.73565 0.750244 7.34033C0.750244 10.945 3.67159 13.8672 7.27524 13.8672Z"
                        stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <input x-show="searchBox" type="text" wire:model="search" placeholder="{{ __('Search for products') }}" style="display:none;"
                autocomplete="" class="w-full border-0 focus:ring-transparent bg-gray-100 text-gray-900 focus:outline-none py-2 mr-4 rounded-md">
        </div>
        @if (!empty($search))
            <div class="absolute top-0 left-0 w-full mt-12 bg-white rounded-md shadow-xl overflow-y-auto max-h-52 z-50">
                <ul>
                    @forelse ($results as $product)
                        <li class="flex items-center px-4 py-3 border-b border-gray-100">
                            @if ($product instanceof App\Models\Product)
                                <a href="{{ route('front.product', $product->slug) }}" class="flex">
                                    <img  src="{{ asset('images/products/' . $product->image) }}" alt=""
                                    loading="lazy" class="w-10 h-10 object-cover">
                                    <div class="mx-4">
                                        <p class="font-semibold text-gray-700">{{ $product->name }}</p>
                                    </div>
                                </a>
                            @endif
                        </li>
                    @empty
                        <li class="px-4 py-3 text-gray-600">{{ __('No results found for') }} "{{ $search }}"</li>
                    @endforelse
                </ul>
            </div>
        @endif
    </div>
</div>