<div>
    <div class="container mx-auto">
        <div class="w-full px-4 mb-6">
            <div class="relative bg-white overflow-hidden">
                <div class="relative max-w-xl pl-6 lg:pl-20 py-10 bg-white bg-opactity-75">
                    <span
                        class="px-3 py-1 border border-blue-500 rounded-full text-xs text-blue-500 font-bold font-heading uppercase">
                        {{ $subcategory->name }}
                    </span>
                    <div class="w-full lg:w-auto lg:mb-4 px-4 flex flex-wrap items-center">
                        <select wire:model="perPage" name="perPage"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                            @foreach ($paginationOptions as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="overflow-x-scroll flex py-2 sm:w-full lg:pl-5 sm:pl-0">
                    @foreach ($this->subcategories as $subcategory)
                        <x-button type="button" blackOutline class="mx-2"
                            wire:click="filterProductSubcategories({{ $subcategory->id }})">
                            {{ $subcategory->name }}
                        </x-button>
                    @endforeach
                </div>
            </div>
        </div>
        <div wire:loading.class.delay="opacity-50">
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                @forelse ($subcategory_products as $product)
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
                {{ $subcategory_products->links() }}
            </div>
        </div>
    </div>
</div>
