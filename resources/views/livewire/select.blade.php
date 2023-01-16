<div>
    <select name="{{ $field }}" wire:model.lazy="{{ $field }}" wire:key="select-{{ $model->id }}"
        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
        @if ($selectType === 'category_id')
            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        @elseif($selectType === 'brand_id')
            @foreach ($this->brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        @elseif($selectType === 'subcategory_id')
            @foreach ($this->subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->category?->name }}{{ $subcategory->name }}</option>
            @endforeach
        @endif
    </select>
</div>
