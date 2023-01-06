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
                            <x-label for="slug" :value="__('Slug')" />
                            <x-input wire:model="selectedTemplate.slug" type="text" />
                        </div>
                        <div class="w-full px-2">
                            <x-label for="details" :value="__('Details')" />
                            <x-input.textarea wire:model="selectedTemplate.details" id="details" />
                            <x-input-error :messages="$errors->get('selectedTemplate.details')" for="selectedTemplate.details" class="mt-2" />
                        </div>

                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="meta_title" :value="__('Meta title')" />
                            <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                                wire:model.defer="selectedTemplate.meta_title" />
                            <x-input-error :messages="$errors->get('selectedTemplate.meta_title')" for="selectedTemplate.meta_title" class="mt-2" />
                        </div>
                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="meta_description" :value="__('Meta description')" />
                            <x-input id="meta_description" class="block mt-1 w-full" type="text"
                                name="meta_description" wire:model.defer="selectedTemplate.meta_description" />
                            <x-input-error :messages="$errors->get('selectedTemplate.meta_description')" for="selectedTemplate.meta_description" class="mt-2" />
                        </div>

                    </div>
                    <x-button primary class="w-full" type="submit">{{ __('Create') }}</x-button>
                </form>
            @endif
        </x-slot>
    </x-modal>
</div>
