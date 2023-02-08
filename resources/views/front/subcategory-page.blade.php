@section('title', $subcategory->category?->name.' '. $subcategory?->name)

<x-app-layout>
      <section class="py-5 px-4 bg-gray-100">
        <livewire:front.subcategory-page :subcategory="$subcategory" />
      </section>
</x-app-layout>