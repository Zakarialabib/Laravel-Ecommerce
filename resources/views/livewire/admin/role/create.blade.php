<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="submit" class="pt-3">

        <div class="mb-4 {{ $errors->has('role.title') ? 'is-invalid' : '' }}">
            <x-label required for="title" :value=" __('Title')" />
            <input class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500" type="text" name="title" id="title" required wire:model.defer="role.title">
            <x-input-error for="role.title" />
        </div>
        <div class="mb-4 {{ $errors->has('permissions') ? 'is-invalid' : '' }}">
            <label class="form-label required" for="permissions">{{ __('Permissions') }}</label>
            <x-select-list class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500" required id="permissions" name="permissions" wire:model.lazy="permissions"
                :options="$this->listsForFields['permissions']" multiple />
            <x-input-error for="permissions" />
        </div>

        <div class="float-right p-2 mb-4">
            <button
                class="leading-4 md:text-sm sm:text-xs bg-green-500 text-white hover:text-green-800 hover:bg-green-100 active:bg-green-200 focus:ring-green-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-center"
                type="submit">
                {{ __('Save') }}
            </button>
            <a href="{{ route('admin.roles.index') }}"
                class="leading-4 md:text-sm sm:text-xs bg-gray-400 text-black hover:text-blue-800 hover:bg-gray-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                {{ __('Go back') }}
            </a>
        </div>
    </form>
</div>
