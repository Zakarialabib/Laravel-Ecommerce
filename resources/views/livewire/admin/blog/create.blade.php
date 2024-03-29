<div>
    <!-- Create Modal -->
    <x-modal wire:model="createBlog">
        <x-slot name="title">
            {{ __('Create Blog') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="title" :value="__('Name')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.lazy="blog.title" />
                        <x-input-error :messages="$errors->get('blog.title')" for="blog.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="category_id" :value="__('Category')" required />
                        <x-select-list
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model.lazy="blog.category_id" :options="$this->listsForFields['categories']" />
                        <x-input-error :messages="$errors->get('blog.category_id')" for="blog.category_id" class="mt-2" />
                    </div>

                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="language_id" :value="__('Language')" required />
                        <x-select-list
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model.lazy="blog.language_id" :options="$this->listsForFields['languages']" />
                        <x-input-error :messages="$errors->get('blog.language_id')" for="blog.language_id" class="mt-2" />
                    </div>

                    <div class="w-full px-3 mb-4">
                        <x-label for="details" :value="__('Description')" required />
                        <x-input.rich-text 
                            wire:model="blog.details" 
                            id="details"
                            name="details"
                            endpoint="/uploads"
                            placeholder="Content here..." />

                    </div>

                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="meta_title" :value="__('Meta title')" />
                        <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                            wire:model.lazy="blog.meta_title" />
                        <x-input-error :messages="$errors->get('blog.meta_title')" for="blog.meta_title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="meta_desc" :value="__('Meta Description')" />
                        <x-input id="meta_desc" class="block mt-1 w-full" type="text" name="meta_desc"
                            wire:model.lazy="blog.meta_desc" />
                        <x-input-error :messages="$errors->get('blog.meta_desc')" for="blog.meta_desc" class="mt-2" />
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
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
