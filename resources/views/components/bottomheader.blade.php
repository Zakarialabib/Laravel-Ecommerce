<div x-data="{ isMenuOpen: false }" class="relative">
    <div
        class="px-6 py-2 bg-gradient-to-r from-beige-400 via-beige-600 to-beige-800 text-white hidden md:flex items-center justify-center space-x-4">
        @foreach (\App\Helpers::getActiveCategories() as $category)
            <a href="{{ route('front.categories') }}?c={{ $category->id }}" class="lg:text-md md:text-sm text-center uppercase font-semibold font-heading hover:text-beige-400 hover:underline">
                {{ $category->name }}
            </a>
        @endforeach
        <button type="button"
            class="lg:text-md md:text-sm text-center uppercase font-semibold font-heading hover:text-beige-400 hover:underline"
            x-on:click="isMenuOpen = !isMenuOpen" mouseenter="isMenuOpen = true" @click.away="isMenuOpen = false">
            {{ __('Brands') }} <small class="inline-block align-middle text-gray-600 opacity-75">&#9660;</small>
        </button>

    </div>
    <div class="absolute z-10 top-full left-0 w-full max-w-screen-xl bg-white rounded-md shadow-lg""
        x-show.transition="isMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90" x-cloak>
        <div class="grid grid-cols-4 gap-4 space-y-4 py-4">
            @foreach (\App\Helpers::getActiveBrands() as $brand)
            <a href="{{ route('front.brandPage', $brand->slug) }}">
                <p class="mb-3 text-lg font-bold font-heading text-beige-600 hover:text-beige-900">
                        {{ $brand->name }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
