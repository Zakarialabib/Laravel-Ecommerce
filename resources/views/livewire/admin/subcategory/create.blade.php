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
                <div class="flex flex-wrap space-y-4 px-4">
                    <div class="px-2 w-1/2 sm:w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.defer="subcategory.name" />
                        <x-input-error :messages="$errors->get('subcategory.name')" for="subcategory.name" class="mt-2" />
                    </div>

                    <div class="px-2 w-1/2 sm:w-full">
                        <x-label for="category_id" :value="__('Category')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id"  wire:model="subcategory.category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            <x-input-error :messages="$errors->get('subcategory.category_id')" for="subcategory.category_id" class="mt-2" />
                        </select>
                    </div>

                    <div class="mt-4 px-2 w-1/2 sm:w-full">
                        <x-label for="language_id" :value="__('Language')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="subcategory.language_id">
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('subcategory.language_id')" for="subcategory.language_id" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-button primary type="submit" class="w-full" wire:loading.attr="disabled">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
