<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>

                @if ($this->selectedCount)
                    <p class="text-sm leading-5">
                        <span class="font-medium">
                            {{ $this->selectedCount }}
                        </span>
                        {{ __('Entries selected') }}
                    </p>
                @endif
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
            <x-table.th>#</x-table.th>
            <x-table.th>
                {{ __('Old url') }}
            </x-table.th>
            <x-table.th>
                {{ __('New url') }}
            </x-table.th>
            <x-table.th>
                {{ __('Created at') }}
            </x-table.th>
            <x-table.th>
                {{ __('Updated at') }}
            </x-table.th>
            <x-table.th>
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($redirects as $redirect)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $redirect->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $redirect->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $redirect->old_url }}
                    </x-table.td>
                    <x-table.td>
                        {{ $redirect->new_url }}
                    </x-table.td>
                    <x-table.td>
                        {{ $redirect->created_at->format('d/m/Y') }}
                    </x-table.td>
                    <x-table.td>
                        {{ $redirect->updated_at->format('d/m/Y') }}
                    </x-table.td>

                    <x-table.td>
                        <livewire:toggle-button :model="$redirect" field="status" key="{{ $redirect->id }}" />
                    </x-table.td>
                    <x-table.td>
                        <div class="inline-flex">
                            <x-button info type="button" wire:click="editModal({{ $redirect->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="$emit('deleteModal', {{ $redirect->id }})"
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
            {{ $redirects->links() }}
        </div>
    </div>

    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Redirect') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form enctype="multipart/form-data" wire:submit.prevent="update">
                <div class="flex flex-wrap">


                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="old_url" :value="__('Old url')" />
                        <input type="text" name="old_url" wire:model.lazy="redirect.old_url" disabled
                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ">
                        <x-input-error :messages="$errors->get('redirect.old_url')" for="redirect.old_url" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="new_url" :value="__('New url')" />
                        <input type="text" name="new_url" wire:model.lazy="redirect.new_url"
                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                            placeholder="{{ __('new_url') }}" value="{{ old('new_url') }}">
                        <x-input-error :messages="$errors->get('redirect.new_url')" for="redirect.new_url" class="mt-2" />
                    </div>

                    <div class="w-full px-2 mb-4">
                        <x-button type="submit" class="w-full text-center" primary>
                            {{ __('Save') }}
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
            window.livewire.on('deleteModal', redirectId => {
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
                        window.livewire.emit('delete', redirectId)
                    }
                })
            })
        })
    </script>
@endpush
