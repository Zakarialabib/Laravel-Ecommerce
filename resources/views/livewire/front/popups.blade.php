<div x-data="{ showPopup: {{ $show }} }" x-show="showPopup"  x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed top-0 left-0 {{ $width }} h-full flex items-center justify-center px-4 py-8 z-50 overflow-y-auto bg-black bg-opacity-75 ">
    <div class="relative w-full {{ $width }} shadow-lg rounded-lg p-8"
        style="background-color:{{ $backgroundColor }}">
        <div class="mb-4 font-bold text-2xl">{{ $content }}</div>
        <div class="flex items-center justify-between">
            <a href="{{ $ctaUrl }}"
                class="inline-block px-4 py-2 leading-none text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600">{{ $ctaText }}</a>
            <button wire:click="hide"
                class="inline-block px-4 py-2 leading-none text-gray-600 hover:text-gray-800 focus:outline-none">Close</button>
        </div>
    </div>
</div>

@push('scripts')

<script>
    // Add trigger events and timing logic using AlpineJS

    @if ($timing === 'delay')
        setTimeout(function () {
            @this.call('show')
        }, {{ $delay }} * 1000);
    @endif

    @if ($timing === 'duration')
        setTimeout(function () {
            @this.call('hide')
        }, {{ $duration }} * 1000);
    @endif

    @if ($timing === 'interval')
        setInterval(function () {
            @this.call('show')
        }, {{ $interval }} * 1000);
    @endif


    start();
</script>
@endpush