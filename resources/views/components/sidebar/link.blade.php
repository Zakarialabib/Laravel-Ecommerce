@props(['isActive' => false, 'title' => '', 'collapsible' => false])

@php
$isActiveClasses = $isActive ? 'bg-indigo-500 text-white active:bg-indigo-500' : 'text-white hover:text-indigo-500 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-dark-eval-2';
$classes = 'flex items-center hover:text-white hover:bg-indigo-500 pl-3 py-3 pr-4 rounded ' . $isActiveClasses;
if ($collapsible) {
    $classes .= ' w-full';
}
@endphp

@if ($collapsible)
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon ?? false)
            {{ $icon }}
        @else
        <span class="inline-block mr-3">
            <x-icons.empty-circle class="text-white w-5 h-5" aria-hidden="true" />
        </span>
        @endif

        <span x-show="isSidebarOpen || isSidebarHovered">
            {{ $title }}
        </span>

        <span x-show="isSidebarOpen || isSidebarHovered" aria-hidden="true" class="relative block w-6 h-6 ml-auto">
            <span :class="open ? '-rotate-45' : 'rotate-45'"
                class="absolute right-[9px] bg-gray-400 mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200"></span>
            <span :class="open ? 'rotate-45' : '-rotate-45'"
                class="absolute left-[9px] bg-gray-400 mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200"></span>
        </span>
    </button>
    
    @if ($add ?? false)
    {{ $add }}
    @endif
@else
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon ?? false)
            {{ $icon }}
        @else
            <span class="inline-block mr-3">
                <x-icons.empty-circle class="text-white w-5 h-5" aria-hidden="true" />
            </span>
        @endif

        <span x-show="isSidebarOpen || isSidebarHovered">
            {{ $title }}
        </span>

    </a>

    @if ($add ?? false)
    {{ $add }}
    @endif
@endif
