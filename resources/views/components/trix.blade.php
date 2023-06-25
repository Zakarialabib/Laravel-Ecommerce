@props([
    'label' => '',
    'name' => '',
])

@php 
    $id = $name ? str_replace(' ', '', $name) : uniqid();
@endphp

<div>
    @if ($label) 
        <label for="{{ $id }}" class="block font-semibold mb-1">{{ $label }}</label>
    @endif

    <div x-data="{ value: @entangle($attributes->wire('model')) }" wire:ignore>
        <trix-editor {{ $attributes }} x-on:trix-change="value = $event.target.value"></trix-editor>
    </div>

    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>