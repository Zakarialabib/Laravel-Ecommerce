
@props(['value' => ''])

<div
    x-data="{ content: @entangle($attributes->wire('model')) }"
    x-on:text-change="content = $event.detail.content"
    x-init="initQuill($refs.editor, $dispatch)"
    class="mt-1"
>
    <div wire:ignore>
        <div x-ref="editor">{!! $value !!}</div>
    </div>
</div>


////// version 

@php
    $id = uniqid()
@endphp

<div 
    class="rounded-md shadow-sm"
    x-data="{ data: @entangle($attributes->wire('model')) }"
    x-init="
        quill{{$id}} = new Quill($refs.editor, {  modules: {
    toolbar: ['bold', 'italic', 'underline'],
        ['blockquote'],
        [{ 'header': 2 }],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'align': [] }],
        [
            'link',
            // 'image',
            // 'video'
        ],
        ['clean']
  },theme: 'snow'});
        delta = quill{{$id}}.clipboard.convert(data)
        quill{{$id}}.setContents(delta, 'silent')
        quill{{$id}}.on('text-change', function () {
            data = quill{{$id}}.root.innerHTML;
        });
    "
    wire:ignore
>
    <div x-ref="editor"></div>
</div>

<!-- add the script to the Blade layout file -->
@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
@endpush



:////


<div x-data="{ content: @entangle($attributes->wire('model')) }" x-on:text-change="content = $event.detail.content"
    x-on:input="content = $event.target.content" x-init="initQuill($refs.editor, $dispatch)" class="mt-1">
    <div wire:ignore>
        <div x-ref="editor"></div>
    </div>
</div>

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
@endpush

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script src="https://unpkg.com/quill-paste-smart@latest/dist/quill-paste-smart.js" defer></script>
    <script>
        function initQuill(ref, dispatch) {
            const toolbar = [
                [{
                    'header': 2
                }, 'bold', 'italic', 'underline', 'strike'],
                ['link', 'blockquote', 'code-block', 'image', 'video'],
                [{
                    list: 'ordered'
                }, {
                    list: 'bullet'
                }],
                ['clean']
            ]

            const quill = new Quill(ref, {
                theme: 'snow',
                modules: {
                    toolbar
                },
                bounds: ref
            });
            quill.on('text-change', function(delta, oldDelta, source) {
                @this.set('{{ $attributes->get('wire:model') }}', {
                    "delta": delta,
                    "oldDelta": oldDelta
                })
            });
        }
    </script>
@endpush
