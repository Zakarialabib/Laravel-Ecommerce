<div>
    <button class="ml-auto mr-2 flex items-center justify-center w-12 h-12 border rounded-lg hover:border-gray-500"
        wire:click="AddToCart({{ $product->id }})">
        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5" width="2" height="12" fill="#161616">
            </rect>
            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)"
                fill="#161616"></rect>
        </svg>
    </button>
</div>
