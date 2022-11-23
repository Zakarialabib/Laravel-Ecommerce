<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black dark:text-gray-300 mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-gray-500 dark:text-gray-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    {{-- <x-loader /> --}}

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
                @include('components.table.sort', ['field' => 'name'])
            </x-table.th>
            <x-table.th>
                {{ __('Category') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('price')" :direction="$sorts['price'] ?? null">
                {{ __('Price') }}
                @include('components.table.sort', ['field' => 'price'])
            </x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                {{ __('Status') }}
                @include('components.table.sort', ['field' => 'status'])
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
                        {{ Str::limit($product->name, 60) }}
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
                                <x-dropdown-link wire:click="showModal({{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="editModal({{ $product->id }})" class="mr-2"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-edit"></i>
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="$emit('deleteModal', {{ $product->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-trash"></i>
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
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $products->links() }}
        </div>
    </div>

    @if ($product)
        <!-- Show Modal -->
        <x-modal wire:model="showModal">
            <x-slot name="title">
                {{ __('Show Product') }}
            </x-slot>

            <x-slot name="content">
                <div class="px-4 mx-auto mb-4">
                    <div class="row mb-3">
                        <div class="xl:w-1/3 lg:w-1/2 sm:w-full px-3">
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-32 h-32 rounded-full">
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-full px-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <tr>
                                        <th>{{ __('Product Code') }}</th>
                                        <td>{{ $product->code }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Category') }}</th>
                                        <td>{{ $product->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Old Price') }}</th>
                                        <td>{{ $product->old_price }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Price') }}</th>
                                        <td>{{ $product->price }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <td>{!! $product->description !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-modal>
        <!-- End Show Modal -->
    @endif

    <!-- Edit Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Product') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="update">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="name" :value="__('Product Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model="product.name" required autofocus />
                            <x-input-error :messages="$errors->get('product.name')" for="product.name" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="code" :value="__('Product Code')" required />
                            <x-input id="code" class="block mt-1 w-full" type="text" name="code"
                                wire:model="product.code" disabled required />
                            <x-input-error :messages="$errors->get('product.code')" for="product.code" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="category_id" :value="__('Category')" required />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model="product.category_id"
                                :options="$this->listsForFields['categories']" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="subcategory" :value="__('Subcategory')" />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="subcategory_id" name="subcategory_id" wire:model.defer="product.subcategory_id"
                                :options="$this->listsForFields['subcategories']" />
                            <x-input-error :messages="$errors->get('subcategory_id')" for="subcategory_id" class="mt-2" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model="product.price" required />
                            <x-input-error :messages="$errors->get('product.price')" for="product.price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="old_price" :value="__('Old Price')" />
                            <x-input id="old_price" class="block mt-1 w-full" type="number" name="old_price"
                                wire:model="product.old_price" />
                            <x-input-error :messages="$errors->get('product.old_price')" for="product.old_price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="brand_id" :value="__('Brand')" />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="brand_id" name="brand_id" wire:model="product.brand_id" :options="$this->listsForFields['brands']" />
                        </div>

                        <div class="w-full mb-4">
                            <x-label for="description" :value="__('Description')" />
                            <x-input.rich-text wire:model.lazy="product.description" id="description" />
                        </div>

                    </div>

                    <x-accordion title="{{ 'More Details' }}">
                        <div class="flex flex-wrap -mx-2 mb-3">

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_title" :value="__('Meta Title')" />
                                <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                                    wire:model="product.meta_title" />
                                <x-input-error :messages="$errors->get('product.meta_title')" for="product.meta_title" class="mt-2" />

                            </div>

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_description" :value="__('Meta Description')" />
                                <x-input id="meta_description" class="block mt-1 w-full" type="text"
                                    name="meta_description" wire:model="product.meta_description" />
                                <x-input-error :messages="$errors->get('product.meta_description')" for="product.meta_description" class="mt-2" />

                            </div>

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_keywords" :value="__('Meta Keywords')" />
                                <x-input id="meta_keywords" class="block mt-1 w-full" type="text"
                                    name="meta_keywords" wire:model="product.meta_keywords" />
                                <x-input-error :messages="$errors->get('product.meta_keywords')" for="product.meta_keywords" class="mt-2" />
                            </div>
                        </div>
                    </x-accordion>

                    <div class="w-full px-4 my-4">
                        <x-label for="image" :value="__('Product Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>

                    <div class="w-full px-4 my-4">
                        <x-label for="gallery" :value="__('Product Gallery')" />
                        <x-fileupload wire:model="gallery" :file="$gallery" accept="image/jpg,image/jpeg,image/png"
                            multiple />
                        <x-input-error :messages="$errors->get('gallery')" for="gallery" class="mt-2" />
                    </div>

                    <div class="flex justify-start space-x-2">
                        <x-button primary type="submit" wire:click="update" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
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
                        <input  id="hot" class="block mt-1 w-full" type="checkbox" name="hot"
                            wire:model="hot" />
                        <x-input-error :messages="$errors->get('hot')" for="hot" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="best" :value="__('Best product')" />
                        <input  id="best" class="block mt-1 w-full" type="checkbox" name="best"
                            wire:model="best" />
                        <x-input-error :messages="$errors->get('best')" for="best" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="top" :value="__('Top product')" />
                        <input  id="top" class="block mt-1 w-full" type="checkbox" name="top"
                            wire:model="top" />
                        <x-input-error :messages="$errors->get('top')" for="top" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="latest" :value="__('Latest product')" />
                        <input  id="latest" class="block mt-1 w-full" type="checkbox" name="latest"
                            wire:model="latest" />
                        <x-input-error :messages="$errors->get('latest')" for="latest" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="big" :value="__('Big saving')" />
                        <input  id="big" class="block mt-1 w-full" type="checkbox" name="big"
                            wire:model="big" />
                        <x-input-error :messages="$errors->get('big')" for="big" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="trending" :value="__('Trending')" />
                        <input  id="trending" class="block mt-1 w-full" type="checkbox" name="trending"
                            wire:model="trending" />
                        <x-input-error :messages="$errors->get('trending')" for="trending" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="sale" :value="__('Sale')" />
                        <input  id="sale" class="block mt-1 w-full" type="checkbox" name="sale"
                            wire:model="sale" />
                        <x-input-error :messages="$errors->get('sale')" for="sale" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 mb-4 px-2">
                        <x-label for="is_discount" :value="__('Is Discount')" />
                        <input  id="is_discount" class="block mt-1 w-full" type="checkbox" name="is_discount"
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
                    <x-button primary type="button" 
                            wire:click="saveHighlight" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    {{-- recieve parametre from emit importModal $product --}}
    @if ($product)
        @livewire('admin.product.image', ['product' => $product], key($product->id))
    @endif

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
