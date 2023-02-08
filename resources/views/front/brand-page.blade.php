@section('title', $brand?->name)

<x-app-layout>
      <section class="py-5 px-4 bg-gray-100">
        <livewire:front.brand-page :brand="$brand" />
      </section>
</x-app-layout>