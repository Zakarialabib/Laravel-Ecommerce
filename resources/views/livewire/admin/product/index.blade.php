<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
            <select wire:model="perPage" name="perPage"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <x-button secondary type="button" wire:click="selectAll" class="ml-3">
                {{ 'Select All' }}
            </x-button>
            @if ($this->selected)
                <x-button danger type="button" wire:click="deleteSelected" class="ml-3">
                    <i class="fas fa-trash"></i>
                </x-button>

                <x-button primary type="button" wire:click="promoAllProducts" class="ml-3">
                    <i class="fas fa-percent"></i>
                </x-button>
            @endif

            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <input type="text" wire:model.debounce.300ms="search"
                class="p-3 leading-5 bg-white text-gray-500 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                placeholder="{{ __('Search') }}" />
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th>
                <input type="checkbox" wire:click="selectPage" />
            </x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Category') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('price')" :direction="$sorts['price'] ?? null">
                {{ __('Price') }} / {{ __('Old Price') }}
            </x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                {{ __('Status') }}
            </x-table.th>

            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($products as $product)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $product->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $product->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-10 h-10 rounded-full object-cover">
                    </x-table.td>
                    <x-table.td>
                        <button type="button" wire:click="$emit('showModal',{{ $product->id }})">
                            {{ Str::limit($product->name, 60) }}
                        </button>
                        <a class="ml-2 text-blue-500" href="{{ route('front.product', $product->slug) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </x-table.td>
                    <x-table.td>
                        {{ $product?->category->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $product->price }}DH /
                        @if ($product->old_price)
                            {{ $product->old_price }}DH
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <x-button type="button" success wire:click="$emit('imageModal', {{ $product->id }})"
                            wire:key="image-{{ $product->id }}">
                            <i class="fas fa-image"></i>
                        </x-button>
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$product" field="status" key="{{ $product->id }}" />
                    </x-table.td>

                    <x-table.td>
                        <x-dropdown
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                            <x-slot name="trigger">
                                <button type="button"
                                    class="px-4 text-base font-semibold text-gray-500 hover:text-sky-800">
                                    <i class="fas fa-angle-double-down"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="$emit('highlightModal',{{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-eye"></i>
                                    {{ __('Highlighted') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="clone({{ $product->id }})" wire:loading.attr="disabled">
                                    <i class="fas fa-clone"></i>
                                    {{ __('Clone') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="$emit('showModal',{{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="$emit('editModal', {{ $product->id }})" class="mr-2"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-edit"></i>
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="$emit('deleteModal', {{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <div class="card-body">
        <div class="pt-3">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Show Modal -->
    @livewire('admin.product.show', ['product' => $product])
    <!-- End Show Modal -->

    <!-- Edit Modal -->
    @livewire('admin.product.edit', ['product' => $product])
    <!-- End Edit Modal -->

    <!-- Highlighted Modal -->
    @livewire('admin.product.highlighted', ['product' => $product])
    <!-- End Highlighted Modal -->

    <!-- Image Modal -->
    @livewire('admin.product.image', ['product' => $product])
    <!-- End Image Modal -->

    <livewire:admin.product.create />

    <x-modal wire:model="promoAllProducts">

        <x-slot name="title">
            {{ __('Promo Selected Products') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="updateSelected">
                <div class="w-full mx-auto">
                    <div class="flex flex-wrap px-4">

                        <div class="w-1/3 px-3 py-2">
                            <x-label for="percentage" :value="__('Percentage')" />
                            <x-input id="percentage" class="block mt-1 w-full" type="text" name="percentage"
                                wire:model="percentage" />
                            <select name="percentageMethod" wire:model="percentageMethod"
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                <option value="-">{{ __('Reduce') }} ( - )</option>
                                <option value="+">{{ __('Increase') }} ( + )</option>
                            </select>
                            <x-input-error :messages="$errors->get('percentage')" for="condition" class="mt-2" />
                        </div>

                        <div class="w-1/3 px-3 py-2">
                            <x-label for="percentage" :value="__('Copy price to old price')" />
                            <input type="checkbox" wire:model="copyPriceToOldPrice" id="copy">
                        </div>
                        <div class="w-1/3 px-3 py-2">
                            <x-label for="percentage" :value="__('Copy old price to price')" />
                            <input type="checkbox" wire:model="copyOldPriceToPrice" id="copy">
                        </div>
                    </div>

                    <div class="w-full flex justify-center px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', productId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', productId)
                    }
                })
            })
        })
    </script>
@endpush
