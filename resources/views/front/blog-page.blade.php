@section('title', $blog?->title)
<x-app-layout>
    <section>
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8">
            <img src="{{ asset('images/blog' . $blog->image) }}" alt="{{ $blog->title }}" class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl font-bold text-white md:text-5xl">
                {{ $blog->title }}
            </h1>
            <h2 class="mt-2 text-sm text-gray-500">{{ $blog->created_at }}</h4>
            <p>{!! clean($blog->body) !!}</p>
        </article>
    </section>
</x-app-layout>