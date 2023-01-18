<div>
    <button class="block hover:bg-red-600 text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-red-600 cursor-pointer"
        type="button"
        wire:click="AddToCart({{ $product->id }})"
        wire:loading.attr="disabled">
        {{ __('Add to cart') }}
    </button>
</div>
