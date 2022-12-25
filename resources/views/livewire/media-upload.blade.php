
<div>
    <label class="block mt-4 text-sm">
        <div
            class="w-full p-2 bg-gray-100 border border-zinc-300 border-dashed rounded"
            x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

            {{-- Form File picker --}}
            <input type="file" class="hidden" accept="{{ $rules ?? '' }}" {{ ($multiple ?? false) ? 'multiple':'' }} 
                            wire:model='{{ $attributes->wire('model')->value }}'
            />

            @if ($multiple)
                @foreach ($photos as $photo)
                    <div class="flex items-center space-x-4">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20">
                        <div class="font-light text-gray-500">
                            <p>Type: {{ Str::upper($photo->extension()) }}</p>
                            {{-- <p>Size: {{ $photo->size() }} MB</p> --}}
                            <button wire:click="removePhoto({{ $loop->index }})" class="px-2 mt-2 text-xs text-red-400 border border-red-400 rounded">
                                {{__('Remove')}}
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex items-center space-x-4">
                    <img src="{{ $photos->temporaryUrl() }}" class="w-20 h-20">
                    <div class="font-light text-gray-500">
                        <p>Type: {{ Str::upper($photos->extension()) }}</p>
                        {{-- <p>Size: {{ $photos->size() }} MB</p> --}}
                    </div>
                </div>
            @endif

            @if ( !empty($preview) )

            <div class="flex items-center space-x-4">
                <img src="{{ $preview }}" class="w-20 h-20">
                <div class="font-light text-gray-500">
                    <div class="px-2 mt-2 text-xs border rounded text-primary-400 border-primary-400">
                        {{__('Change')}}
                    </div>
                </div>
            </div>

        @else

            {{-- empty state --}}
            <div class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden
            border-2 w-full pl-3 pr-4 py-2 border-dashed">
            <p class="flex items-center text-sm font-light text-gray-400">
                <i class="fa fa-upload w-6 h-6 p-1 mr-3 text-gray-500 border rounded-full shadow "></i>
                {{ __('Upload a file or drag and drop') }} | {{ $types ?? 'Any File' }}
            </p>
            </div>

        @endif

            {{-- during upload --}}
            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress" class="w-full h-1 overflow-hidden bg-red-500 rounded"></progress>
            </div>
        </div>
        @error('photos')
            <span class="mt-1 text-xs text-red-700">{{ $message }}</span>
        @enderror
    </label>
</div>
