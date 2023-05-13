<div>
    <!-- Create the editor container -->
    <div id="{{ $quillId }}" wire:ignore></div>
</div>

@pushOnce('styles')
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endPushOnce

@pushOnce('scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endPushOnce

@push('scripts')
     <!-- Initialize Quill editor -->
     <script>
        var quill = new Quill('#{{ $quillId }}', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }],
                        ['link', 'blockquote', 'code-block', 'image', 'video'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'direction': 'rtl'
                        }],

                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],

                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['clean']
                    ]
                }
            },
        });
        quill.on('text-change', function() {
            let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
            @this.set('value', value)
        })
    </script>
@endpush