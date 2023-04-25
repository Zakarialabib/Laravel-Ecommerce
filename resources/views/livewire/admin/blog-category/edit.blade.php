<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Blog Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.defer="blogcategory.title" />
                        <x-input-error :messages="$errors->get('blogcategory.title')" for="blogcategory.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="description" :value="__('Description')" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                            wire:model.defer="blogcategory.description" />
                        <x-input-error :messages="$errors->get('blogcategory.description')" for="blogcategory.description" class="mt-2" />
                        </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="meta_title" :value="__('Meta Tag')" />
                        <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                            wire:model.defer="blogcategory.meta_title" />
                        <x-input-error :messages="$errors->get('blogcategory.meta_title')" for="blogcategory.meta_title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="meta_desc" :value="__('Meta Description')" />
                        <x-input id="meta_desc" class="block mt-1 w-full" type="text" name="meta_desc"
                            wire:model.defer="blogcategory.meta_desc" />
                        <x-input-error :messages="$errors->get('blogcategory.meta_desc')" for="blogcategory.meta_desc" class="mt-2" />
                    </div>
                </div>

                <div class="w-full px-3">
                    <x-button primary type="submit" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
