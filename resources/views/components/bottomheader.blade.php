@php
    $categories = \App\Models\Category::active()
        ->select('id', 'name')
        ->get();
@endphp
<div class="px-6 py-2 bg-red-700 text-white">
    <div class="flex items-center justify-center space-x-4">
        @foreach ($categories as $category)
            <a href="{{ route('front.categories') }}"
                class="text-sm text-center font-semibold font-heading hover:text-gray-400 hover:underline">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>
