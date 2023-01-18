<div>
    <h3 class="mb-6 text-xl text-white font-bold font-heading">{{ __('Join our Newsletter') }}</h3>
    <form wire:submit.prevent="subscribe">
        <div class="mb-6 relative lg:max-w-xl lg:mx-auto bg-white rounded-lg">
            <div class="relative flex flex-wrap items-center justify-between">
                <div class="relative flex-1">
                    <span
                        class="absolute top-0 left-0 ml-8 mt-4 font-semibold font-heading text-xs text-gray-400">{{ __('Drop your e-mail') }}</span>
                    <input wire:model="email" type="email" name="email"
                        class="inline-block w-full pt-8 pb-4 px-8 placeholder-gray-900 border-0 focus:ring-transparent focus:outline-none rounded-md">
                </div>
                <a class="inline-block w-auto hover:bg-red-600 text-white font-bold font-heading py-6 px-8 rounded-md uppercase text-center bg-red-600"
                    wire:click="subscribe">
                    {{ __('Join') }}
                </a>
            </div>
        </div>
    </form>
</div>
