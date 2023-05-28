<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Brand') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap space-y-2 px-2">

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="brand.name" />
                        <x-input-error :messages="$errors->get('brand.name')" for="brand.name" class="mt-2" />
                    </div>

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                            wire:model.lazy="brand.slug" />
                        <x-input-error :messages="$errors->get('brand.slug')" for="brand.slug" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="origin" :value="__('Origin')" />
                        <x-input id="origin" class="block mt-1 w-full" type="text" name="origin"
                            wire:model.lazy="brand.origin" />
                        <x-input-error :messages="$errors->get('brand.origin')" for="brand.origin" class="mt-2" />
                    </div>
                    <div class="w-full px-3">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.textarea wire:model.lazy="brand.description" id="description" />
                        <x-input-error :messages="$errors->get('brand.description')" for="brand.description" class="mt-2" />
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="Brand Logo" :value="__('Brand Logo')" />
                        <x-media-upload title="{{ __('Brand Logo') }}" name="image" wire:model="image"
                                :file="$image" :preview="$this->imagepreview" single types="PNG / JPEG / WEBP"
                                fileTypes="image/*" />
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="Brand Logo" :value="__('Featured image')" />
                        <x-media-upload title="{{ __('Featured Image') }}" name="featured_image"
                             :file="$featured_image" :preview="$this->featuredimagepreview" single types="PNG / JPEG / WEBP"
                            fileTypes="image/*" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
