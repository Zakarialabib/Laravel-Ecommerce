@props(['value'])

@php
    $trixId = 'trix-' . uniqid();
    $wireModel = $attributes->wire('model')->value();
@endphp

<div wire:ignore>
    <input id="{{ $trixId }}" type="hidden" value="{{ $value }}">
    <trix-editor input="{{ $trixId }}"></trix-editor>
</div>

@pushOnce('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
        integrity="sha512-GG6XKzeFZMqSHqztQeTgOYHddZqXdqMBu/3OZiuhF6Goa4goVNISW0DOeq8np+3QQ7Cr5SqfBZwq8Cts18z9bw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endPushOnce

@pushOnce('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
        integrity="sha512-FbyD4UqWgqdu7/L4jnni5NW6gkH++cQzWDP3VWSEhxZy5gTZm3xR0im+ygNmkWBmSKEVIVgWeB2bSrtRNiA/Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endPushOnce

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            let trixInput = document.getElementById('{{ $trixId }}');

            // Initialize Trix editor
            let editor = new Trix.Editor(trixInput);
            
            // Set initial value
            editor.insertHTML(trixInput.value);
            
            // Update the model value when the content changes
            editor.addEventListener('trix-change', function (event) {
                @this.set('{{ $wireModel }}', event.target.innerHTML);
            });
            
            // Update the editor content when the Livewire model changes
            Livewire.on('{{ $wireModel }}Updated', function (content) {
                editor.loadHTML(content);
            });
        });
    </script>
@endpush
