@props(['title' => '', 'active' => false])

@php
    
$classes = 'transition-colors hover:text-gray-900';
$active 
    ? $classes .= ' text-gray-200' 
    : $classes .= ' text-white';
@endphp

<li>
    <a class="flex items-center pl-3 py-3 pr-4 text-white hover:text-white hover:bg-indigo-500 rounded" {{ $attributes->merge(['class' => $classes]) }}>{{ $title }}</a>
</li>