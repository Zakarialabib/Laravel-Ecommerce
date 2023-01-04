<div>
    <!-- Create Modal -->
    <x-modal wire:model="createSlider">
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
                        <x-label for="language_id" :value="__('Language')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="slider.language_id">
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
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
                        <x-input.textarea wire:model.lazy="slider.details" id="details" />
                        <x-input-error :messages="$errors->get('slider.details')" for="slider.details" class="mt-2" />
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

                    <div class="w-full px-3">
                        <x-label for="video" :value="__('Embeded Video')" />
                        <x-input id="embeded_video" class="block mt-1 w-full" type="text" name="embeded_video"
                            wire:model="slider.embeded_video" />
                        <x-input-error :messages="$errors->get('slider.embeded_video')" for="slider.link" class="mt-2" />
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="photo" :value="__('Image')" />
                        <x-fileupload wire:model="photo" :file="$photo" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('photo')" for="photo" class="mt-2" />
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
