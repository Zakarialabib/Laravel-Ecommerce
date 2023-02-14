@props(['placeholder' => null, 'value' => null, 'name' => null])

@php $id = uniqId(); @endphp
@props(['placeholder' => null, 'value' => null, 'name' => null])

@php $id = uniqId(); @endphp

<div x-data="{ error: '', showToolbar: true }" x-init="showToolbar = Boolean('{{ $toolbar ?? true }}');
document.addEventListener('DOMContentLoaded', () => {
    toolbarSettings = [{
            name: 'bold',
            action: EasyMDE.toggleBold,
            className: 'fa fa-bold',
            title: 'Bold'
        },
        {
            name: 'italic',
            action: EasyMDE.toggleItalic,
            className: 'fa fa-italic',
            title: 'Italic'
        },
        {
            name: 'strikethrough',
            action: EasyMDE.toggleStrikethrough,
            className: 'fa fa-strikethrough',
            title: 'Strikethrough'
        },
        {
            name: 'heading-2',
            action: EasyMDE.toggleHeading2,
            className: 'fa fa-header',
            title: 'Heading'
        },
        {
            name: 'quote',
            action: EasyMDE.toggleBlockquote,
            className: 'fa fa-quote-left',
            title: 'Quote'
        },
        {
            name: 'unordered-list',
            action: EasyMDE.toggleUnorderedList,
            className: 'fa fa-list-ul',
            title: 'Unordered list'
        },
        {
            name: 'ordered-list',
            action: EasyMDE.toggleOrderedList,
            className: 'fa fa-list-ol',
            title: 'Ordered list'
        },
        {
            name: 'link',
            action: EasyMDE.drawLink,
            className: 'fa fa-link',
            title: 'Create Link'
        },
        {
            name: 'code',
            action: EasyMDE.toggleCodeBlock,
            className: 'fa fa-code',
            title: 'Code'
        },
        {
            name: 'image',
            action: EasyMDE.drawImage,
            className: 'fa fa-image',
            title: 'Insert Image'
        },
        {
            name: 'clean-block',
            action: EasyMDE.cleanBlock,
            className: 'fa fa-eraser',
            title: 'Clean block'
        },
        {
            name: 'preview',
            action: EasyMDE.togglePreview,
            className: 'fa fa-eye no-disable',
            title: 'Toggle Preview'
        },
        {
            name: 'side-by-side',
            action: EasyMDE.toggleSideBySide,
            className: 'fa fa-columns no-disable no-mobile',
            title: 'Toggle Side by Side'
        },
        {
            name: 'fullscreen',
            action: EasyMDE.toggleFullScreen,
            className: 'fa fa-arrows-alt no-disable no-mobile',
            title: 'Toggle Fullscreen'
        }
    ];
    new EasyMDE({
        element: $refs.input,
        toolbar: showToolbar == true ? toolbarSettings : false,
        renderingConfig: {
            codeSyntaxHighlighting: true
        },
        spellChecker: false,
        forceSync: true,
        tabSize: 4,
        placeholder: '{{ $placeholder ?? 'Write something...' }}',
        autoDownloadFontAwesome: true
    });
});" class="relative" x-cloak>
    <div class="relative">
        <textarea id="{{ $id }}" placeholder="{{ $placeholder ?? '' }}" {{ $attributes->merge() }} x-ref="input">{{ old($name, $value ?? '') }}</textarea>
    </div>
</div>
</div>


@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
@endpush
