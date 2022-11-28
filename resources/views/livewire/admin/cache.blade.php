<div>
    <form wire:submit.prevent="onClearCache">
        <span>
            <div wire:loading wire:target="onClearCache">
                <x-loading />
            </div>
            <span>{{ __('Clear all Cache') }}</span>
        </span>
    </form>
</div>
