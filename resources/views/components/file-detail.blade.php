@props([
    'file'
])

<div class="lg:flex block">
    <main class="w-full overflow-y-auto lg:pr-4 pb-4 lg:pb-0">
        <div class="block w-full aspect-w-10 aspect-h-7 rounded-lg overflow-hidden">
            <img src="{{ $this->previewFile }}" alt="" class="object-cover">
        </div>
    </main>

    <aside class="w-96 bg-white overflow-y-auto px-1">
        <div class="space-y-6">
            <h3 class="font-medium text-gray-900">Metadata</h3>

            <div>
                <x-input.text wire:model.defer="metadata.alt" label="Alt" placeholder="Alt"/>
            </div>

            <div>
                <x-label for="caption" class="sr-only">{{__('Caption')}}</label>
                <x-input.textarea wire:model.defer="metadata.caption" id="caption" placeholder="Caption"/>
            </div>
        </div>

        <div class="flex justify-end">
            <div class="pt-4 space-x-2">
                <x-button.secondary wire:click="resetFile">{{__('Cancel')}}</x-button.secondary>
                <x-button primary type="button" wire:click="selectFile">{{__('Select')}}</x-button>
            </div>
        </div>
    </aside>
</div>