<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class="py-10" enctype="multipart/form-data" wire:submit.prevent="submit">
        <div class="lg:w-1/2 sm:w-full">
            <x-label for="language_id" :value="__('Language')" />
            <select wire:model="section.language_id"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                name="language_id">
                <option value="" selected>{{ __('Select a Language') }}</option>
                @foreach ($langs as $lang)
                    <option value="{{ $lang->id }}">
                        {{ $lang->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error for="section.language_id" />
        </div>
        <div class="lg:w-1/2 sm:w-full">
            <x-label for="page" :value="__('Page')" />
            <select wire:model="section.page"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                name="page">
                <option value="" selected>{{ __('Select a Page') }}</option>
                <option value="1">{{ __('Home Page') }}</option>
                <option value="2">{{ __('About Page') }}</option>
                <option value="3">{{ __('Partner Page') }}</option>
                <option value="4">{{ __('Blog Page') }}</option>
                <option value="5">{{ __('Service Page') }}</option>
                <option value="7">{{ __('Contact Page') }}</option>
                <option value="8">{{ __('Products Page') }}</option>
                <option value="9">{{ __('Privacy Page') }}</option>
            </select>
            <x-input-error for="section.page" />
        </div>

        
        <div class="w-full">
            <x-label for="title" :value="__('Title')" />
            <input type="text" name="title" wire:model.lazy="section.title"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                placeholder="{{ __('Title') }}" value="{{ old('title') }}">
            <x-input-error for="section.title" />
        </div>
        <div class="w-full">
            <x-label for="subtitle" :value="__('Subtitle')" />
            <input type="text" name="subtitle" wire:model.lazy="section.subtitle"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                placeholder="{{ __('Subtitle') }}" value="{{ old('subtitle') }}">
            <x-input-error for="section.subtitle" />
        </div>
        <div class="w-full">
            <x-label for="custom_html_1" :value="__('Custom html')" />
            <textarea type="text" name="custom_html_1" wire:model.lazy="section.custom_html_1"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                placeholder="{{ __('Custom html') }}" >
                </textarea>
            <x-input-error for="section.custom_html_1" />
        </div>
        <div class="w-full">
            <x-label for="content" :value="__('Description')" />
            <x-input.rich-text wire:model.lazy="section.content" id="description" />
            <x-input-error for="section.content" />
        </div>
        <div class="w-full">
            <x-label for="image" :value="__('Image')" />
            <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
            <p class="help-block text-info">
                {{ __('Upload 670X418 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
            </p>
            <x-input-error for="section.image" />
        </div>
        <div class="w-full">
            <x-label for="video" :value="__('Video')" />
            <input type="text" name="video" wire:model.lazy="section.video"
                class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 "
                placeholder="{{ __('Video') }}" value="{{ old('video') }}">
            <x-input-error for="section.video" />
        </div>
        <input wire:model="section.status" value="1" >  
        <div class="w-full">
            <button type="submit"
                class="leading-4 md:text-sm sm:text-xs bg-green-500 text-white hover:text-green-800 hover:bg-green-100 active:bg-green-200 focus:ring-green-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-center">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
     <!-- Image Upload -->
     <script type="text/javascript"  src="{{ asset('js/image-upload.js') }}"></script>
@endpush