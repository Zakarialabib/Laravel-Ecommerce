<!-- resources/views/components/tinymce.blade.php -->
<div
    class="rounded-md shadow-sm"
    x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.tinymce },
        setValue() { this.$refs.tinymce.value = this.value },
    }"
    x-init="setValue(); $watch('value', () => isFocused() && setValue())"
    x-on:input="value = $event.target.value"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <textarea x-ref="tinymce" class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
</div>

<!-- add the script to the Blade layout file -->
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/<your_api_key>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link',
            plugins: 'link',
            height: 500
        });
    </script>
@endpush
