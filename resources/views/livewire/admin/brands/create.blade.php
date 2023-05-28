<div>
    <!-- Create Modal -->
    <x-modal wire:model="createBrand">
        <x-slot name="title">
            {{ __('Create Brand') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap space-y-2 px-2">
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="brand.name" />
                        <x-input-error :messages="$errors->get('brand.name')" for="brand.name" class="mt-2" />
                    </div>

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="origin" :value="__('Origin')" />
                        <x-input id="origin" class="block mt-1 w-full" type="text" name="origin"
                            wire:model.lazy="brand.origin" />
                        <x-input-error :messages="$errors->get('brand.origin')" for="brand.origin" class="mt-2" />
                    </div>
                    
                    <div class="w-full px-2">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.textarea wire:model.lazy="brand.description" id="description" />
                        <x-input-error :messages="$errors->get('brand.description')" for="brand.description" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="image" :value="__('Brand Logo')" />
                        <x-media-upload title="{{ __('Brand Logo') }}" name="image" wire:model="image" :file="$image"
                            single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="featured_image" :value="__('Featured image')" />
                        <x-media-upload title="{{ __('Featured Image') }}" name="featured_image"
                            wire:model="featured_image" :file="$featured_image" single types="PNG / JPEG / WEBP"
                            fileTypes="image/*" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
