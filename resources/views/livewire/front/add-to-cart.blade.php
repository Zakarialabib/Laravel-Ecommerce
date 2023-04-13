<div>
    <button class="my-2 block bg-beige-500 hover:bg-beige-800 text-center text-white font-bold text-xs py-2 px-4 rounded-md uppercase cursor-pointer tracking-wider hover:shadow-lg transition ease-in duration-300"
        type="button"
        wire:click="AddToCart({{ $product->id }})"
        wire:loading.attr="disabled">
        {{ __('Add to cart') }}
    </button>
</div>
