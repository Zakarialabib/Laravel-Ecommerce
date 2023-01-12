<div>
    <x-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Show Product') }} - {{ $product->name }}
        </x-slot>

        <x-slot name="content">
            <div class="px-4 mx-auto mb-4">
                <div class="w-full mb-3">
                    <div class="flex justify-center px-3">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-32 h-32 rounded-full">
                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="w-full px-4">
                        <x-table-responsive>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Product Code') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->code }}
                                </x-table.td>
                            </x-table.tr>

                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Name') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Category') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->category?->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Brand') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->brand?->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Old Price') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->old_price }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Price') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $product->price }}
                                </x-table.td>
                            </x-table.tr>

                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Description') }}
                                </x-table.th>
                                <x-table.td>
                                    {!! $product->description !!}
                                </x-table.td>
                            </x-table.tr>
                        </x-table-responsive>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-modal>
</div>
