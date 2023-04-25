<div>
    <div class="flex flex-wrap justify-center">

        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            <select wire:model="perPage"
                class="w-20 block p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-300 mr-3">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <input type="text" wire:model.debounce.300ms="search"
                class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                placeholder="{{ __('Search') }}" />
        </div>
    </div>

    <div>
        <x-table>
            <x-slot name="thead">
                <x-table.th>#</x-table.th>
                <x-table.th sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">
                    {{ __('Title') }}
                    @include('components.table.sort', ['field' => 'title'])
                </x-table.th>
                <x-table.th>
                    {{ __('Permissions') }}
                </x-table.th>
                <x-table.th>
                    {{ __('Actions') }}
                </x-table.th>
            </x-slot>
            <x-table.tbody>
                @forelse($roles as $id=>$role)
                    <x-table.tr>
                        <x-table.td>
                            {{$id}}
                        </x-table.td>
                        <x-table.td>
                            {{ $role->name }}
                        </x-table.td>
                        <x-table.td class="overflo-x-auto text-clip whitespace-pre" style="white-space: initial">
                            @foreach($role->permissions as $permission)
                                <x-badge info>
                                    {{ $permission->title }}
                                </x-badge>
                            @endforeach
                        </x-table.td>
                        <x-table.td>
                            <div class="inline-flex">
                                <x-button secondary href="">
                                    {{ __('Edit') }}
                                </a>
                                <x-button danger type="button" wire:click="emit('deleteModal', {{ $role->id }})" 
                                    wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </button>
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
    </div>

    <div class="card-body">
        <div class="pt-3">
            {{ $roles->links() }}
        </div>
    </div>
</div>


@push('page_scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', categoryId => {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', categoryId)
                    }
                })
            })
        })
    </script>
@endpush
