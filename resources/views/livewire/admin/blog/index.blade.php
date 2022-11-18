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

    <x-loader />

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th>
                {{ __('Title') }}
            </x-table.th>
            <x-table.th>
                {{ __('Views') }}
            </x-table.th>
            <x-table.th>
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($blogs as $id=>$blog)
                <x-table.tr>
                    <x-table.td>
                        {{ $id }}
                    </x-table.td>
                    <x-table.td>
                        @php
                            $photo = $blog->photo ? url('assets/images/blogs/' . $blog->photo) : url('assets/images/noimage.png');
                        @endphp
                        <img src="{{ $photo }}" alt="Image">
                    </x-table.td>
                    <x-table.td>
                        {{ $blog->title }}
                    </x-table.td>
                    <x-table.td>
                        {{ $blog->views }}
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$blog" field="status" key="{{ $blog->id }}" />
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
                                <x-button primary type="button"  wire:click="$emit('editModal', {{ $blog->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-edit"></i>
                                </x-button>
                                <x-button danger type="button"  wire:click="$emit('deleteModal', {{ $blog->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-trash"></i>
                                </x-button>
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
            {{ $blogs->links() }}
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
            <div class="flex flex-wrap px-4">
               
                <div class="xl:w-1/2 md:w-1/2 px-3">
                    <x-label for="title" :value="__('Name')" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                        wire:model.defer="blog.title" />
                    <x-input-error :messages="$errors->get('blog.title')" for="blog.title" class="mt-2" />
                </div>

                <div class="xl:w-1/2 md:w-1/2 px-3">
                    <x-label for="category_id" :value="__('Category')" required />
                        <x-select-list
                            class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model="blog.category_id"
                            :options="$this->listsForFields['categories']" />
                    <x-input-error :messages="$errors->get('blog.category_id')" for="blog.category_id"
                        class="mt-2" />
                </div>

                <div class="xl:w-1/2 md:w-1/2 px-3">
                    <x-label for="language_id" :value="__('Language')" required />
                    <x-select-list
                        class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        id="language_id" name="language_id" wire:model="blog.language_id"
                        :options="$this->listsForFields['languages']" />
                    <x-input-error :messages="$errors->get('blog.language_id')" for="blog.language_id"
                        class="mt-2" />
                </div>

                <div class="w-full px-3">
                    <x-button primary type="submit" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-slot>
</x-modal>
<!-- End Edit Modal -->


<livewire:admin.blog.create />
</div>

@push('page_scripts')
<script>
    document.addEventListener('livewire:load', function() {
        window.livewire.on('deleteModal', categoryId => {
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
                    window.livewire.emit('delete', categoryId)
                }
            })
        })
    })
</script>
@endpush

