<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <select wire:model="perPage" name="perPage"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            @if ($this->selected)
                <x-button danger type="button" wire:click="deleteSelected" class="ml-3">
                    <i class="fas fa-trash"></i>
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
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-500 dark:text-gray-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                placeholder="{{ __('Search') }}" />
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th>
                <input type="checkbox" wire:model="selectPage" />
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
                {{ __('Price') }}
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
                        {{ $product->category->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $product->price }}DH
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-slot name="trigger">
                                <button type="button"
                                    class="px-4 text-base font-semibold text-gray-500 hover:text-sky-800 dark:text-slate-400 dark:hover:text-sky-400">
                                    <i class="fas fa-angle-double-down"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="highlightModal({{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-eye"></i>
                                    {{ __('Highlighted') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="clone({{ $product->id }})"
                                    wire:loading.attr="disabled">
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

    <livewire:admin.product.create />

    {{-- HIGHLIGHT MODAL --}}

    <x-modal wire:model="highlightModal">

        <x-slot name="title">
            {{ __('Highlight') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="saveHighlight">
                <div class="flex flex-wrap">
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="featured" :value="__('Featured product')" />
                        <input id="featured" class="block mt-1 w-full" type="checkbox" name="featured"
                            wire:model="featured" />
                        <x-input-error :messages="$errors->get('featured')" for="featured" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="hot" :value="__('Hot product')" />
                        <input id="hot" class="block mt-1 w-full" type="checkbox" name="hot"
                            wire:model="hot" />
                        <x-input-error :messages="$errors->get('hot')" for="hot" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="best" :value="__('Best product')" />
                        <input id="best" class="block mt-1 w-full" type="checkbox" name="best"
                            wire:model="best" />
                        <x-input-error :messages="$errors->get('best')" for="best" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="top" :value="__('Top product')" />
                        <input id="top" class="block mt-1 w-full" type="checkbox" name="top"
                            wire:model="top" />
                        <x-input-error :messages="$errors->get('top')" for="top" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="latest" :value="__('Latest product')" />
                        <input id="latest" class="block mt-1 w-full" type="checkbox" name="latest"
                            wire:model="latest" />
                        <x-input-error :messages="$errors->get('latest')" for="latest" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="big" :value="__('Big saving')" />
                        <input id="big" class="block mt-1 w-full" type="checkbox" name="big"
                            wire:model="big" />
                        <x-input-error :messages="$errors->get('big')" for="big" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="trending" :value="__('Trending')" />
                        <input id="trending" class="block mt-1 w-full" type="checkbox" name="trending"
                            wire:model="trending" />
                        <x-input-error :messages="$errors->get('trending')" for="trending" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="sale" :value="__('Sale')" />
                        <input id="sale" class="block mt-1 w-full" type="checkbox" name="sale"
                            wire:model="sale" />
                        <x-input-error :messages="$errors->get('sale')" for="sale" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="is_discount" :value="__('Is Discount')" />
                        <input id="is_discount" class="block mt-1 w-full" type="checkbox" name="is_discount"
                            wire:model="is_discount" />
                        <x-input-error :messages="$errors->get('is_discount')" for="is_discount" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="discount_date" :value="__('Discount Date')" />
                        <x-input id="discount_date" class="block mt-1 w-full" type="date" name="discount_date"
                            wire:model="discount_date" />
                        <x-input-error :messages="$errors->get('discount_date')" for="discount_date" class="mt-2" />
                    </div>
                </div>


                <div class="w-full flex justify-start px-3">
                    <x-button primary type="button" wire:click="saveHighlight" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    {{-- recieve parametre from emit importModal $product --}}
    @livewire('admin.product.image', ['product' => $product])

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
