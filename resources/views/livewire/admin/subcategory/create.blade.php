<div>
    <!-- Create Modal -->
    <x-modal wire:model="createSubcategory">
        <x-slot name="title">
            {{ __('Create Subcategory') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="mt-4 p w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="subcategory.name" />
                        <x-input-error :messages="$errors->get('subcategory.name')" for="subcategory.name" class="mt-2" />
                    </div>

                    <div class="mt-4 p w-full">
                        <x-label for="category_id" :value="__('Category')" required />
                            <x-select-list
                                class="block bg-white text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" multiple wire:model="subcategory.category_id"
                                :options="$this->listsForFields['categories']" />
                        <x-input-error :messages="$errors->get('subcategory.category_id')" for="subcategory.category_id"
                            class="mt-2" />
                    </div>

                    <div class="mt-4 p w-full">
                        <x-label for="language_id" :value="__('Language')" required />
                        <x-select-list
                            class="block bg-white text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="subcategory.language_id"
                            :options="$this->listsForFields['languages']" />
                        <x-input-error :messages="$errors->get('subcategory.language_id')" for="subcategory.language_id"
                            class="mt-2" />
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
