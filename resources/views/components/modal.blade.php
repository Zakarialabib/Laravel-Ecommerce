@props(['id' => null, 'maxWidth' => null])


@php
    $id = $id ?? md5($attributes->wire('model'));
    
    $maxWidth =
        [
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
            '3xl' => 'sm:max-w-3xl',
            '4xl' => 'sm:max-w-4xl',
            '5xl' => 'sm:max-w-5xl',
        ][$maxWidth ?? '2xl'] ?? 'sm:max-w-2xl';
@endphp

<div x-data="{
    show: @entangle($attributes->wire('model')),
    focusables() {
        let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
        return Array.from($el.querySelectorAll(selector)).filter(el => !el.hasAttribute('disabled'));
    },
    firstFocusable() { return this.focusables().find(el => !el.hasAttribute('disabled')); },
    lastFocusable() { return this.focusables().slice().reverse().find(el => !el.hasAttribute('disabled')); },
    nextFocusable() {
        let index = this.focusables().indexOf(document.activeElement);
        return this.focusables().slice(index + 1).find(el => !el.hasAttribute('disabled')) || this.firstFocusable();
    },
    prevFocusable() {
        let index = this.focusables().indexOf(document.activeElement);
        return this.focusables().slice(0, index).reverse().find(el => !el.hasAttribute('disabled')) || this.lastFocusable();
    },
    autofocus() {
        let focusable = $el.querySelector('[autofocus]');
        if (focusable) focusable.focus();
    },
    prevFocusable() {
        let index = this.focusables().indexOf(document.activeElement);
        return this.focusables().slice(0, index).reverse().find(el => !el.hasAttribute('disabled')) || this.lastFocusable();
    },
    autofocus() {
        let focusable = $el.querySelector('[autofocus]');
        if (focusable) focusable.focus();
    },
}" x-init="$watch('show', value => value && setTimeout(autofocus, 50))" x-on:close.stop="show = false" x-show="show"
    class="fixed inset-x-0 px-6 z-50 sm:fixed top-0 left-0 w-full h-full py-16 md:py-28 bg-opacity-50 overflow-y-auto"
    style="display: none;">
    <div class="fixed inset-0 transform" x-on:click="show = false">
        <div x-show="show" class="absolute inset-0 bg-gray-200 opacity-75"></div>
    </div>
    <div
        class="mt-2 py-10 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto">
        <div x-show="show" class="bg-white text-gray-700 px-4"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="mt-3 text-center sm:text-left">
                <h3 class="text-lg text-center my-4">
                    {{ $title }}
                </h3>

                <div class="mb-4">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>
</div>
