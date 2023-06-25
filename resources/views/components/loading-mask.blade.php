@props([
    'size' => 'lg',
    'class' => '',
    'sizing' => [
        'sm' => 6,
        'md' => 10,
        'lg' => 14, 
        'xl' => 24,
        'xxl' => 36
    ],
])
<div x-data="loadingMask" x-show="!pageLoaded"  class="fixed inset-0 z-[100] flex items-center justify-center bg-white">
    <svg class="animate-spin inline-block bw-spinner h-{{ $sizing[$size] }} w-{{ $sizing[$size] }} {{$class}}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    <span class="hidden w-{{ $sizing[$size] }} h-{{ $sizing[$size] }}"></span>
</div>