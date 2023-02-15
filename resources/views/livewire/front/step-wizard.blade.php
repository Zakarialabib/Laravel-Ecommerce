<div>
    <div x-data="{ step: {{ $step }} }">
        <div class="container px-4 mx-auto my-10">
            <div class="mb-8">
                <div class="bg-gray-300 h-2 rounded overflow-hidden">
                    <div class="bg-indigo-600 text-xs leading-none py-1 text-center text-white"
                        x-bind:style="{ width: (100 * {{ $step }} / 6) + '%' }"></div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="text-2xl font-medium">{{ __('Step Wizard') }}</h2>
                <p class="text-gray-700">{{ __('Choose the perfect watch for you') }}</p>
            </div>

            <div class="mb-8">
                <p class="mx-4 space-x-2">
                    @if (isset($giftOrSelf))
                        @if ($giftOrSelf == 'gift')
                            {{ __('Gift') }}
                        @elseif($giftOrSelf == 'self')
                            {{ __('Self') }}
                        @endif
                        <button type="button" wire:click="clearFilter('giftOrSelf')" class="text-red-500">X</button>
                    @endif
                    @if (isset($category_id))
                        {{ \App\Helpers::categoryName($category_id) }}
                        <button type="button" wire:click="clearFilter('category_id')" class="text-red-500">X</button>
                    @endif
                    @if (isset($brand_id))
                        {{ \App\Helpers::brandName($brand_id) }}
                        <button type="button" wire:click="clearFilter('brand_id')" class="text-red-500">X</button>
                    @endif
                    @if (isset($subcategory_id))
                        {{ \App\Helpers::subcategoryName($subcategory_id) }}
                        <button type="button" wire:click="clearFilter('subcategory_id')"
                            class="text-red-500">X</button>
                    @endif
                </p>
            </div>

            <!-- Step 1: Gift or self -->
            @if ($step === 0)
                <div x-show="step === 0">
                    <h2 class="mb-4">{{ __('Choose what suits you') }}</h2>
                    <div class="flex justify-between">
                        {{ __('Veuillez choisir une seule option') }}
                    </div>
                </div>
            @endif

            <!-- Step 1: Gift or self -->
            @if ($step === 1)
                <div x-show="step === 1" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 1: Gift or self') }}</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer"
                            wire:click="updateGiftOrSelf('gift')">
                            Gift
                        </button>
                        <button type="button" wire:click="updateGiftOrSelf('self')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                            Self
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 2: Category -->
            @if ($step === 2)
                <div x-show="step === 2" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 2: Category') }}</h2>
                    <div class="flex justify-between">
                        @foreach ($this->categories as $category)
                            <button type="button" wire:click="updateCategoryId('{{ $category->id }}')"
                                class="brand-card border-2 border-blue-500 hover:border-blue-600 py-2 px-4 m-2 rounded-lg">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Step 3: Brand -->
            @if ($step === 3)
                <div x-show="step === 3" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 3: Brand') }}</h2>
                    <div class="flex justify-between">
                        <!-- Show a list of brands here -->
                        @foreach ($this->brands as $brand)
                            <button type="button" wire:click="updateBrandId('{{ $brand->id }}')"
                                class="brand-card border-2 border-blue-500 hover:border-blue-600 py-2 px-4 m-2 rounded-lg">
                                {{ $brand->name }}
                                {{ $brand->image }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Step 4: Price -->
            @if ($step === 4)
                <div x-show="step === 4" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 4: Price') }}</h2>
                    <div class="flex mt-4">
                        <div class="w-full relative">
                            <div class="flex">
                                <div class="w-1/2">
                                    <input type="range" wire:model="minPrice" value="{{ $minPrice }}" id="minPrice" min="0" max="1000"
                                        class="w-full appearance-none cursor-pointer fill-range">
                                    <p class="text-sm font-medium mt-1">{{ $minPrice }}</p>
                                </div>
                                <div class="w-1/2">
                                    <input type="range" wire:model="maxPrice" value="{{ $maxPrice }}" id="maxPrice" min="0" max="20000"
                                        class="w-full appearance-none cursor-pointer fill-range">
                                    <p class="text-sm font-medium mt-1 text-right">{{ $maxPrice }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Step 5: Style -->
            @if ($step === 5)
                <div x-show="step === 5" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 5: Style') }}</h2>
                    <div class="flex justify-between">
                        @foreach ($this->subcategories as $subcategory)
                            <button type="button" wire:click="updatedSubcategoryId('{{ $subcategory->id }}')"
                                class="brand-card border-2 border-blue-500 hover:border-blue-600 py-2 px-4 m-2 rounded-lg">
                                {{ $subcategory->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Step 6: Recommandation -->
            @if ($step === 6)
                <div x-show="step === 6" x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <h2 class="mb-4">{{ __('Step 6: Recommandation') }}</h2>
                    <div class="flex justify-between">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex justify-between mt-8">
                <button x-show="step > 0" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="prevStep">
                    {{ __('Previous') }}
                </button>
                <button x-show="step < 6" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="nextStep">
                    {{ __('Next') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
          .fill-range {
    background: linear-gradient(to right, #36f2e5 0%, #36f2e5 {{ $minPrice }}%, #fff {{ $minPrice }}%, #fff {{ $maxPrice }}%, #36f2e5 {{ $maxPrice }}%, #36f2e5 100%);
  }
    </style>
@endpush
