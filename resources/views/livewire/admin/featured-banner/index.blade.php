<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
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
                {{ __('Image') }}
            </x-table.th>
            <x-table.th>
                {{ __('Title') }}
            </x-table.th>
            <x-table.th>
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Featured') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($featuredbanners as $featuredbanner)
                <x-table.tr>
                    <x-table.td>
                        {{-- {{ $id }} --}}
                    </x-table.td>
                    <x-table.td>
                        @if ($featuredbanner->image)
                            <img src="{{ asset('images/featuredbanners/' . $featuredbanner->image) }}"
                                alt="{{ $featuredbanner->title }}" class="w-10 h-10 rounded-full">
                        @else
                            {{ __('No image') }}
                        @endif
                    </x-table.td>
                    <x-table.td>
                        {{ $featuredbanner->title }}
                    </x-table.td>
                    <x-table.td>
                        @if (\App\Models\FeaturedBanner::StatusInactive)
                            <x-badge danger>
                                {{ __('Inactive') }}
                            </x-badge>
                        @elseif(\App\Models\FeaturedBanner::StatusActive)
                            <x-badge info>
                                {{ __('Active') }}
                            </x-badge>
                        @endif
                    </x-table.td>
                    <x-table.td>
                        @if ($featuredbanner['featured'] == false)
                            <a class="btn btn-sm bg-green-500 text-white" title="{{ __('Set as featured') }}"
                                wire:click="setFeatured( {{ $featuredbanner['id'] }} )">
                                {{ __('Set as featured') }}
                            </a>
                        @endif
                    </x-table.td>
                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button primary type="button" wire:click="$emit('editModal', {{ $featuredbanner->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button"
                                wire:click="$emit('deleteModal', {{ $featuredbanner->id }})"
                                wire:loading.attr="disabled">
                                <i class="fas fa-trash-alt"></i>
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
            {{ $featuredbanners->links() }}
        </div>
    </div>

    <div>
        <!-- Edit Modal -->
        <x-modal wire:model="editModal">
            <x-slot name="title">
                {{ __('Update FeaturedBanner') }}
            </x-slot>

            <x-slot name="content">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form wire:submit.prevent="update">
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
                                id="language_id" name="language_id" wire:model.defer="featuredbanner.language_id"
                                :options="$this->listsForFields['languages']" />
                            <x-input-error :messages="$errors->get('featuredbanner.language_id')" for="featuredbanner.language_id" class="mt-2" />
                        </div>
                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="product_id" :value="__('Product')" />
                            <x-select-list
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="product_id" name="product_id" wire:model.defer="featuredbanner.product_id"
                                :options="$this->listsForFields['products']" />
                            <x-input-error :messages="$errors->get('featuredbanner.product_id')" for="featuredbanner.product_id" class="mt-2" />
                        </div>

                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="details" :value="__('Details')" />
                            <x-input id="details" class="block mt-1 w-full" type="text" name="details"
                                wire:model.defer="featuredbanner.details" />
                            <x-input-error :messages="$errors->get('featuredbanner.details')" for="featuredbanner.details" class="mt-2" />
                        </div>
                        <div class="xl:w-1/2 md:w-1/2 px-3">
                            <x-label for="link" :value="__('Link')" />
                            <x-input id="link" class="block mt-1 w-full" type="text" name="link"
                                wire:model.defer="featuredbanner.link" />
                            <x-input-error :messages="$errors->get('featuredbanner.link')" for="featuredbanner.link" class="mt-2" />
                        </div>

                        <div class="w-full px-3">
                            <x-label for="video" :value="__('Embeded Video')" />
                            <x-input id="embeded_video" class="block mt-1 w-full" type="text" name="embeded_video"
                                wire:model="featuredbanner.embeded_video" />
                            <x-input-error :messages="$errors->get('featuredbanner.embeded_video')" for="featuredbanner.embeded_video" class="mt-2" />
                        </div>

                        <div class="w-full py-2 px-3">
                            <x-label for="image" :value="__('Image')" />
                            <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                            <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                        </div>
                        <div class="w-full px-3">
                            <x-button primary class="block" type="submit" wire:loading.attr="disabled">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </x-slot>
        </x-modal>
        <!-- End Edit Modal -->
    </div>

    <livewire:admin.featured-banner.create />

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('deleteModal', featuredbannerId => {
                Swal.fire({
                    title: __("Are you sure?") ,
                    text: __("You won't be able to revert this!") ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: __("Yes, delete it!") 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', featuredbannerId)
                    }
                })
            })
        })
    </script>
@endpush
