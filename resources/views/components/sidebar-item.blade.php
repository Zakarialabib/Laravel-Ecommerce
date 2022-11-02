@props([
    'key',
    'name',
    'tab',
    'icon'
])

<a
    wire:click.prevent="setTab('{{ $key }}')"
    href="#"
    class="{{ $key === $tab ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md"
>
<i class="{{ $icon }} {{ $key === $tab ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-400' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6"></i>
<span class="truncate">{{ $name ?? \Illuminate\Support\Str::headline($key) }}</span>
</a>