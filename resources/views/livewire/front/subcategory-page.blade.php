<div>
    <div class="w-full px-4 mx-auto">
        <div class="mb-5 items-center justify-between bg-white py-4">
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
                                {{ $subcategory->name }}
                            </a>

                            <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                        </li>
                        <li class="inline-flex items-center ml-2">
                            <p class="lg:text-2xl sm:text-xl font-bold text-gray-600 hover:text-blue-500">
                                {{ $subcategory->products->count() }} {{ __('Watches') }}
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="w-full sm:w-auto flex justify-center my-2 overflow-x-scroll">
                    <select wire:model="perPage" name="perPage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div>
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                @forelse ($this->subcategoryproducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="w-full">
                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                            {{ __('No Subcategory products found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
            <div class="text-center">
                {{ $this->subcategoryproducts->links() }}
            </div>
        </div>
    </div>
</div>
