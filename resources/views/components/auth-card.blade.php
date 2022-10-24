{{-- attribute class and title null --}}

@props(['title' => null])

<div class="{{ $attributes->get('class') }} bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        @if ($title)
            <div class="mb-4 text-sm text-gray-600">
                {{ $title }}
            </div>
        @endif

        {{ $slot }}
    </div>
</div>