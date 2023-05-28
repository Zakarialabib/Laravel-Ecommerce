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
            <x-table.th class="pr-0 w-8">
                <input wire:model="selectPage" type="checkbox" />
            </x-table.th>
            <x-table.th>
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Slug') }}
            </x-table.th>
            <x-table.th>
                {{ __('Image') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
            </tr>
        </x-slot>
        <x-table.tbody>
            @forelse($brands as $brand)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $brand->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $brand->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        <button wire:click="$emit('showModal',{{ $brand->id }})" 
                            class="text-blue-500 underline">
                        {{ $brand->name }}
                        </button>
                    </x-table.td>
                    <x-table.td>
                        {{ $brand->slug }}
                    </x-table.td>
                    <x-table.td>
                        @if ($brand->image)
                            <img src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}"
                                class="w-10 h-10 rounded-full">
                        @else
                            {{ __('No image') }}
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button primary type="button" wire:click="$emit('editModal', {{ $brand->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="deleteModal({{ $brand->id }})"
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

    <div class="p-4">
        <div class="pt-3">
            {{ $brands->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    @livewire('admin.brands.create')

    <!-- Edit Modal -->
    @livewire('admin.brands.edit', ['brand' => $brand])
    
    @livewire('admin.brands.show', ['brand' => $brand])
    
</div>
