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
            <x-table.th>#</x-table.th>
            <x-table.th>
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Details') }}
            </x-table.th>
            <x-table.th>
                {{ __('Checkout Visibility') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($paymentgateways as $id=>$paymentgateway)
                <x-table.tr>
                    <x-table.td>
                        {{ $id }}
                    </x-table.td>
                    <x-table.td>
                        @if($paymentgateway->type == 'automatic')
                            {{ $paymentgateway->name }}
                        @else
                            {{ $paymentgateway->title }}
                        @endif
                    </x-table.td>
                    <x-table.td>
                        @if($paymentgateway->type == 'automatic')
                            {{ $paymentgateway->getAutoDataText() }}
                        @else
                            @if($paymentgateway->keyword == 'cod')
                            {{ $paymentgateway->subtitle }}
                            @else
                                @php($details = mb_strlen(strip_tags($paymentgateway->details),'utf-8') > 250 ? mb_substr(strip_tags($paymentgateway->details),0,250,'utf-8').'...' : strip_tags($paymentgateway->details))
                                {{ $details }}
                            @endif
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$paymentgateway" field="checkout" key="{{ $paymentgateway->id }}" />
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
                                <x-dropdown-link data-href="{{ route('admin-payment-edit', $paymentgateway->id) }}" class="edit"
                                    data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="javascript:;"
                                    data-href="{{ route('admin-payment-delete', $paymentgateway->id) }}" data-toggle="modal"
                                    data-target="#confirm-delete" class="delete"><i
                                        class="fas fa-trash-alt"></i>{{ __('Delete') }}
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
            {{ $paymentgateways->links() }}
        </div>
    </div>
</div>
