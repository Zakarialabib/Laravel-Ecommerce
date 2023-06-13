@props(['value'])

@php
    $quillId = 'quill-' . uniqid();
    $wireModel = @entangle($attributes->wire('model'));
@endphp

<div class="rounded-md shadow-sm" wire:ignore>
    <div id="{{ $quillId }}"
        class="prose max-w-full form-textarea block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    ></div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css"
        integrity="sha512-/FHUK/LsH78K9XTqsR9hbzr21J8B8RwHR/r8Jv9fzry6NVAOVIGFKQCNINsbhK7a1xubVu2r5QZcz2T9cKpubw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"
        integrity="sha512-P2W2rr8ikUPfa31PLBo5bcBQrsa+TNj8jiKadtaIrHQGMo6hQM6RdPjQYxlNguwHz8AwSQ28VkBK6kHBLgd/8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Initialize Quill editor -->
    <script>
        document.addEventListener('livewire:load', function () {
            var quill = new Quill('#{{ $quillId }}', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{'header': 1}, {'header': 2}],
                        ['link', 'blockquote', 'code-block', 'image', 'video'],
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                        [{'direction': 'rtl'}],
                        [{'size': ['small', false, 'large', 'huge']}],
                        [{'header': [1, 2, 3, 4, 5, 6, false]}],
                        [{'color': []}, {'background': []}],
                        [{'font': []}],
                        [{'align': []}],
                        ['clean']
                    ]
                },
            });

            quill.on('text-change', function() {
                let html = quill.root.innerHTML;
                @entangle($wireModel).set(html);
            });

            Livewire.on('{{ $wireModel }}Updated', function(html) {
                quill.root.innerHTML = html;
            });
        });
    </script>
@endPush
