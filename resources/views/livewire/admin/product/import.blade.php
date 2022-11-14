<div>
    {{-- Import modal --}}

    <x-modal wire:model="importModal">
        <x-slot name="title">
            {{ __('Import Excel') }}
        </x-slot>

        <x-slot name="content">

            <div class="w-full px-3 py-2">
                <x-table-responsive>
                    <x-table.tr>
                        <x-table.th>{{ __('Name') }}</x-table.th>
                        <x-table.td>{{ __('Required') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Description') }}</x-table.th>
                        <x-table.td>{{ __('Required') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Price') }}</x-table.th>
                        <x-table.td>{{ __('Required') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Old price') }}</x-table.th>
                        <x-table.td>{{ __('Optional') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Category name') }}</x-table.th>
                        <x-table.td>{{ __('Required') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Subcategory name') }}</x-table.th>
                        <x-table.td>{{ __('Optional') }}</x-table.td>
                    </x-table.tr>

                    <x-table.tr>
                        <x-table.th>{{ __('Brand') }}</x-table.th>
                        <x-table.td>{{ __('Optional') }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Image') }}</x-table.th>
                        <x-table.td>{{ __('Required') }}</x-table.td>
                    </x-table.tr>

                </x-table-responsive>
                <form wire:submit.prevent="import">
                    <div class="w-full px-3 my-2">
                        <x-label for="import_file" :value="__('Import')" />
                        <x-fileupload wire:model="file" :file="$file" accept="file/xlsx" />
                        {{-- <input class="block mt-1 w-full" type="file" name="import_file" wire:model="import_file" /> --}}
                        <x-input-error :messages="$errors->get('import_file')" for="import_file" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:click="import" class="block"
                            wire:loading.attr="disabled">
                            {{ __('Import') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-slot>
    </x-modal>

    {{-- End Import modal --}}
</div>
