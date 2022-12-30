<div>
    <button class="block hover:bg-orange-400 text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase transition duration-200 bg-orange-500 cursor-pointer"
        wire:click="AddToCart({{ $product->id }})"
        wire:loading.attr="disabled">
        {{ __('Add to cart') }}
    </button>
</div>
