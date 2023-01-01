<div>
    <!-- Create Modal -->
    <x-modal wire:model="createFeaturedBanner">
        <x-slot name="title">
            {{ __('Create FeaturedBanner') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.defer="featuredbanner.title" />
                        <x-input-error :messages="$errors->get('featuredbanner.title')" for="featuredbanner.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="language_id" :value="__('Language')" required />
                        <x-select-list
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model.defer="featuredbanner.language_id" :options="$this->listsForFields['languages']" />
                        <x-input-error :messages="$errors->get('featuredbanner.language_id')" for="featuredbanner.language_id" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="product_id" :value="__('Product')" />
                        <x-select-list
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="product_id" name="product_id" wire:model.defer="featuredbanner.product_id" :options="$this->listsForFields['products']" />
                        <x-input-error :messages="$errors->get('featuredbanner.product_id')" for="featuredbanner.product_id" class="mt-2" />
                    </div>
                    
                    <div class="xl:w-1/2 md:w-1/2 px-3">
                        <x-label for="details" :value="__('Details')" />
                        <x-input id="details" class="block mt-1 w-full" type="text" name="details"
                            wire:model.defer="featuredbanner.details" />
                        <x-input-error :messages="$errors->get('featuredbanner.details')" for="featuredbanner.details" class="mt-2" />
                    </div>
                    {{-- if product_id is selected hide link --}}

                    <div class="xl:w-1/2 md:w-1/2 px-3" >
                        <x-label for="link" :value="__('Link')" />
                        <x-input id="link" class="block mt-1 w-full" type="text" name="link"
                            wire:model.defer="featuredbanner.link" />
                        <x-input-error :messages="$errors->get('featuredbanner.link')" for="featuredbanner.link" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
                        <x-label for="video" :value="__('Embeded Video')" />
                        <x-input id="embeded_video" class="block mt-1 w-full" type="text"
                                name="embeded_video" wire:model="featuredbanner.embeded_video" />
                        <x-input-error :messages="$errors->get('featuredbanner.embeded_video')" for="featuredbanner.embeded_video" class="mt-2" />
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>
                    <div class="w-full px-3">
                        <x-button primary class="block" type="submit" ire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
