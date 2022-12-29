@props(['file', 'multiple' => false, 'single' => false, 'preview' => false])

<div>
    <label class="block mt-4 text-sm">
        <div class="w-full p-2 bg-gray-100 border border-zinc-300 border-dashed rounded" x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

            <input type="file" class="hidden" accept="{{ $rules ?? '' }}" {{ $multiple ?? false ? 'multiple' : '' }}
                name="{{ $attributes->wire('model')->value }}" {{ $attributes->wire('model') }} />

            @if ($multiple)
                @if($file)
                @foreach ($file as $tempFile)
                    <div class="flex items-center space-x-4 py-2">
                        <img src="{{ $tempFile->temporaryUrl() }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            <p>Type: {{ Str::upper($tempFile->extension()) }}</p>
                            <p>Filename: {{ $tempFile->getClientOriginalName() }}</p>
                        </div>
                    </div>
                @endforeach
                @endif
                @if ($preview)
                    @forelse (json_decode($preview) as $photo)
                        <div class="flex items-center space-x-4 py-2">
                            <img src="{{ asset('images/products/' . $photo) }}" class="w-20 h-20">
                            <div class="font-light text-gray-500">
                                <p>Filename: {{ $photo }}</p>
                            </div>
                        </div>
                    @empty
                        {{ 'No Gallery Images found' }}
                    @endforelse
                @endif
                <div class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed"
                    x-bind:class="{ 'opacity-50': isUploading }">
                    <p class="flex items-center text-sm font-light text-gray-400">
                        <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                        {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                    </p>
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"
                            class="w-full h-1 overflow-hidden bg-red-500 rounded"></progress>
                    </div>
                    <div class="absolute
                                inset-0 h-full flex items-center justify-center pointer-events-none"
                        x-bind:class="{ 'opacity-0': !isUploading, 'opacity-100': isUploading }">
                        <i class="fa fa-spinner fa-spin w-6 h-6 text-gray-500"></i>
                    </div>
                </div>
            @elseif($single)
                @if ($file)
                    <div class="flex items-center space-x-4">
                        <img src="{{ $file->temporaryUrl() ?? '' }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            <p>Type: {{ Str::upper($file->extension()) }}</p>
                            <p>Filename: {{ $file->getClientOriginalName() }}</p>
                        </div>
                    </div>
                @elseif ($preview)
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/products/' . $preview) }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            <p>Filename: {{ $file }}</p>
                        </div>
                        <div class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed"
                            x-bind:class="{ 'opacity-50': isUploading }">
                            <p class="flex items-center text-sm font-light text-gray-400">
                                <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                                {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                            </p>
                            <div class="absolute
                            inset-0 h-full flex items-center justify-center pointer-events-none"
                                x-bind:class="{ 'opacity-0': !isUploading, 'opacity-100': isUploading }">
                                <i class="fa fa-spinner fa-spin w-6 h-6 text-gray-500"></i>
                                <progress max="100" x-bind:value="progress"
                                    class="w-full h-1 overflow-hidden bg-red-500 rounded"></progress>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden border-2 w-full pl-3 pr-4 py-2 border-dashed"
                    x-bind:class="{ 'opacity-50': isUploading }">
                    <p class="flex items-center text-sm font-light text-gray-400">
                        <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                        {{ __('Upload a file or Image') }} | {{ $types ?? 'Any File' }}
                    </p>
                    <div class="absolute
                                inset-0 h-full flex items-center justify-center pointer-events-none"
                        x-bind:class="{ 'opacity-0': !isUploading, 'opacity-100': isUploading }">
                        <i class="fa fa-spinner fa-spin w-6 h-6 text-gray-500"></i>
                        <progress max="100" x-bind:value="progress"
                            class="w-full h-1 overflow-hidden bg-red-500 rounded"></progress>
                    </div>
                </div>
            @endif
        </div>
        @error($attributes->wire('model')->value)
            <span class="mt-1 text-xs text-red-700">{{ $message }}</span>
        @enderror
    </label>
</div>
