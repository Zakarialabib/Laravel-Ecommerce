<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black dark:text-zinc-300 mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-500 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    <x-loader />

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            {{-- <x-table.th sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">
                {{ __('Title') }}
                @include('components.table.sort', ['field' => 'title'])
            </x-table.th> --}}
            <x-table.th>
                {{ __('Language') }}
            </x-table.th>
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
                <x-table.tr>
                    <x-table.td>
                        <input type="checkbox" value="{{ $section->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $section->language->name }} <img src="{{ flagImageUrl($section->language->code) }}">
                    </x-table.td>
                    <x-table.td>
                        @if ($section->page == \App\Models\Section::ABOUT_PAGE)
                            <a href="{{ route('front.about') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('About') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::HOME_PAGE)
                            <a href="{{ route('front.home') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Home') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::PARTNERS_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Partner') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::BLOG_PAGE)
                            <a href="{{ route('front.blogs') }}"
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Blog') }}
                            </a>
                        @elseif($section->page == \App\Models\Section::SERVICE_PAGE)
                            <a href=""
                                class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                {{ __('Services') }}
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
                            <a class="font-bold border-transparent uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 ease-linear transition-all duration-150 cursor-pointer text-white bg-green-500 border-green-800 hover:bg-green-600 active:bg-green-700 focus:ring-green-300 mr-2"
                                href="{{ route('admin.sections.edit', $section) }}">
                                {{ __('Edit') }}
                            </a>
                            <button
                                class="font-bold border-transparent uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300 mr-2"
                                type="button" wire:click="confirm('delete', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </button>
                            <button
                                class="font-bold  bg-purple-500 border-purple-800 hover:bg-purple-600 active:bg-purple-700 focus:ring-purple-300 uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md mr-1 ease-linear transition-all duration-150 cursor-pointer text-white"
                                type="button" wire:click="confirm('clone', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Clone') }}
                            </button>
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
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $sections->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
            if (!confirm("{{ __('Are you sure') }}")) {
                return
            }
            @this[e.callback](...e.argv)
        });
    </script>
@endpush
