<div>
    <div class="relative mx-auto px-4 mb-5">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($this->sliders as $slider)
                <div class="swiper-slide">
                    <div class="flex flex-wrap -mx-4 py-10"
                        style="background-image: url({{ asset('images/sliders/' . $slider->photo) }});background-size: cover;background-position: center;">
                        <div class="w-full md:w-1/2 px-4 lg:mb-5 sm:mb-2">
                            <div class="max-w-md lg:py-5 py-10 text-black bg-white opacity-75 rounded-md px-4">
                                <h5 class="text-2xl font-bold text-gray-800 mb-2">
                                    {{ $slider->subtitle }}
                                </h5>
                                <h2 class="text-5xl lg:text-6xl font-semibold font-heading">
                                    {{ $slider->title }}
                                </h2>
                                <p class="py-10 text-lg text-gray-800">
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

        <div x-data="{ activeTabs: 'featuredProducts' }" class="container mx-auto px-4">
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                <div class="py-6 px-10 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'featuredProducts'">
                    <h4 class="inline-block" :class="activeTabs === 'featuredProducts' ? 'text-orange-400' : ''">
                        {{ __('Featured Products') }}
                    </h4>
                </div>
                <div class="py-6 px-10 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'bestOfers'">
                    <h4 class="inline-block" :class="activeTabs === 'bestOfers' ? 'text-orange-400' : ''">
                        {{ __('Best Offers') }}
                    </h4>
                </div>
                <div class="py-6 px-10 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
                    @click="activeTabs = 'hotProducts'">
                    <h4 class="inline-block" :class="activeTabs === 'hotProducts' ? 'text-orange-400' : ''">
                        {{ __('Hot Products') }}
                    </h4>
                </div>
                <div class="py-6 px-10 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500 cursor-pointer"
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

        <section class="py-5 px-4 bg-gray-100">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-3">
                    @forelse ($this->sections as $section)
                        <div class="px-3 mb-6">
                            <div class="relative h-full text-center pt-16 bg-white">
                                <div class="pb-12 border-b">
                                    <span
                                        @if ($section->color) style="background-color: {{ $section->bg_color }};" @endif
                                        class="inline-flex mb-16 items-center justify-center w-20 h-20 bg-blue-300 rounded-full">
                                        <svg width="37" height="37" viewbox="0 0 37 37" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M34.9845 11.6702C33.7519 10.3368 32 9.60814 30.0543 9.60814H24.9767V6.75543C24.9767 6.2438 24.5581 5.8252 24.0465 5.8252H0.930233C0.418605 5.8252 0 6.2438 0 6.75543V27.2128C0 27.7244 0.418605 28.143 0.930233 28.143H4.63566C4.93798 29.864 6.43411 31.174 8.24031 31.174C10.0465 31.174 11.5426 29.864 11.845 28.143H24.0465H26.0853C26.3876 29.864 27.8837 31.174 29.6899 31.174C31.4961 31.174 32.9922 29.864 33.2946 28.143H36.0698C36.5814 28.143 37 27.7244 37 27.2128V17.6004C36.9922 15.143 36.3023 13.0888 34.9845 11.6702ZM1.86047 7.68566H23.1163V10.5384V26.2903H11.6822C11.1783 24.8795 9.82171 23.864 8.24031 23.864C6.65892 23.864 5.30233 24.8795 4.79845 26.2903H1.86047V7.68566ZM8.24031 29.3136C7.24806 29.3136 6.44186 28.5074 6.44186 27.5151C6.44186 26.5229 7.24806 25.7167 8.24031 25.7167C9.23256 25.7167 10.0388 26.5229 10.0388 27.5151C10.0388 28.5074 9.23256 29.3136 8.24031 29.3136ZM29.6899 29.3136C28.6977 29.3136 27.8915 28.5074 27.8915 27.5151C27.8915 26.5229 28.6977 25.7167 29.6899 25.7167C30.6822 25.7167 31.4884 26.5229 31.4884 27.5151C31.4884 28.5074 30.6822 29.3136 29.6899 29.3136ZM35.1318 26.2826H33.1318C32.6279 24.8717 31.2713 23.8562 29.6899 23.8562C28.1085 23.8562 26.7519 24.8717 26.2481 26.2826H24.9845V11.4686H30.062C33.1938 11.4686 35.1395 13.8174 35.1395 17.6004V26.2826H35.1318Z"
                                                fill="white"></path>
                                        </svg>
                                    </span>
                                    <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                    @if ($section->subtitle)
                                        <p>{{ $section->subtitle }}</p>
                                    @endif
                                </div>
                                <div class="pt-12 px-14 pb-14 text-center">
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
