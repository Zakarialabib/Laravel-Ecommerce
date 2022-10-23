<div class="h-full">
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black dark:text-zinc-300 mb-1 text-sm ">
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
                    class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-500 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    <x-loader />

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            <x-table.th>
                {{ __('Customer Infos') }}
            </x-table.th>
            <x-table.th>
                {{ __('Order Number') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                {{ __('Status') }}
                @include('components.table.sort', ['field' => 'status'])
            </x-table.th>
            <x-table.th>
                {{ __('Total Qty') }}
            </x-table.th>
            <x-table.th>
                {{ __('Total Cost') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($orders as $id=>$order)
                <x-table.tr>
                    <x-table.td>
                        {{ $id }}
                    </x-table.td>
                    <x-table.td class="overflow-hidden text-clip whitespace-pre" style="white-space: initial">
                        @if ($order->user_id == null)
                        {{ $order->customer_name }} - 
                        {{ $order->customer_email }} -
                        {{ $order->customer_phone }}
                        @else
                        <a href="{{ route('admin-user-show', $order->user_id) }}" class="uppercase">
                            {{ $order->customer_name }} 
                        </a>
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <a class="text-bold active:text-blue-500" href="{{ route('admin-order-show', $order->id) }}">
                            {{ $order->order_number }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        @if ($order->status == 'pending')
                            <a href="javascript:;" data-href="{{ route('admin-order-edit', $order->id) }}"
                                class="track" data-toggle="modal" data-target="#modal1">
                                <span class="p-2 text-center leading-5 rounded border border-blue-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 bg-blue-500 text-white">
                                    {{ __('Pending') }}
                                </span>
                            </a>
                        @elseif($order->status == 'processing')
                            <a href="javascript:;" data-href="{{ route('admin-order-edit', $order->id) }}"
                                class="track" data-toggle="modal" data-target="#modal1">
                                <span class="bg-yellow-500 text-white p-2 text-center leading-5 rounded border border-yellow-300 mb-1 text-sm w-full focus:shadow-outline-yellow focus:border-yellow-500">
                                    {{ __('Processing') }}
                                </span>
                            </a>
                        @elseif($order->status == 'completed')
                            <a href="javascript:;" data-href="{{ route('admin-order-edit', $order->id) }}"
                                class="track" data-toggle="modal" data-target="#modal1">
                                <span class="bg-green-500 text-white p-2 text-center leading-5 rounded border border-green-300 mb-1 text-sm w-full focus:shadow-outline-green focus:border-green-500">
                                    {{ __('Completed') }}
                                </span>
                            </a>
                        @elseif($order->status == 'declined')
                            <a href="javascript:;" data-href="{{ route('admin-order-edit', $order->id) }}"
                                class="track" data-toggle="modal" data-target="#modal1">
                                <span class="bg-red-500 text-white py-2 text-center leading-5 rounded border border-red-300 mb-1 text-sm w-full focus:shadow-outline-red focus:border-red-500">
                                    {{ __('Declined') }}
                                </span>
                            </a>
                        @endif
                    </x-table.td>
                    <x-table.td>
                        {{ $order->totalQty }}
                    </x-table.td>
                    <x-table.td>
                        {{ \PriceHelper::showOrderCurrencyPrice(($order->pay_amount + $order->wallet_price) * $order->currency_value, $order->currency_sign) }}
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
                                <x-dropdown-link href="{{ route('admin-order-show', $order->id) }}"> <i
                                        class="fas fa-eye"></i>
                                    {{ __('View Details') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin-order-edit', $order->id) }}"> <i
                                        class="fas fa-edit"></i>
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="javascript:;" class="send"
                                    data-email="'{{ $order->customer_email }}" data-toggle="modal"
                                    data-target="#vendorform">
                                    <i class="fas fa-envelope"></i>
                                    {{ __('Send') }}
                                </x-dropdown-link>
                                <x-dropdown-link data-href="{{ route('admin-order-track', $order->id) }}"
                                    class="track" data-toggle="modal" data-target="#modal1">
                                    <i class="fas fa-truck"></i>
                                    {{ __('Track Order') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="javascript:;"
                                    data-href="{{ route('admin-order-edit', $order->id) }}" class="track"
                                    data-toggle="modal" data-target="#modal1">
                                    <i class="fas fa-dollar-sign"></i>
                                    {{ __('Delivery Status') }}
                                </x-dropdown-link>
                                {{-- <x-dropdown-link href="javascript:;"
                                    data-href="{{ route('admin-prod-delete', $order->id) }}" data-toggle="modal"
                                    data-target="#confirm-delete" class="delete"><i
                                        class="fas fa-trash-alt"></i>{{ __('Delete') }}
                                </x-dropdown-link> --}}
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
            {{ $orders->links() }}
        </div>
    </div>
</div>
