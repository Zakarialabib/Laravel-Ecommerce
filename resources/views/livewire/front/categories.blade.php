@section('meta')
@endsection
<div>
    <div class="mx-auto px-4">
        <div class="mb-10 items-center justify-between bg-white py-4">
            <div class="w-full lg:mb-4 px-4 flex flex-wrap justify-between">
                <h2 class="lg:text-2xl sm:text-xl font-bold">
                    {{ $products->count() }} {{ __('Watches') }}
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
                    <select wire:model="perPage" name="perPage"
                        class="px-5 py-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="overflow-x-scroll flex py-2 sm:w-full lg:pl-5 sm:pl-0">
                @foreach ($this->categories as $category)
                    <x-button type="button" blackOutline class="mx-2"
                        wire:click="filterProductCategories({{ $category->id }})">
                        {{ $category->name }} <small> ({{ $category->products->count() }})</small>
                    </x-button>
                @endforeach

                @foreach ($this->subcategories as $subcategory)
                    <x-button type="button" blackOutline class="mx-2"
                        wire:click="filterProductSubcategories({{ $subcategory->id }})">
                        {{ $subcategory->name }} <small> ({{ $subcategory->products->count() }})</small>
                    </x-button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10 px-4">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="w-full">
                <h3 class="text-3xl font-bold font-heading text-blue-900">
                    {{ __('No products found') }}
                </h3>
            </div>
        @endforelse
    </div>
    <div class="text-center">
        {{ $products->links() }}
    </div>
</div>
