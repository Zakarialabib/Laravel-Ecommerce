<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold">
        <img class="w-14 h-auto" src="{{ asset('images/' . Helpers::settings('site_logo') ) }}" alt="{{ Helpers::settings('site_title') }}">
        <span class="sr-only">
        {{ Helpers::getSettings('site_title') }}
        </span>
    </a>

    <!-- Toggle button -->
    <x-button type="button" iconOnly srText="Toggle sidebar" secondary
        x-show="isSidebarOpen || isSidebarHovered" @click="isSidebarOpen = !isSidebarOpen">
        <i class="fas fa-chevron-right hidden w-5 h-5 lg:block" x-show="!isSidebarOpen" aria-hidden="true"></i>
        <i class="fas fa-chevron-left hidden w-5 h-5 lg:block" x-show="isSidebarOpen" aria-hidden="true"></i>
    </x-button>
</div>
