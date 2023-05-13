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

    <div x-data="{ openSettings : false }">
        <x-table>
            <x-slot name="thead">
                <x-table.th>#</x-table.th>
                <x-table.th sortable wire:click="sortBy('page_id')" :direction="$sorts['page_id'] ?? null">
                    {{ __('Page') }}
                    @include('components.table.sort', ['field' => 'page_id'])
                </x-table.th>
                <x-table.th>
                    {{ __('Language') }}
                </x-table.th>
                <x-table.th>
                    {{ __('Actions') }}
                </x-table.th>
            </x-slot>
            <x-table.tbody>
                @forelse($pagesettings as $pagesetting)
                    <x-table.tr>
                        <x-table.td>
                            <x-button success type="button" x-on:click="isOpen = !isOpen">
                                <i class="fas fa-cog"></i>
                            </x-button>
                        </x-table.td>
                        <x-table.td>
                            {{ $pagesetting->page_id }}
                        </x-table.td>
                        <x-table.td>
                                {{ $pagesetting->language->name }}
                        </x-table.td>
                        <x-table.td>
                            <div class="inline-flex">
                                <x-button danger type="button" wire:click="deleteModal({{ $pagesetting->id }})"
                                    wire:loading.attr="disabled">
                                    <i class="fas fa-trash-alt"></i>
                                </x-button>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                    <x-table.tr x-show="openSettings === {{ $pagesetting->id }}" class="bg-gray-100">
                        <x-table.td colspan="4">
                            <form wire:submit.prevent="updatePageSettings({{ $pagesetting->id }})">
                            </form>
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
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $pagesettings->links() }}
        </div>
    </div>

    <x-modal wire:model="showHeaderModal">
        <x-slot name="title">{{__('Page Settings')}}</x-slot>

        <x-slot name="content">

        </x-slot>
    </x-modal>

{{-- 
    <form wire:submit.prevent="saveSettings">
        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" wire:model="topHeader" />
                <span class="ml-2">{{__('Top Header')}}</span>
            </label>
            @if ($topHeader)
                <button class="ml-4 bg-blue-500 text-white rounded px-4 py-2" wire:click="openTopHeaderModal">
                    {{__('Select Template')}}</button>
            @endif
        </div>
        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" wire:model="bottomFooter" />
                <span class="ml-2">{{__('Bottom Footer')}}</span>
            </label>
            @if ($bottomFooter)
                <button class="ml-4 bg-blue-500 text-white rounded px-4 py-2" wire:click="openBottomFooterModal">
                    {{__('Select Template')}}</button>
            @endif
        </div>
        <!-- Add more variables here as needed -->
        <button type="submit" class="mt-4 bg-green-500 text-white rounded px-4 py-2">{{__('Save')}}</button>

    </form> --}}

    <!-- Header Template Modal -->
    @if ($showHeaderModal)
        <x-modal wire:model="showHeaderModal">
            <x-slot name="title">{{__('Choose a header template')}}</x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Render available header templates -->
                    @foreach ($headerTemplates as $template)
                        <div class="border rounded p-4">
                            {!! $template !!}
                            <!-- Render the HTML for the template component -->
                            <button class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                                wire:click="selectHeaderTemplate('{{ $template }}')">{{__('Select')}}</button>
                        </div>
                    @endforeach
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="$set('showHeaderModal', false)">{{__('Cancel')}}</x-button>
            </x-slot>
        </x-modal>
    @endif

    <!-- Footer Template Modal -->
    @if ($showFooterModal)
        <x-modal wire:model="showFooterModal">
            <x-slot name="title">{{__('Choose a footer template')}}</x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Render available footer templates -->
                    @foreach ($footerTemplates as $template)
                        <div class="border rounded p-4">
                            {!! $template !!}
                            <!-- Render the HTML for the template component -->
                            <button class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                                wire:click="selectFooterTemplate('{{ $template }}')">{{__('Select')}}</button>
                        </div>
                    @endforeach
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="$set('showFooterModal', false)">{{__('Cancel')}}</x-button>
            </x-slot>
        </x-modal>
    @endif

</div>
