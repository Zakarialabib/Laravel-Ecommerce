@section('title', $page->title)
<x-app-layout>
    <section>
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8">
            <img src="{{ asset('images/page' . $page->photo) }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-white md:text-5xl">
                {{ $page->title }}
            </h1>
            <p class="py-10">{!! $page->details !!}</p>
        </article>
    </section>
</x-app-layout>
