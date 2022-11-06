@section('title', __('Blog'))
<x-app-layout>
    <section>
        <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
            <div class="header flex items-end justify-between mb-12">
                <div class="title">
                    <p class="text-2xl font-light text-gray-400 text-center">
                        {{__('Latest articles')}}
                    </p>
                </div>
            </div>
            <!-- Component Code -->
            <div class="max-w-screen-xl mx-auto p-16">
                <div class="sm:grid lg:grid-cols-3 sm:grid-cols-2 gap-10">
                    @forelse ($blogs as $post)
                        <div
                            class="hover:bg-gray-900 hover:text-white transition duration-300 max-w-sm rounded overflow-hidden shadow-lg">
                            <div class="py-4 px-8">
                                <a href="{{ route('front.blogPage', $post->slug) }}">
                                    <h4 class="text-lg mb-3 font-semibold">{{$post->title}}</h4>
                                </a>
                                <p class="mb-2 text-sm text-gray-600">{!! $post->content !!}</p>

                                <img src="{{ asset('images/blog' . $post->image) }}" class="w-100" alt="{{$post->title}}">
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td>{{ __('No entries found.') }}</td>
                        </tr>
                    @endforelse
                </div>
            </div>
    </section>
</x-app-layout>
