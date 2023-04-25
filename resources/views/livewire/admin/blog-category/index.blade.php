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
            @if ($this->selected)
                <x-button danger type="button" wire:click="deleteSelected" class="mx-3">
                    <i class="fas fa-trash-alt"></i>
                </x-button>
            @endif
            @if ($this->selectedCount)
                <p class="text-sm items-center leading-5">
                    <span class="font-medium ml-2">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="flex items-center mr-3 pl-4">
                <input wire:model="search" type="text"
                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
                    placeholder="{{ __('Search...') }}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                {{ __('Name') }}
                @include('components.table.sort', ['field' => 'name'])
            </x-table.th>
            <x-table.th>
                {{ __('Featured') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($blogcategories as $blogcategory)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $blogcategory->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $blogcategory->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $blogcategory->title }}
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$blogcategory" field="featured" key="{{ $blogcategory->id }}" />
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
                                <x-button primary type="button"
                                    wire:click="$emit('editModal', {{ $blogcategory->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-edit"></i>
                                </x-button>
                                <x-button danger type="button" wire:click="deleteModal({{ $blogcategory->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-trash-alt"></i>
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

    <div class="p-4">
        <div class="pt-3">
            {{ $blogcategories->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    @livewire('admin.blog-category.create')

    <!-- Edit Modal -->
    @livewire('admin.blog-category.edit', ['blogcategory' => $blogcategory])

</div>
