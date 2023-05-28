@section('title', __('My Account'))
<x-app-layout>
    <section class="py-5 px-4 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4 mb-10 items-center justify-between bg-gray-100 py-5">
                <div class="w-full lg:w-auto px-4 mb-4">
                    <h2 class="text-5xl text-center font-bold font-heading">
                        {{ __('My Account') }}
                    </h2>
                </div>
                <div>
                    @livewire('front.account')
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
