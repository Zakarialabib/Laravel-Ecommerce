@section('title', $product->name)

<x-app-layout>
     <section class="py-5 bg-gray-100">
     <livewire:front.product-show :product="$product" />
     </section>
</x-app-layout>