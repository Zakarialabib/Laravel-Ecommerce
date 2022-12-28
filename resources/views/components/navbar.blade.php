<nav aria-label="secondary" x-data="{ open: false }"
    class="sticky top-0 z-10 flex items-center justify-between px-4 py-4 transition-transform duration-500 bg-gray-100"
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">

    <div class="flex items-center gap-3">
        <x-button type="button" iconOnly secondary srText="Open main menu" @click="isSidebarOpen = !isSidebarOpen">
            <x-icons.menu x-show="!isSidebarOpen" aria-hidden="true" class="w-5 h-5" />
            <x-icons.x x-show="isSidebarOpen" aria-hidden="true" class="w-5 h-5" />
        </x-button>
    </div>

    <div class="flex items-center gap-3">
        <div class="md:flex hidden flex-wrap items-center">
            <x-button type="button" secondary id="fullScreen">
                <i class="fa fa-expand w-4 h-4"></i>
            </x-button>
        </div>

        <x-language-dropdown />

        <ul class="flex-col md:flex-row list-none items-center md:flex">
            <x-dropdown align="right" width="60">
                <x-slot name="trigger">
                    <x-button type="button" primary>
                        {{ Auth::user()->first_name }}
                    </x-button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('admin.settings')">
                        {{ __('Settings') }}
                    </x-dropdown-link>

                    <x-dropdown-link>
                        @livewire('admin.cache')
                    </x-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </ul>
    </div>
</nav>


@push('scripts')
<script>

    function toggleFullscreen(elem) {
        elem = elem || document.documentElement;
        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    if(('#fullScreen').length > 0) {
       document.getElementById('fullScreen').addEventListener('click', function() {
           toggleFullscreen();
        });
    }

</script>
@endpush