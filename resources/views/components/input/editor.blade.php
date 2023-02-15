<div class="mb-5" x-data="{
    content: @entangle($attributes->wire('model'))
    endpoint: '{{ $endpoint ?? '' }}',
    csrf: '{{ csrf_token() }}',
    selectLocalImage(quillInstance) {
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
    },
    saveToServer(file, quillInstance) {
        const fd = new FormData();
        fd.append('image', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.endpoint, true);
        xhr.setRequestHeader('X-CSRF-Token', this.csrf);

        xhr.upload.onprogress = function(event) {
            var progress = Math.round(event.loaded / event.total * 100) + '%';
            var progressBar = document.getElementById('quillProgressBar');

            if (event.lengthComputable) {
                progressBar.style = `width: ${parseFloat(progress)}`;

                // Upload finished
                if (event.loaded == event.total) {
                    progressBar.style = 'width: 0%';
                }
            }
        };

        xhr.onload = function() {
            if (this.status >= 200 && this.status < 300) {
                // this is callback data: url
                const data = JSON.parse(this.responseText);
                // console.log(data);

                // push image url to rich editor.
                const range = quillInstance.getSelection();
                quillInstance.insertEmbed(range.index, 'image', `/${data.url}`);
                // puts the cursor at the end of image
                quillInstance.setSelection(range.index + 1, Quill.sources.SILENT);
            }
        };
        xhr.send(fd);
    }
}" x-init="document.addEventListener('DOMContentLoaded', () => {
    quill = new Quill($refs.quillEditor, {
        scrollingContainer: '.ql-scrolling-container',
        modules: {
            toolbar: {
                container: [
                    [{ 'header': 2 }, 'bold', 'italic', 'underline', 'strike'],
                    ['link', 'blockquote', 'code-block', 'image', 'video'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['clean']
                ]
            }
        },
        theme: 'snow',
        placeholder: '{{ $placeholder ?? 'Write something great!' }}'
    });
    quill.on('text-change', function() {
        let html = quill.root.innerHTML;
        if (html === '<p><br></p>') html = ''
        content = html;
    });
    quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
        var plaintext = node.innerText.replace(/\s+/g, ' ').trim();
        var Delta = Quill.import('delta');
        return new Delta().insert(plaintext);
    });
    quill.getModule('toolbar').addHandler('image', () => {
        selectLocalImage(quill);
    });
    content = (quill.root.innerHTML === '<p><br></p>') ?
        '' :
        quill.root.innerHTML;
})" x-cloak>


    <div class="relative {{ $errors->has($name) ? 'ql-editor-haserror' : '' }}">

        <div class="w-full pl-px pr-px bg-transparent z-20 absolute left-0 right-0" style="top: 38px;">
            <div id="quillProgressBar" class="bg-green-600 text-xs leading-none h-1" style="width: 0%"></div>
        </div>

        <textarea class="hidden" name="{{ $name }}" {{ $attributes->merge() }}></textarea>
        <div x-ref="quillEditor" x-model="content" class="bg-white min-h-full h-auto">
            {!! old($name, $value ?? '') !!}
        </div>

        @error($name)
            <svg class="absolute z-10 text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
            </svg>
            <div class="text-red-600 mt-2 text-sm block leading-tight">{{ $message }}</div>
        @enderror
    </div>
</div>


@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* Toolbar Styles */
        .ql-editor-haserror .ql-toolbar.ql-snow+.ql-container.ql-snow {
            border: 1px solid #f56565;
            border-radius: 0.5rem;
        }

        .ql-toolbar.ql-snow+.ql-container.ql-snow {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
        }

        .ql-toolbar.ql-snow {
            font-family: inherit;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            background-color: #fff;
            border: none;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1;
            margin-left: 1px;
            margin-right: 1px;
        }

        .ql-container {
            color: #2d3748;
            font-family: inherit;
            font-size: inherit;
        }

        .ql-container.ql-snow {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border-color: #e2e8f0;
            margin-top: -44px;
        }

        .ql-editor {
            overflow-y: visible;
            padding-top: 64px;
        }

        .ql-scrolling-container {
            height: 100%;
            min-height: 100%;
            overflow-y: auto;
        }

        .ql-editor.ql-blank::before {
            color: #a0aec0;
            font-style: normal;
        }

        .ql-editor:focus {
            border-radius: 0.5rem;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        .ql-editor h1,
        .ql-editor h2,
        .ql-editor h3 {
            font-size: 1.75rem !important;
            font-weight: 700;
            color: #2d3748;
            border-bottom: 0;
            margin-bottom: 0.75em;
            line-height: 1.2;
        }

        .ql-editor p,
        .ql-editor ul,
        .ql-editor ol,
        .ql-snow .ql-editor pre {
            margin-bottom: 1em;
        }

        .ql-editor strong {
            font-weight: 700;
        }

        .ql-editor ol,
        .ql-editor ul {
            padding-left: 0;
        }

        .ql-editor li {
            margin-bottom: 0.25em;
        }

        .ql-editor a {
            color: #4299e1;
        }

        .ql-editor blockquote {
            position: relative;
            display: block;
            margin-top: 1.875em !important;
            margin-bottom: 1.875em !important;
            font-size: 1.875rem;
            line-height: 1.2;
            border-left: 3px solid #cbd5e0;
            font-weight: 600;
            color: #4a5568;
            font-style: normal;
            letter-spacing: -0.05em;
        }

        .ql-snow .ql-editor pre {
            display: block;
            border-radius: 0.5rem;
            padding: 1rem;
            font-size: 1rem;
        }

        .ql-snow .ql-editor img {
            border-radius: 0.5rem;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .ql-editor iframe {
            width: 100%;
            max-width: 100%;
            height: 400px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js" defer></script>
    <script src="https://unpkg.com/quill-paste-smart@latest/dist/quill-paste-smart.js" defer></script>
@endpush
