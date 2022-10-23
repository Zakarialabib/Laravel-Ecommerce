<div>
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
            <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                {{ __('Name') }}
                @include('components.table.sort', ['field' => 'name'])
            </x-table.th>
            <x-table.th>
                {{ __('Price') }}
            </x-table.th>
            <x-table.th>
                {{ __('Stock') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                {{ __('Status') }}
                @include('components.table.sort', ['field' => 'status'])
            </x-table.th>
            <x-table.th>
                {{ __('Gallery') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($products as $id=>$product)
                <x-table.tr>
                    <x-table.td>
                        {{ $id }}
                    </x-table.td>
                    <x-table.td>
                        @php($id3 = $product->type == 'Physical')
                        {{ $name = mb_strlen($product->name, 'UTF-8') > 50 ? mb_substr($product->name, 0, 50, 'UTF-8') .'...' : $product->name }}
                        <small class="ml-2"> {{__("SKU")}} 
                            <a href="{{ route('front.product', $product->slug) }}" target="_blank">{{$product->sku}}</a>
                    </x-table.td>
                    <x-table.td>
                        @php($price = $product->price * $curr->value)
                        {{ \PriceHelper::showAdminCurrencyPrice($price) }}
                    </x-table.td>
                    <x-table.td>
                        @php($stck = (string) $product->stock)
                        @if ($stck == '0')
                            {{ __('Out Of Stock') }}
                        @elseif($stck == null)
                            {{ __('Unlimited') }}
                        @else
                            {{ $product->stock }}
                        @endif
                    </x-table.td>
                    <x-table.td>
                        {{-- @php($class = $product->status == 1 ? 'bg-green-600 text-white' : 'bg-red-600  text-white')
                        @php($s = $product->status == 1 ? 'selected' : '')
                        <select
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $class }}">
                            <option data-val="1"
                                value="{{ route('admin-prod-status', ['id1' => $product->id, 'id2' => 0]) }}"
                                {{ $s }}>
                                {{ __('Deactivated') }}</option>
                            <option data-val="0"
                                value="{{ route('admin-prod-status', ['id1' => $product->id, 'id2' => 1]) }}"
                                {{ $s }}>
                                {{ __('Activated') }}
                            </option>
                        </select> --}}
                        <livewire:toggle-button :model="$product" field="status" key="{{ $product->id }}" />
                    </x-table.td>
                    <x-table.td>
                        <a class="bg-blue-500 text-white px-2" href="javascript" class="set-gallery" data-toggle="modal"
                        data-target="#setgallery"><input type="hidden" value="{{ $product->id }}">
                        <i class="fas fa-camera"></i>
                    </a>
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
                                <x-dropdown-link href="{{ route('admin-prod-edit', $product->id) }}"> <i
                                        class="fas fa-edit"></i>
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                
                                <x-dropdown-link data-href="{{ route('admin-prod-feature', $product->id) }}"
                                    class="feature" data-toggle="modal" data-target="#modal2"> <i class="fas fa-star"></i>
                                    {{ __('Highlight') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="javascript:;"
                                    data-href="{{ route('admin-prod-delete', $product->id) }}" data-toggle="modal"
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
            {{ $products->links() }}
        </div>
    </div>
</div>
