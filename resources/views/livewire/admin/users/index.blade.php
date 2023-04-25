<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
            <select wire:model="perPage"
                class="w-20 block p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-300 mr-3">
                @foreach ($paginationOptions as $value)
                    <option value="
                {{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            @if ($this->selected)
                <x-button danger type="button" wire:click="deleteSelected" class="ml-3">
                    <i class="fas fa-trash-alt"></i>
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
                class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1"
                placeholder="{{ __('Search') }}" />
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th class="pr-0 w-8">
                <input type="checkbox" wire:model="selectPage" />
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('first_name')" :direction="$sorts['first_name'] ?? null">
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Phone') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($users as $user)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $user->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $user->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $user->first_name }} -
                        <a class="link-light-blue" href="mailto:{{ $user->email }}">
                            {{ $user->email }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        {{ $user->phone }}
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$user" field="status" key="{{ $user->id }}" />
                    </x-table.td>

                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button secondary wire:click="showModal({{ $user->id }})" type="button"
                                wire:loading.attr="disabled">
                                <i class="fas fa-eye"></i>
                            </x-button>
                            <x-button primary type="button" wire:click="$emit('editModal', {{ $user->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="$emit('deleteModal', {{ $user->id }})"
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
            {{ $users->links() }}
        </div>
    </div>

    <x-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Show User') }}
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-wrap -mx-2 mb-3">
                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" disabled type="text"
                        wire:model.defer="user.first_name" />
                </div>

                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="phone" :value="__('Phone')" />
                    <x-input id="phone" class="block mt-1 w-full" disabled type="text"
                        wire:model.defer="user.phone" />
                </div>

                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" disabled type="email"
                        wire:model.defer="user.email" />
                </div>

                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="address" :value="__('Address')" />
                    <x-input id="address" class="block mt-1 w-full" disabled type="text"
                        wire:model.defer="user.address" />
                </div>

                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="city" :value="__('City')" />
                    <x-input id="city" class="block mt-1 w-full" type="text" disabled
                        wire:model.defer="user.city" />
                </div>

                <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                    <x-label for="tax_number" :value="__('Tax Number')" />
                    <x-input id="tax_number" class="block mt-1 w-full" type="text" wire:model.defer="user.tax_number"
                        disabled />
                </div>
            </div>
        </x-slot>
    </x-modal>

    

    @if($editModal)
    @livewire('admin.users.create', ['user' => $user])
    @endif

    <livewire:admin.users.create />

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', UserId => {
                Swal.fire({
                    title: __("Are you sure?"),
                    text: __("You won't be able to revert this!"),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: __("Yes, delete it!")
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', UserId)
                    }
                })
            })
        })
    </script>
@endpush
