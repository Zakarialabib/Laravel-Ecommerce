<div>
    <!-- Create Modal -->
    <x-modal wire:model="createPage">
        <x-slot name="title">
            {{ __('Create Page') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input wire:model="page.title" type="text" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input wire:model="page.slug" type="text" />
                    </div>
                    <div class="w-full px-2">
                        <x-label for="details" :value="__('Details')" />
                        <x-input.rich-text wire:model.debounce.2000ms="page.details" id="details" />
                        <x-input-error :messages="$errors->get('page.details')" for="page.details" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="meta_title" :value="__('Meta title')" />
                        <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                            wire:model.defer="page.meta_title" />
                        <x-input-error :messages="$errors->get('page.meta_title')" for="page.meta_title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="meta_description" :value="__('Meta description')" />
                        <x-input id="meta_description" class="block mt-1 w-full" type="text" name="meta_description"
                            wire:model.defer="page.meta_description" />
                        <x-input-error :messages="$errors->get('page.meta_description')" for="page.meta_description" class="mt-2" />
                    </div>
                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>
                    <div class="w-full flex justify-start space-x-2">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
