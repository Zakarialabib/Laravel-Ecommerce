{{-- overlay when page loaded alpine & tailwind --}}

<div class="fixed inset-0 z-50 overflow-hidden" x-show="loading" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                <div class="px-4 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-heading">
                        Loading...
                    </h2>
                </div>
                <div class="mt-6 relative flex-1 px-4 sm:px-6">
                    <div class="absolute inset-0 px-4 sm:px-6">
                        <div class="h-full border-2 border-dashed border-gray-200" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
