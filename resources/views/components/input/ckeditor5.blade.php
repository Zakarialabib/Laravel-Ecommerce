<!-- resources/views/components/ckeditor.blade.php -->
<div
    class="rounded-md shadow-sm"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <textarea
        class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        wire:model="{{ $attributes->wire('model') }}"
    ></textarea>
</div>

<!-- add the script to the Blade layout file -->
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('textarea'), {
            toolbar: [
                'bold',
                'italic',
                'bulletedList',
                'numberedList',
                'blockQuote',
                'undo',
                'redo',
                'link'
            ]
        });
    </script>
@endpush
