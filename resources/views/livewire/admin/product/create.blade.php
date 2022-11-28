<div>
    <!-- Create Modal -->
    <x-modal wire:model="createProduct">
        <x-slot name="title">
            {{ __('Create Product') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="create">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="name" :value="__('Product Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model="product.name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="code" :value="__('Product Code')" required />
                            <x-input id="code" class="block mt-1 w-full" type="text" name="code"
                                wire:model="product.code" disabled required />
                            <x-input-error :messages="$errors->get('code')" for="code" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full px-3 mb-6 lg:mb-0">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.rich-text wire:model.lazy="product.description" id="description" />
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="category_id" :value="__('Category')" required />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model="product.category_id"
                                :options="$this->listsForFields['categories']" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="subcategory" :value="__('Subcategory')" />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="subcategory_id" name="subcategory_id" wire:model="product.subcategory_id"
                                :options="$this->listsForFields['subcategories']" />
                            <x-input-error :messages="$errors->get('subcategory_id')" for="subcategory_id" class="mt-2" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model="product.price" required />
                            <x-input-error :messages="$errors->get('price')" for="price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="old_price" :value="__('Old Price')" required />
                            <x-input id="old_price" class="block mt-1 w-full" type="number" name="old_price"
                                wire:model="product.old_price" required />
                            <x-input-error :messages="$errors->get('old_price')" for="old_price" class="mt-2" />

                        </div>

                        <div class="lg:w-1/3 sm:w-1/2 px-2">
                            <x-label for="brand_id" :value="__('Brand')" />
                            <x-select-list
                                class="block bg-white dark:bg-dark-eval-2 text-gray-700 dark:text-gray-300 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="brand_id" name="brand_id" wire:model="product.brand_id" :options="$this->listsForFields['brands']" />
                        </div>

                    </div>

                    <x-accordion title="{{ 'More Details' }}">
                        <div class="flex flex-wrap -mx-2 mb-3">

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_title" :value="__('Meta Title')" />
                                <x-input id="meta_title" class="block mt-1 w-full" type="number" name="meta_title"
                                    wire:model="product.meta_title" />
                                <x-input-error :messages="$errors->get('meta_title')" for="meta_title" class="mt-2" />

                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_description" :value="__('Meta Description')" />
                                <x-input id="meta_description" class="block mt-1 w-full" type="number"
                                    name="meta_description" wire:model="product.meta_description" />
                                <x-input-error :messages="$errors->get('meta_description')" for="meta_description" class="mt-2" />

                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_keywords" :value="__('Meta Keywords')" />
                                <x-input id="meta_keywords" class="block mt-1 w-full" type="number"
                                    name="meta_keywords" wire:model="product.meta_keywords" />
                                <x-input-error :messages="$errors->get('meta_keywords')" for="meta_keywords" class="mt-2" />
                            </div>
                        </div>

                    </x-accordion>



                    <div class="w-full px-4 my-4">
                        <x-label for="image" :value="__('Product Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>

                    <div class="w-full px-4 my-4">
                        <x-label for="gallery" :value="__('Product Gallery')" />
                        <x-fileupload wire:model="gallery" :file="$gallery"
                            accept="image/jpg,image/jpeg,image/png" multiple />
                        <x-input-error :messages="$errors->get('gallery')" for="gallery" class="mt-2" />
                    </div>

                    <div class="flex justify-content w-full px-4">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="blockk">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
