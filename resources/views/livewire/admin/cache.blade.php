<div>
    <button type="button" wire:click="onClearCache">
        <span>
            <div wire:loading wire:target="onClearCache">
                <x-loading />
            </div>
            <span>{{ __('Clear all Cache') }}</span>
        </span>
    </button>
</div>
