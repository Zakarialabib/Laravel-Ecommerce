<!-- resources/views/components/quill.blade.php -->
<div
    class="rounded-md shadow-sm"
    wire:ignore
>
    <div x-data
    x-ref="quillEditor"
    x-init="
      quill = new Quill($refs.quillEditor, {theme: 'snow'});
      quill.on('text-change', function () {
        $dispatch('input', quill.root.innerHTML);
      });
    "
     class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"></div>
</div>


<!-- add the script to the Blade layout file -->
@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
@endpush
