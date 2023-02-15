@props(['placeholder' => null, 'value' => null])

<div class="mb-5" x-data="{
    content: @entangle($attributes->wire('model'))
}" x-init="document.addEventListener('DOMContentLoaded', () => {
    initQuill($refs.quillEditor, $dispatch);
})" x-cloak wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    x-on:text-change.debounce.2000ms="@this.set('{{ $attributes->wire('model')->value }}', $event.detail)">

    <div class="w-full pl-px pr-px bg-transparent z-20 absolute left-0 right-0" style="top: 38px;">
        <div id="quillProgressBar" class="bg-green-600 text-xs leading-none h-1" style="width: 0%"></div>
    </div>

    <div x-ref="quillEditor" {{ $attributes }}>
        {{ $value }}
    </div>
    

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
    <script src="https://unpkg.com/quill-paste-smart@latest/dist/quill-paste-smart.js" defer></script>
    <script>
        var endpoint = '{{ $endpoint ?? '' }}';
        var csrf = '{{ csrf_token() }}';

        function selectLocalImage(quillInstance) {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.click();
            input.onchange = () => {
                const file = input.files[0];
                if (/^image\//.test(file.type)) {
                    this.saveToServer(file, quillInstance);
                } else {
                    console.warn('You could only upload images.');
                }
            };
        };

        function saveToServer(file, quillInstance) {
            const fd = new FormData();
            fd.append('image', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', endpoint, true);
            xhr.setRequestHeader('X-CSRF-Token', csrf);

            xhr.upload.onprogress = function(event) {
                var progress = Math.round(event.loaded / event.total * 100) + '%';
                var progressBar = document.getElementById('quillProgressBar');

                if (event.lengthComputable) {
                    progressBar.style = `width: ${parseFloat(progress)}`;

                    if (event.loaded == event.total) {
                        progressBar.style = 'width: 0%';
                    }
                }
            };

            xhr.onload = function() {
                if (this.status >= 200 && this.status < 300) {
                    const data = JSON.parse(this.responseText);

                    const range = quillInstance.getSelection();
                    quillInstance.insertEmbed(range.index, 'image', `/${data.url}`);

                    quillInstance.setSelection(range.index + 1, Quill.sources.SILENT);
                }
            };
            xhr.send(fd);
        };

        function initQuill(ref, dispatch) {

            const quill = new Quill(ref, {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'header': 1 }, { 'header': 2 }],
                            ['link', 'blockquote', 'code-block', 'image', 'video'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'direction': 'rtl' }],

                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            ['clean']
                        ]
                    }
                },
                bounds: ref,
                placeholder: '{{ $placeholder ?? 'Write something great!' }}'
            });
            quill.on('text-change', function(delta, oldDelta, source) {
                dispatch('text-change', quill.root.innerHTML);
            });
            quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
                var plaintext = node.innerText.replace(/\s+/g, ' ').trim();
                var Delta = Quill.import('delta');
                return new Delta().insert(plaintext);
            });
            quill.getModule('toolbar').addHandler('image', () => {
                selectLocalImage(quill);
            });
        }
    </script>
@endpush
