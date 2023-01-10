<div>
    <button class="block hover:bg-orange-400 text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-orange-500 cursor-pointer"
        type="button"
        wire:click="AddToCart({{ $product->id }})"
        wire:loading.attr="disabled">
        {{ __('Add to cart') }}
    </button>
</div>
