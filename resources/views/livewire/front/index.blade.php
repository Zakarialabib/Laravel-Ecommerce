<div>
    <div class="relative mx-auto mb-5">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($this->sliders as $slider)
                    <div class="swiper-slide">
                        <div class="flex flex-wrap -mx-4 py-10"
                            style="background-image: url({{ asset('images/sliders/' . $slider->photo) }});background-size: cover;background-position: center;">
                            <div class="w-full md:w-1/2 px-4 lg:mb-5 sm:mb-2">
                                <div class="max-w-md lg:py-5 py-10 text-white px-2">
                                    <h5 class="lg:text-2xl sm:text-md font-bold mb-2">
                                        {{ $slider->subtitle }}
                                    </h5>
                                    <h2 class="lg:text-6xl sm:text-xl font-semibold font-heading">
                                        {{ $slider->title }}
                                    </h2>
                                    <p class="py-10 lg:text-lg sm:text-sm">
                                        {!! $slider->details !!}
                                    </p>
                                    @if ($slider->link)
                                        <a class="inline-block hover:bg-orange-400 text-white font-bold font-heading py-6 px-8 rounded-md uppercase transition duration-200 bg-orange-500"
                                            href="{{ $slider->link }}">
                                            {{ 'Discover now' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <div x-data="{ activeTabs: 'featuredProducts' }" class="mx-auto px-4">
            <div class="grid gap-4 xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 mb-10 ">
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'featuredProducts'">
                    <h4 class="inline-block" :class="activeTabs === 'featuredProducts' ? 'text-orange-400' : ''">
                        {{ __('Featured Products') }}
                    </h4>
                </div>
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'bestOfers'">
                    <h4 class="inline-block" :class="activeTabs === 'bestOfers' ? 'text-orange-400' : ''">
                        {{ __('Best Offers') }}
                    </h4>
                </div>
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'hotProducts'">
                    <h4 class="inline-block" :class="activeTabs === 'hotProducts' ? 'text-orange-400' : ''">
                        {{ __('Hot Products') }}
                    </h4>
                </div>
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'brands'">
                    <h4 class="inline-block" :class="activeTabs === 'brands' ? 'text-orange-400' : ''">
                        {{ __('Brands') }}
                    </h4>
                </div>
            </div>
            <div x-show="activeTabs === 'featuredProducts'" class="px-5">
                <div role="featuredProducts" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0">
                    <section>
                        <div class="container mx-auto">
                            <div class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @forelse ($this->featuredProducts as $product)
                                        <x-product-card :product="$product" />
                                    @empty
                                        <div class="w-full">
                                            <h3 class="text-3xl font-bold font-heading text-blue-900">
                                                {{ __('No products found') }}
                                            </h3>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div x-show="activeTabs === 'bestOfers'" class="px-5">
                <div role="bestOfers" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0">
                    <section>
                        <div class="container mx-auto">
                            <div class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @forelse ($this->bestOffers as $product)
                                        <x-product-card :product="$product" />
                                    @empty
                                        <div class="w-full">
                                            <h3 class="text-3xl font-bold font-heading text-blue-900">
                                                {{ __('No products found') }}
                                            </h3>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div x-show="activeTabs === 'hotProducts'" class="px-5">
                <div role="hotProducts" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0">
                    <section>
                        <div class="container mx-auto">
                            <div class="w-full mb-16">
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                                    @forelse ($this->hotProducts as $product)
                                        <x-product-card :product="$product" />
                                    @empty
                                        <div class="w-full">
                                            <h3 class="text-3xl font-bold font-heading text-blue-900">
                                                {{ __('No products found') }}
                                            </h3>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div x-show="activeTabs === 'brands'" class="px-5">
                <div role="brands" aria-labelledby="tab-3" id="tab-panel-3" tabindex="0">
                    <div class="container mx-auto">
                        <div class="flex mb-5">
                            <div
                                class="grid gap-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 w-full py-10">
                                @forelse ($this->brands as $brand)
                                    <div class="flex flex-col items-center rounded-md">
                                        <a class="block mb-5" href="{{ route('front.brandPage', $brand->slug) }}">
                                            <div class="relative">
                                                <img class="w-full h-24 object-contain" loading="lazy"
                                                    src="{{ asset('images/brands/' . $brand->image) }}"
                                                    onerror="this.onerror=null; this.remove();"
                                                    alt="{{ $brand->name }}">
                                            </div>
                                        </a>
                                        <a class="my-2 text-center mb-2"
                                            href="{{ route('front.brandPage', $brand->slug) }}">
                                            <h3 class="mb-3 text-3xl font-bold font-heading text-blue-900">
                                                {{ $brand->name }}
                                            </h3>
                                            {{-- count products in brand  --}}
                                            <p class="text-xl font-bold font-heading text-white">
                                                <span class="text-blue-900">
                                                    {{ $brand->products->count() }} {{ __('products') }}
                                                </span>
                                            </p>
                                        </a>
                                    </div>
                                @empty
                                    <div class="w-full">
                                        <h3 class="text-3xl font-bold font-heading text-blue-900">
                                            {{ __('No brands found') }}
                                        </h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="py-5 px-4 mx-auto bg-gray-100">
            <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                @forelse ($this->sections as $section)
                    <div class="px-3 mb-6">
                        <div class="relative h-full text-center pt-16 bg-white">
                            <div class="pb-12 border-b">
                                <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                @if ($section->subtitle)
                                    <p>{{ $section->subtitle }}</p>
                                @endif
                            </div>
                            <div class="py-5 px-4 text-center">
                                <p class="text-lg text-gray-500">
                                    {!! $section->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container mx-auto py-10">
                        <h2 class="text-4xl font-bold font-heading text-center">{{ __('More Coming Soon') }}</h2>
                    </div>
                @endforelse
            </div>
        </section>
        <!-- End Features -->
    </div>
</div>

@once
    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: "auto",
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @endpush
@endonce
