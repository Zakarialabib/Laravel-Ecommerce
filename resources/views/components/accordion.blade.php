@props([
    'title',
    'id',
    'color' => 'indigo',
])

<div x-data="{ openAccordion: false }" class="w-full py-2">
    <div class="flex justify-between items-center cursor-pointer bg-{{ $color }}-500 text-white font-extralight text-center py-2 px-4 " @click="openAccordion = !openAccordion">
        <div class="text-lg font-bold">
            {{ $title }}
        </div>
        <div>
            <svg class="w-6 h-6" :class="{'transform rotate-180': openAccordion}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
    <div x-show="openAccordion" class="mt-2 divide-y divide-gray-400">
        {{ $slot }}
    </div>
</div>