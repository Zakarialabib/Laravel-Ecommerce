<!-- resources/views/components/quill.blade.php -->
<div
    class="rounded-md shadow-sm"
<<<<<<< Updated upstream
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
=======
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
@once
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" integrity="sha512-/FHUK/LsH78K9XTqsR9hbzr21J8B8RwHR/r8Jv9fzry6NVAOVIGFKQCNINsbhK7a1xubVu2r5QZcz2T9cKpubw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js" integrity="sha512-P2W2rr8ikUPfa31PLBo5bcBQrsa+TNj8jiKadtaIrHQGMo6hQM6RdPjQYxlNguwHz8AwSQ28VkBK6kHBLgd/8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@endonce
>>>>>>> Stashed changes
