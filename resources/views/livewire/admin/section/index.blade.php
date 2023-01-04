<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>

                @if ($this->selectedCount)
                    <p class="text-sm leading-5">
                        <span class="font-medium">
                            {{ $this->selectedCount }}
                        </span>
                        {{ __('Entries selected') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            <x-table.th>
                {{ __('Title') }}
            </x-table.th>
            <x-table.th>
                {{ __('Page') }}
            </x-table.th>
            <x-table.th>
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($sections as $section)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $section->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $section->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        @if ($section->page == \App\Models\Section::ABOUT_PAGE)
                            <a href="{{ route('front.about') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('About') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::HOME_PAGE)
                            <a href="{{ route('front.index') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Home') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::BRAND_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Brand') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::BLOG_PAGE)
                            <a href="{{ route('front.blogs') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Blog') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::CATALOG_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Catalog') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::BRANDS_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Brands') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::PRODUCT_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Products') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::CONTACT_PAGE)
                            <a href="{{ route('front.contact') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Contact') }}
                            </a>
                        @endif
                    </x-table.td>
                    <x-table.td>
                        {{ $section->title }}
                    </x-table.td>

                    <x-table.td>
                        <livewire:toggle-button :model="$section" field="status" key="{{ $section->id }}" />
                    </x-table.td>
                    <x-table.td>
                        <div class="inline-flex">
                            <x-button info type="button" wire:click="$emit('editModal', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button" wire:click="confirm('delete', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-trash-alt"></i>
                            </x-button>
                            <x-button warning type="button" wire:click="confirm('clone', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Clone') }}
                            </x-button>
                        </div>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <div class="card-body">
        <div class="pt-3">
            {{ $sections->links() }}
        </div>
    </div>

    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Slider') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form enctype="multipart/form-data" wire:submit.prevent="submit">
                <div class="flex flex-wrap">
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
                    <div class="float-right p-2 mb-4">
                        <x-button type="submit" primary>
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <livewire:admin.section.create />
</div>
