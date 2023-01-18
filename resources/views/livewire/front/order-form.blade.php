<div>
    <form wire:submit.prevent="save" class="container mx-auto mb-4">
        <div class="flex justify-center mb-4">
            <h5 class="text-gray-500 font-bold text-center text-md font-heading uppercase py-2">
                {{ __('Order Now') }}
            </h5>
        </div>
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('FullName') }}</label>
                <input wire:model="name"
                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Phone') }}</label>
                <input wire:model="phone"
                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="number">
            </div>
            <div class="w-full">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Address') }}</label>
                <input wire:model="address"
                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
            </div>
            <div class="w-full flex py-2 justify-center">
                <button wire:click="save" wire:loading.attr="disabled"
                    class="block hover:bg-red-600 text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-red-600 cursor-pointer">
                    {{ __('Order Now') }}
                </button>
            </div>
        </div>
    </form>
</div>
