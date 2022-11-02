<div class="mt-2 px-2">
    <x-input class="w-full"
        wire:model.debounce.400ms="file"
        x-init="$el.focus()"
        label="URL" placeholder="Enter your URL here"/>
</div>