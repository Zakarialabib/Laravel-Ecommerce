<div>
    {{-- wire this input with livewire --}}
    <input wire:model.defer="search"
        class="block mb-10 py-5 px-8 bg-gray-100 rounded-md border-transparent focus:ring-blue-300 focus:border-blue-300 focus:outline-none"
        type="search" placeholder="Search">
    {{-- if search is not empty --}}
    @if (!empty($search))
        {{-- loop through the results --}}
        @foreach ($results as $result)
            <div class="mb-5">
                {{-- if the result is a product --}}
                @if ($result instanceof App\Models\Product)
                    {{-- <a href="{{ route('product.show', $result->slug) }}"> --}}
                    
                        <img src="{{ asset('storage/' . $result->image) }}" alt="{{ $result->name }}"
                            class="w-20 h-20 float-left mr-5">
                        <h3 class="text-lg font-semibold">{{ $result->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $result->price }}</p>

                    {{-- </a> --}}
                @endif
                {{-- if the result is a page
                    @if ($result instanceof App\Models\Page)
                        <a href="{{ route('page', $result->slug) }}">
                            <h3 class="text-xl font-bold">{{ $result->title }}</h3>
                        </a>
                        <p class="text-gray-500">{{ $result->excerpt }}</p>
                    @endif --}}
            </div>
        @endforeach
    @endif
</div>
