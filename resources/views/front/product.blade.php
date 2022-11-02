@section('title', $product->name)

<x-app-layout>
     <livewire:front.product-show :product="$product" />
</x-app-layout>