<div>
    <form wire:submit.prevent="saveSettings">
        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" wire:model="topHeader" />
                <span class="ml-2">Top Header</span>
            </label>
            @if ($topHeader)
                <button class="ml-4 bg-blue-500 text-white rounded px-4 py-2" wire:click="openTopHeaderModal">Select
                    Template</button>
            @endif
        </div>
        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" wire:model="bottomFooter" />
                <span class="ml-2">Bottom Footer</span>
            </label>
            @if ($bottomFooter)
                <button class="ml-4 bg-blue-500 text-white rounded px-4 py-2" wire:click="openBottomFooterModal">Select
                    Template</button>
            @endif
        </div>
        <!-- Add more variables here as needed -->
        <button type="submit" class="mt-4 bg-green-500 text-white rounded px-4 py-2">Save</button>

    </form>

    <!-- Header Template Modal -->
    @if ($showHeaderModal)
        <x-modal wire:model="showHeaderModal">
            <x-slot name="title">Choose a header template</x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Render available header templates -->
                    @foreach ($headerTemplates as $template)
                        <div class="border rounded p-4">
                            {!! $template !!}
                            <!-- Render the HTML for the template component -->
                            <button class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                                wire:click="selectHeaderTemplate('{{ $template }}')">Select</button>
                        </div>
                    @endforeach
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="$set('showHeaderModal', false)">Cancel</x-button>
            </x-slot>
        </x-modal>
    @endif

    <!-- Footer Template Modal -->
    @if ($showFooterModal)
        <x-modal wire:model="showFooterModal">
            <x-slot name="title">Choose a footer template</x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Render available footer templates -->
                    @foreach ($footerTemplates as $template)
                        <div class="border rounded p-4">
                            {!! $template !!}
                            <!-- Render the HTML for the template component -->
                            <button class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
                                wire:click="selectFooterTemplate('{{ $template }}')">Select</button>
                        </div>
                    @endforeach
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="$set('showFooterModal', false)">Cancel</x-button>
            </x-slot>
        </x-modal>
    @endif
</div>
