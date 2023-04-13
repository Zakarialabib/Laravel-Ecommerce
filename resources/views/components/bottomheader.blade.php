<div class="px-6 py-2 bg-red-700 text-white">
    <div class="flex items-center justify-center space-x-4">
        @foreach (\App\Helpers::getActiveCategories() as $category)
            <a href="{{ route('front.categories') }}?c={{$category->id}}"
                class="text-sm text-center font-semibold font-heading hover:text-beige-400 hover:underline">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>
