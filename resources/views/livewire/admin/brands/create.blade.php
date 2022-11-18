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
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="brand.name" />
                        <x-input-error :messages="$errors->get('brand.name')" for="brand.name" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                            wire:model.defer="brand.slug" />
                        <x-input-error :messages="$errors->get('brand.slug')" for="brand.slug" class="mt-2" />
                    </div>
                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>
                    <div class="w-full py-2 px-3">
                        <x-label for="featured_image" :value="__('Featured image')" />
                        <x-fileupload wire:model="featured_image" :file="$featured_image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('featured_image')" for="featured_image" class="mt-2" />
                    </div>
                    <div class="w-full flex justify-start space-x-2">
                        <x-button primary <x-button primary type="button" 
                         wire:click="create" wire:loading.attr="disabled">
                            {{ __('Create') }}
                        </x-button>
                        <span class="sr-only" wire:loading wire:target="create">
                            {{ __('Creating...') }}
                        </span>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
