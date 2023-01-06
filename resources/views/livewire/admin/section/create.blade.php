<div>
    <x-modal wire:model="createSection">
        <x-slot name="title">
            {{ __('Create Section') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form enctype="multipart/form-data" wire:submit.prevent="save">
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="language_id" :value="__('Language')" />
                    <select
                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        id="language_id" name="language_id" wire:model="section.language_id">
                        @foreach ($this->languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('section.language_id')" for="section.language_id" class="mt-2" />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="page" :value="__('Page')" />
                    <select wire:model="section.page"
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                        name="page">
                        <option value="" selected>{{ __('Select a Page') }}</option>
                        <option value="1">{{ __('Home Page') }}</option>
                        <option value="2">{{ __('About Page') }}</option>
                        <option value="3">{{ __('Partner Page') }}</option>
                        <option value="4">{{ __('Blog Page') }}</option>
                        <option value="7">{{ __('Contact Page') }}</option>
                        <option value="8">{{ __('Products Page') }}</option>
                        <option value="9">{{ __('Privacy Page') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('section.page')" for="section.page" class="mt-2" />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="language_id" :value="__('Language')" />
                    <select
                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        id="language_id" name="language_id" wire:model="section.language_id">
                        @foreach ($this->languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('section.language_id')" for="section.language_id" class="mt-2" />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="page" :value="__('Page')" />
                    <select wire:model="section.page"
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                        name="page">
                        <option value="" selected>{{ __('Select a Page') }}</option>
                        <option value="1">{{ __('Home Page') }}</option>
                        <option value="2">{{ __('About Page') }}</option>
                        <option value="3">{{ __('Partner Page') }}</option>
                        <option value="4">{{ __('Blog Page') }}</option>
                        <option value="7">{{ __('Contact Page') }}</option>
                        <option value="8">{{ __('Products Page') }}</option>
                        <option value="9">{{ __('Privacy Page') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('section.page')" for="section.page" class="mt-2" />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="title" :value="__('Title')" />
                    <input type="text" name="title" wire:model.lazy="section.title"
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                        placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                    <x-input-error :messages="$errors->get('section.title')" for="section.title" class="mt-2" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="subtitle" :value="__('Subtitle')" />
                    <input type="text" name="subtitle" wire:model.lazy="section.subtitle"
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                        placeholder="{{ __('Subtitle') }}" value="{{ old('subtitle') }}">
                    <x-input-error :messages="$errors->get('section.subtitle')" for="section.subtitle" class="mt-2" />
                </div>

                <div class="w-full px-2">
                    <x-label for="description" :value="__('Description')" />
                    <x-input.textarea wire:model.lazy="section.description" id="description" />
                    <x-input-error :messages="$errors->get('section.description')" for="section.description" class="mt-2" />
                </div>
                <div class="w-full px-2">
                    <x-label for="image" :value="__('Image')" />
                    <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                    <p class="help-block text-info">
                        {{ __('Upload 670X418 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                    </p>
                    <x-input-error :messages="$errors->get('section.image')" for="section.image" class="mt-2" />
                </div>
                <div class="w-full px-2">
                    <x-button type="submit" primary>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
