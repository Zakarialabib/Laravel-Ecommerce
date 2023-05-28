<div wire:ignore class="w-full">
    <select class="p-3 leading-5 bg-white text-gray-700  rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500" data-minimum-results-for-search="Infinity" data-placeholder="{{ __('Choose option') }}" {{ $attributes }}>
        @if(!isset($attributes['multiple']))
            <option></option>
        @endif
        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>