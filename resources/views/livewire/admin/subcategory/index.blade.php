<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>


    <x-table>
        <x-slot name="thead">
            <x-table.th>
                <input type="checkbox" wire:model="selectPage" />
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                {{ __('Name') }}
                @include('components.table.sort', ['field' => 'name'])
            </x-table.th>
            <x-table.th>
                {{ __('Category') }}
            </x-table.th>

            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($subcategories as $subcategory)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $subcategory->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $subcategory->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $subcategory->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $subcategory->category?->name }}
                    </x-table.td>
                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button primary type="button" wire:click="$emit('editModal', {{ $subcategory->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="$emit('deleteModal', {{ $subcategory->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-trash-alt"></i>
                            </x-button>
                        </div>
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
            {{ $subcategories->links() }}
        </div>
    </div>
    
    <!-- Edit Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="space-y-4 px-4">

                    <div class="px-2 w-1/2 sm:w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="subcategory.name" />
                        <x-input-error :messages="$errors->get('subcategory.name')" for="subcategory.name" class="mt-2" />
                    </div>
                    <div class="px-2 w-1/2 sm:w-full">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                            wire:model.defer="subcategory.slug" />
                        <x-input-error :messages="$errors->get('subcategory.slug')" for="subcategory.slug" class="mt-2" />
                    </div>

                    <div class="mt-4 px-2 w-1/2 sm:w-full">
                        <x-label for="category_id" :value="__('Category')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model="subcategory.category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            <x-input-error :messages="$errors->get('subcategory.category_id')" for="subcategory.category_id" class="mt-2" />
                        </select>
                    </div>

                    <div class="mt-4 px-2 w-1/2 sm:w-full">
                        <x-label for="language_id" :value="__('Language')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="subcategory.language_id">
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('subcategory.language_id')" for="subcategory.language_id" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Edit Modal -->

    <livewire:admin.subcategory.create />
</div>

@push('page_scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', subcategoryId => {
                Swal.fire({
                    title: __("Are you sure?") ,
                    text: __("You won't be able to revert this!") ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: __("Yes, delete it!") 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', subcategoryId)
                    }
                })
            })
        })
    </script>
@endpush
