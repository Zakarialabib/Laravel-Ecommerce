<div>
    <div wire:key="images-finder">
        <div class="flex items-center">
            <div class="flex-1">
                <x-input.text
                    label="Keyword"
                    x-data=""
                    x-init="$el.focus()"
                    x-on:keydown.enter.prevent=""
                    wire:model.debounce.700ms="keyword"
                    placeholder="Please type a keyword to find images..."/>
            </div>
            <svg wire:loading class="animate-spin h-6 w-6 text-gray-500 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        @if (count($photos))
            <ul wire:loading.class="opacity-50" role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 mt-6">
                @foreach ($photos as $index => $photo)
                    <li wire:click="selectImage('{{ $index }}')" class="relative cursor-pointer">
                        <div class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-gray-800 overflow-hidden">
                            <img src="{{ $photo['urls']['small'] }}" alt="{{ $photo['alt_description'] }}" class="object-cover pointer-events-none group-hover:opacity-75">
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4 flex justify-center items-center space-x-2">
                <div wire:key="previous-button">
                    @if ($page > 1)
                        <x-button.secondary wire:click="previousPage">
                            <x-heroicon-o-arrow-left class="w-4 h-4"/>
                            <span class="ml-2">{{__('Previous')}}</span>
                        </x-button.secondary>
                    @endif
                </div>

                <div wire:key="next-button">
                    @if ($page < $totalPages)
                        <x-button.secondary wire:click="nextPage">
                            <span class="mr-2">{{__('Next')}}</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4"/>
                        </x-button.secondary>
                    @endif
                </div>
            </div>
        @elseif ($keyword && !count($photos))
            <div class="px-8 pt-6 text-center text-gray-500 text-lg">{{__('Oops! There are no images match your keyword.')}}</div>
        @endif
    </div>
</div>