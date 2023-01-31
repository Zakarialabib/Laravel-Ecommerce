<div>
    <div  class="container mx-auto my-5">
    
    <x-table>
        <x-slot name="thead">
            <x-table.th>
                {{ __('Name') }}
            </x-table.th>
            <x-table.th>
                {{ __('Created at') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>

        <x-table.tbody>
            @forelse ($popups as $popup)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $popup->id }}">
                    <x-table.td>
                        {{ $popup->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $popup->created_at }}
                    </x-table.td>
                    <x-table.td>
                        @if ($popup->is_default == false)
                            <x-button type="button" success wire:click="setDefault( {{ $popup->id }})">
                                {{ __('Set as Default') }}</x-button>
                        @endif
                        <x-button type="button" secondary wire:click="popupModal{{ $popup->id }})">
                            {{ __('Edit') }}
                        </x-button>
                        <x-button type="button" danger wire:click="delete{{ $popup->id }})">
                            {{ __('Delete') }}
                        </x-button>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    @if ($popupModal)
        <x-modal wire:model="popupModal">
            <x-slot name="title">
                @if ($popup === null)
                    <h3>
                        {{ __('Create') }}
                    </h3>
                @else
                    <h3>
                        {{ __('Update') }}
                    </h3>
                @endif
            </x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="create ?? edit">
                    <div class="mb-4 font-bold text-2xl">
                        <div class="container mx-auto">
                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="delay">{{ __('Name') }}</label>
                                <input wire:model="name" type="text"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>
                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="width">{{ __('Width') }}</label>
                                <select wire:model="width"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="sm">{{ __('Small') }}</option>
                                    <option value="md">{{ __('Medium') }}</option>
                                    <option value="lg">{{ __('Large') }}</option>
                                    <option value="xl">{{ __('Extra Large') }}</option>
                                </select>
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="frequency">{{ __('Frequency') }}</label>
                                <select wire:model="frequency"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="once">{{ __('Once') }}</option>
                                    <option value="multiple">{{ __('Multiple') }}</option>
                                </select>
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="timing">{{ __('Timing') }}</label>
                                <select wire:model="timing"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="delay">{{ __('Delay') }}</option>
                                    <option value="interval">{{ __('Interval') }}</option>
                                </select>
                            </div>

                            <div class="mb-4 w-full max-w-md" x-show="timing == 'delay' || timing == 'interval'">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="delay">{{ __('Delay/Interval (seconds)') }}</label>
                                <input wire:model="delay" type="number"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>

                            <div class="mb-4 w-full max-w-md" x-show="timing == 'duration'">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="duration">{{ __('Duration (seconds)') }}</label>
                                <input wire:model="duration" type="number"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="color">{{ __('Background Color') }}</label>
                                <input wire:model="backgroundColor" type="color"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="x block font-bold mb-2 text-gray-700"
                                    for="content">{{ __('Content') }}</label>
                                <textarea wire:model="content"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    rows="5"></textarea>
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="ctaText">{{ __('CTA Text') }}</label>
                                <input wire:model="ctaText" type="text"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>

                            <div class="mb-4 w-full max-w-md">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="ctaUrl">{{ __('CTA URL') }}</label>
                                <input wire:model="ctaUrl" type="text"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <!-- Create form -->
                        @if ($popup === null)
                            <button wire:click="create" type="button"
                                class="inline-block px-4 py-2 leading-none text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600">{{ __('Create') }}</button>
                        @else
                            <button wire:click="update" type="button"
                                class="inline-block px-4 py-2 leading-none text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600">{{ __('Update') }}</button>
                        @endif
                        <button wire:click="hide"
                            class="inline-block px-4 py-2 leading-none text-gray-600 hover:text-gray-800 focus:outline-none">Close</button>
                    </div>
                </form>
            </x-slot>
        </x-modal>

        <!-- Popup Modal -->

    @endif

    </div>
</div>
