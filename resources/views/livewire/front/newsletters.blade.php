<div>
    <h3 class="mb-6 text-xl text-white font-bold font-heading">{{ __('Join our Newsletter') }}</h3>
    <form wire:submit.prevent="subscribe">
        <div class="mb-6 relative lg:max-w-xl lg:mx-auto bg-white rounded-lg">
            <div class="relative flex flex-wrap items-center justify-between">
                <div class="relative flex-1">
                    <span
                        class="absolute top-0 left-0 ml-8 mt-4 font-semibold font-heading text-xs text-gray-400">{{ __('Drop your e-mail') }}</span>
                    <input wire:model.lazy="email" type="email" name="email"
                        class="inline-block w-full pt-8 pb-4 px-8 placeholder-gray-900 border-0 focus:ring-transparent focus:outline-none rounded-md">
                    <x-input-error :messages="$errors->get('email')" for="email" class="mt-2" />
                </div>
                <button type="submit" class="inline-block w-auto cursor-pointer hover:bg-red-600 text-white font-bold font-heading py-6 px-8 rounded-md uppercase text-center bg-red-600">
                    {{ __('Join') }}
                </button>
            </div>
        </div>
    </form>
</div>
