<div>
    <form wire:submit.prevent="save" class="container mx-auto mb-4">
        <span class="text-gray-500 font-bold font-heading uppercase mb-5">{{ __('Order Now') }}</span>
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
                    type="text">
            </div>
            <div class="w-full">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Address') }}</label>
                <input wire:model="address"
                    class="block w-full mt-4 py-4 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
            </div>
            <div class="w-full flex py-2 justify-start">
                <button wire:click="save"
                    class="block hover:bg-orange-400 text-center text-white font-bold font-heading py-5 px-8 rounded-md uppercase transition duration-200 bg-orange-500 cursor-pointer">
                    {{ __('Order Now') }}
                </button>
            </div>
        </div>
    </form>
</div>
