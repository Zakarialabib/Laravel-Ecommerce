<!-- resources/views/components/quill.blade.php -->
<div
    class="rounded-md shadow-sm"
    x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.quill },
        setValue() { this.quill.root.innerHTML = this.value },
    }"
    x-init="setValue(); $watch('value', () => isFocused() && setValue()); this.quill = new Quill(this.$refs.quill, { modules: { toolbar: [ ...Object.keys(Quill.import('modules/toolbar').Toolbar.defaults.handlers).slice(0, 8) ] } })"
    x-on:input="value = $event.target.innerHTML"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <div ref="quill" class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"></div>
</div>

<!-- add the script to the Blade layout file -->
@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
@endpush
