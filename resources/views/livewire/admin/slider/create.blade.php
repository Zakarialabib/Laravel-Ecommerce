<div>
    <!-- Create Modal -->
    <x-modal wire:model="createBrand">
        <x-slot name="title">
            {{ __('Create Slider') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.defer="slider.title" />
                        <x-input-error :messages="$errors->get('slider.title')" for="slider.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="language_id" :value="__('Language')" />
                        <x-input id="language_id" class="block mt-1 w-full" type="text" name="language_id"
                            wire:model.defer="slider.language_id" />
                        <x-input-error :messages="$errors->get('slider.language_id')" for="slider.language_id" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle"
                            wire:model.defer="slider.subtitle" />
                        <x-input-error :messages="$errors->get('slider.subtitle')" for="slider.subtitle" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="details" :value="__('Details')" />
                        <x-input id="details" class="block mt-1 w-full" type="text" name="details"
                            wire:model.defer="slider.details" />
                        <x-input-error :messages="$errors->get('slider.details')" for="slider.details" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="position" :value="__('Position')" />
                        <x-input id="position" class="block mt-1 w-full" type="text" name="position"
                            wire:model.defer="slider.position" />
                        <x-input-error :messages="$errors->get('slider.position')" for="slider.position" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="bg_color" :value="__('Background Color')" />
                        <x-input id="bg_color" class="block mt-1 w-full" type="color" name="bg_color"
                            wire:model.defer="slider.bg_color" />
                        <x-input-error :messages="$errors->get('slider.bg_color')" for="slider.bg_color" class="mt-2" />
                    </div>
                    
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="link" :value="__('Link')" />
                        <x-input id="link" class="block mt-1 w-full" type="text" name="link"
                            wire:model.defer="slider.link" />
                        <x-input-error :messages="$errors->get('slider.link')" for="slider.link" class="mt-2" />
                    </div>
                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>
                    <div class="w-full flex justify-start space-x-2">
                        <x-button primary wire:click="create" wire:loading.attr="disabled">
                            {{ __('Create') }}
                        </x-button>
                        <x-button primary type="button" wire:click="$set('createBrand', false)">
                            {{ __('Cancel') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
