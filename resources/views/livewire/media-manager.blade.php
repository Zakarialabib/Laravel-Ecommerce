<div>
    <x-modal wire:model="mediamanager">
        <x-slot name="title">{{__('Media Manager')}}</x-slot>

        <x-slot name="content">
            <div>
                @if($file)
                    <x-file-detail :file="$file"/>
                @else
                    <div class="lg:hidden">
                        <label for="tabs" class="sr-only">{{__('Select a tab')}}</label>
                        <select id="tabs" name="tabs" class="block w-full focus:ring-gray-500 focus:border-gray-500 border-gray-300 rounded-md">
                            <option selected>{{__('Upload')}}</option>
                            <option>{{__('Media')}}</option>
                        </select>
                        {{-- <x-input.select wire:model="tab" id="tabs" :options="$this->tabOptions" placeholder="Select a tab"/> --}}
                    </div>

                    <div class="pt-4 flex-1 flex items-stretch overflow-hidden lg:space-x-6">
                        <aside class="hidden w-72 bg-white overflow-y-auto lg:block">
                            <nav class="space-y-1" aria-label="Sidebar">
                            <x-sidebar-item key="upload" icon="fa fa-upload" :tab="$tab"/>
                                <x-sidebar-item key="unsplash" icon="fa fa-image" :tab="$tab"/>
                                <x-sidebar-item key="from-url" name="From URL" icon="fa fa-link" :tab="$tab"/>
                            </nav>
                        </aside>

                        <main class="flex-1 overflow-y-auto">
                            <div class="w-full mx-auto">
                                @if ($tab === 'upload')
                                    <x-upload/>
                                @elseif ($tab === 'unsplash')
                                    <x-unsplash/>
                                @elseif ($tab === 'from-url')
                                    <x-from-url/>
                                @endif
                            </div>
                        </main>
                    </div>
                @endif
            </div>
        </x-slot>
    </x-modal>
</div>
