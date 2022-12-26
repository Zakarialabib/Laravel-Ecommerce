<div>
    <x-modal wire:model="imageModal">
        <x-slot name="title">
            {{ __('Image Management') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="saveImage">
                <div class="flex flex-wrap">

                    <div class="w-full px-4 my-2">
                        {{-- import with url --}}
                        <x-label for="image" :value="__('Upload with url')" />
                        <x-input id="image_url" class="block mt-1 w-full" type="text" name="image_url"
                        wire:model="image_url" />
                    </div>    
                    <div class="w-full px-4 my-2">
                        <x-label for="video" :value="__('Embeded Video')" />
                        <textarea id="embeded_video" class="block mt-1 w-full" type="text"
                        name="embeded_video" wire:model="product.embeded_video">
                        </textarea>
                        <x-input-error :messages="$errors->get('product.embeded_video')" for="product.embeded_video" class="mt-2" />
                    </div>
                    <div class="w-full px-4 my-2">
                        <x-label for="image" :value="__('Product Image')" />
                        <x-media-upload 
                        title="{{ __('Product Image') }}" 
                        name="image" 
                        wire:model="image" 
                        :file="$image"
                        :preview="$this->imagepreview"
                        single
                        types="PNG / JPEG / WEBP"
                        fileTypes="image/*"  />
                    </div>


                    <div class="w-full px-4 my-2">
                        <x-label for="gallery" :value="__('Gallery')" />
                        <x-media-upload 
                        title="{{ __('Gallery') }}" 
                        name="gallery" 
                        wire:model="gallery" 
                        :preview="$this->gallerypreview"
                        :file="$gallery"
                        multiple 
                        types="PNG / JPEG / WEBP"
                        fileTypes="image/*"  />
                    </div>
                </div>
                <div class="w-full px-4">
                    <x-button primary type="button" 
                     wire:click="saveImage" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>

        </x-slot>
    </x-modal>

</div>
