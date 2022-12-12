<div
    class="rounded-md shadow-sm"
    x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.trix },
        setValue() { this.$refs.trix.editor.loadHTML(this.value) },
    }"
    x-init="setValue(); $watch('value', () => isFocused() && setValue())"
    x-on:trix-change="value = $event.target.value"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <input id="x" type="hidden">
    <trix-editor x-ref="trix" input="x" class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"></trix-editor>
</div>

@once
    @push('styles')
        <link href="https://unpkg.com/trix@1.x.x/dist/trix.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/trix@1.x.x/dist/trix.js"></script>
    @endpush
@endonce