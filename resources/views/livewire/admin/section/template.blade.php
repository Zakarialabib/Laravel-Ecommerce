<div>
    <x-modal wire:model="createTemplate">
        <x-slot name="title">
            {{ __('Create from template') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4 px-4 flex justify-center">
                <!-- Template selection interface here -->
                <select wire:model="selectTemplate">
                    <option value="">{{ __('Select a template') }}</option>
                    @foreach ($templates as $key => $template)
                        <option value="{{ $key }}">{{ $template['title'] }}</option>
                    @endforeach
                </select>
            </div>
            @if ($selectedTemplate)
                <form wire:submit.prevent="create" class="w-full">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="flex flex-wrap space-y-2">
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="title" :value="__('Title')" />
                            <x-input wire:model="selectedTemplate.title" type="text" />
                        </div>
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="subtitle" :value="__('Subtitle')" />
                            <x-input wire:model="selectedTemplate.subtitle" type="text" />
                        </div>
                        <div class="w-full px-2">
                            <x-label for="description" :value="__('Description')" />
                            <x-input.textarea wire:model="selectedTemplate.description" id="description" />
                            <x-input-error :messages="$errors->get('selectedTemplate.description')" for="selectedTemplate.description" class="mt-2" />
                        </div>
                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="bg_color" :value="__('Background Color')" />
                            <input id="bg_color" class="block mt-1 w-full" type="color" name="bg_color"
                                wire:model.defer="selectedTemplate.bg_color" />
                            <x-input-error :messages="$errors->get('selectedTemplate.bg_color')" for="selectedTemplate.bg_color" class="mt-2" />
                        </div>
    
                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="link" :value="__('Link')" />
                            <x-input id="link" class="block mt-1 w-full" type="text" name="link"
                                wire:model.defer="selectedTemplate.link" />
                            <x-input-error :messages="$errors->get('selectedTemplate.link')" for="selectedTemplate.link" class="mt-2" />
                        </div>

                        {{-- <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="language_id" :value="__('Language')" />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="language_id" name="language_id" wire:model="selectedTemplate.language_id">
                                @foreach ($this->languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('selectedTemplate.language_id')" for="selectedTemplate.language_id" class="mt-2" />
                        </div> --}}
    
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="page" :value="__('Page')" />
                            <select wire:model="selectedTemplate.page"
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
                            <x-input-error :messages="$errors->get('selectedTemplate.page')" for="selectedTemplate.page" class="mt-2" />
                        </div>
    
                        <div class="w-full py-4 px-2">
                            <x-label for="image" :value="__('Image')" />
                            <x-input type="file" wire:model="selectedTemplate.image" id="image" />
                            <p class="help-block text-info">
                                {{ __('Upload 670X418 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                            </p>
                            <x-input-error :messages="$errors->get('selectedTemplate.image')" for="selectedTemplate.image" class="mt-2" />
                        </div>
                    </div>
                    <x-button primary class="w-full" type="submit">{{ __('Create') }}</x-button>
                </form>
            @endif
        </x-slot>
    </x-modal>
</div>
