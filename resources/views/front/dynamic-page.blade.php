@section('title', $page->title)
<x-app-layout>
    <section class="container px-4 mx-auto">
        <article itemscope itemtype="http://schema.org/Article" class="md:max-w-5xl mx-auto mb-16 text-center">
            <span class="inline-block py-px px-2 mb-4 rounded-lg shadow-sm">
                <img src="{{ asset('images/page' . $page->photo) }}" alt="{{ $page->title }}"
                    class="object-cover object-top w-full" />
            </span>
            <h3 class="mb-4 text-3xl md:text-5xl leading-tight text-darkCoolGray-900 font-bold tracking-tighter">
                {{ $page->title }}
            </h3>
            <p class="py-10 text-lg md:text-xl text-coolGray-500 font-medium">
                {!! $page->details !!}
            </p>
        </article>
    </section>
</x-app-layout>
