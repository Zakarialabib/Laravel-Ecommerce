@props(['file' => null, 'multiple' => false, 'single' => false, 'preview' => null])

<div>
    <label class="block mt-4 text-sm">
        <div class="w-full p-2 bg-gray-100 border border-zinc-300 border-dashed rounded" x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

            <input type="file" class="hidden" accept="{{ $rules ?? '' }}" {{ $multiple ?? false ? 'multiple' : '' }}
                name="{{ $attributes->wire('model')->value }}" {{ $attributes->wire('model') }} />

            @if ($multiple)
                <!-- Multiple Media Uploader Component -->
                @if (is_array($file) && count($file) > 0)
                    @foreach ($file as $tempFile)
                        <div class="flex items-center space-x-4 py-2">
                            <img src="{{ $tempFile->temporaryUrl() }}" class="w-20 h-20">
                            <div class="font-light text-gray-500">
                                <p>Type: {{ Str::upper($tempFile->extension()) }}</p>
                                <p>Filename: {{ $tempFile->getClientOriginalName() }}</p>
                                <button wire:key="remove-preview-{{ $tempFile->getClientOriginalName() }}"
                                    wire:loading.attr="disabled" type="button"
                                    x-on:click.prevent="$wire.removeFileFromArray('{{ $tempFile->getClientOriginalName() }}', true)"
                                    class="px-2 mt-2 text-xs text-red-400 border border-red-400 rounded">
                                    {{ __('Remove') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($preview)
                @if (is_array($file) && count($file) > 0)
                    @foreach ($file as $photo)
                        <div class="flex items-center space-x-4 py-2">
                            <img src="{{ asset('images/products/' . $photo) }}" class="w-20 h-20">
                            <div class="font-light text-gray-500">
                                <p>Filename: {{ $photo }}</p>
                                <button wire:key="remove-{{ $photo }}" wire:loading.attr="disabled"
                                    type="button"
                                    x-on:click.prevent="$wire.removeUpload('{{ $attributes->wire('model')->value }}', '{{ $photo }}')"
                                    class="px-2 mt-2 text-xs text-red-400 border border-red-400 rounded">
                                    {{ __('Remove') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @endif
                    <div
                        class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed">
                        <p class="flex items-center text-sm font-light text-gray-400">
                            <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                            {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                        </p>
                    </div>
                @endif
                <div
                    class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed">
                    <p class="flex items-center text-sm font-light text-gray-400">
                        <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                        {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                    </p>
                </div>
            @elseif($single)
                @if (collect(['jpg', 'png', 'jpeg', 'webp'])->contains($file))
                    <div class="flex items-center space-x-4">
                        <img src="{{ $file->temporaryUrl() ?? '' }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            {{-- <p>{{ __('Type') }}: {{ Str::upper($photoInfo['extension']) }}</p>
                        <p>{{ __('Size') }}: {{ $photoInfo['size'] }} MB</p> --}}
                            <button type="button" wire:click="$set('{{ $name }}')"
                                class="px-2 mt-2 text-xs text-red-400 border border-red-400 rounded">
                                {{ __('Remove') }}
                            </button>
                        </div>
                    </div>
                @endif

                @if ($preview)
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/products/' . $preview) }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            <p>Filename: {{ $file }}</p>
                        </div>
                        <div
                            class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed">
                            <p class="flex items-center text-sm font-light text-gray-400">
                                <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                                {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                            </p>
                        </div>
                    </div>
                @else
                    <div
                        class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed">
                        <p class="flex items-center text-sm font-light text-gray-400">
                            <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                            {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                        </p>
                    </div>
                @endif
            @endif

            <div wire:loading.delay wire:loading.flex wire:target="removeUpload" wire:loading.class="w-full">
                <div class="text-sm text-red-500 bg-red-100 flex-1 p-1 text-center rounded">
                    {{ __('Removing file...') }}
                </div>
            </div>
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"
                    class="w-full h-1 overflow-hidden bg-red-500 rounded"></progress>
            </div>
        </div>
        @error($attributes->wire('model')->value)
            <span class="mt-1 text-xs text-red-700">{{ $message }}</span>
        @enderror
    </label>
</div>
