<div>
    <div class="flex mb-4">
        <button wire:click="scrape">Scrape</button>
        <input wire:model="search" class="border-gray-400 border-2 p-2 w-full" type="text" placeholder="Search Products">
    </div>

    <div class="grid grid-cols-3 gap-4">
        @if (!empty($products))
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $product['img'] }}" alt="" class="w-full h-64 object-cover">
                    <div class="p-4">
                        {{-- <h3 class="text-lg font-medium">{{ $product['name'] }}</h3> --}}
                        <a href="" class="mt-2 block text-sm font-medium text-gray-500 hover:text-gray-600"></a>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full"
                            wire:click="addProduct('{{ $product['code'] }}', '{{ $product['link'] }}')">Add</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>
