@section('meta')
    <meta itemprop="url" content="{{ URL::current() }}">
    <meta property="og:title" content="{{ $brand->meta_title }}">
    <meta property="og:description" content="{!! $brand->meta_description !!}">
    <meta property="og:url" content="{{ URL::current() }}">
    <meta property="og:image" content="{{ asset('images/brands/' . $brand->image) }}">
@endsection

<div>
    <div class="w-full px-4 mx-auto">
        <div class="relative bg-white overflow-hidden mb-5">
            <img class="absolute right-0 top-0 md:w-1/2 sm:w-full h-full object-cover"
                src="{{ asset('images/brands/' . $brand->featured_image) }}" alt="{{ $brand->name }}"
                loading="lazy">
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
                @foreach ($this->categories as $category)
                    <x-button type="button" blackOutline class="mx-2"
                        wire:click="filterProductCategories({{ $category->id }})">{{ $category->name }}
                    </x-button>
                @endforeach

                @foreach ($this->subcategories as $subcategory)
                    <x-button type="button" blackOutline class="mx-2"
                        wire:click="filterProductSubcategories({{ $subcategory->id }})">
                        {{ $subcategory->name }}
                    </x-button>
                @endforeach

            </div>
        </div>

        <div wire:loading.class.delay="opacity-50">
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                @forelse ($this->brandproducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="w-full">
                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                            {{ __('No brand products found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
            <div class="text-center">
                {{ $this->brand_products->links() }}
            </div>
        </div>
    </div>
</div>
