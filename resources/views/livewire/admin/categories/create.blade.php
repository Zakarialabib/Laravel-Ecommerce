<div>
    <!-- Create Modal -->
    <x-modal wire:model="createCategory">
        <x-slot name="title">
            {{ __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div>
                    <div class="my-4">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="category.name" />
                        <x-input-error :messages="$errors->get('category.name')" for="category.name" class="mt-2" />
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
