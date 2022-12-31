<div>
    <!-- Edit Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Shipping') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="space-y-4 px-4">

                    <div class="mt-4 p w-full">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.defer="shipping.title" />
                        <x-input-error :messages="$errors->get('shipping.title')" for="shipping.title" class="mt-2" />
                    </div>
                    <div class="mt-4 p w-full">
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle"
                            wire:model.defer="shipping.subtitle" />
                        <x-input-error :messages="$errors->get('shipping.subtitle')" for="shipping.subtitle" class="mt-2" />
                    </div>

                    <div class="mt-4 p w-full">
                        <x-label for="cost" :value="__('Cost')" />
                        <x-input id="cost" class="block mt-1 w-full" type="number" name="cost"
                            wire:model.defer="shipping.cost" />
                        <x-input-error :messages="$errors->get('shipping.cost')" for="shipping.cost" class="mt-2" />
                    </div>

                    <div class="mt-4 p w-full">
                        <x-label for="is_pickup" :value="__('Is Pickup')" />
                        <x-input id="is_pickup" class="block mt-1 w-full" type="checkbox" name="is_pickup"
                            wire:model.defer="shipping.is_pickup" />
                        <x-input-error :messages="$errors->get('shipping.is_pickup')" for="shipping.is_pickup" class="mt-2" />
                    </div>

                    <div class="w-full py-4">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Edit Modal -->
</div>
