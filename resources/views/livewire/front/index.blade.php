<div>
    <div class="relative mx-auto mb-5">
        <div class="w-full mx-auto bg-gray-900">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($this->sliders as $slider)
                        <div class="swiper-slide">
                            <div class="flex flex-wrap -mx-4 py-10 px-4"
                                style="background-image: url({{ asset('images/sliders/' . $slider->photo) }});background-size: cover;background-position: center;">
                                <div class="w-full max-w-md px-10 lg:mb-5 sm:mb-2">
                                    <div class="lg:py-5 py-10 text-white px-2">
                                        <h5 class="xl:text-2xl md:text-xl sm:text-md font-bold mb-2">
                                            {{ $slider->subtitle }}
                                        </h5>
                                        <h2 class="xl:text-6xl md:text-2xl sm:text-xl font-semibold font-heading">
                                            {{ $slider->title }}
                                        </h2>
                                        <p class="py-10 xl:text-lg sm:text-sm">
                                            {!! $slider->details !!}
                                        </p>
                                        @if ($slider->link)
                                            <a class="inline-block text-white font-bold font-heading py-4 px-6 rounded-md uppercase transition ease-in duration-300 bg-beige-500 hover:bg-beige-800 hover:shadow-md"
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
        </div> 
        <div class="w-full py-5 px-4 mx-auto">
            <div class="flex flex-col">
                <h2 class="text-2xl font-bold text-center mb-4">
                    {{ __('Choose your favorite choice') }}
                </h2>

                <div class="flex flex-wrap justify-center overflow-x-scroll gap-4 py-4">
                    @foreach ($this->subcategories as $subcategory)
                        <a href="{{ route('front.subcategoryPage', $subcategory->slug) }}" class="relative w-44 h-44"
                            x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                            <div
                                class="absolute top-0 left-0 right-0 bottom-0 rounded-full bg-white shadow-lg transform hover:scale-105 transition-all duration-300">
                                <img class="absolute inset-0 w-full h-full object-cover rounded-full transform-gpu transition-all duration-1000 ease-in-out"
                                    :class="{ 'rotate-0': !hover, 'rotate-360': hover }"
                                    src="{{ $subcategory->image }}" alt="{{ $subcategory->name }}">
                            </div>
                            <h2
                                class="absolute inset-0 flex items-center justify-center text-md text-gray-800 text-center">
                                {{ $subcategory->name }} {{ __('for') }} {{ $subcategory->category?->name }}
                            </h2>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full py-5 px-4 mx-auto">
            <div x-data="{ activeTabs: 'featuredProducts' }">
                <div class="grid gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 mb-10 ">
                    <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-beige-100 hover:border-beige-500 focus:outline-none focus:border-beige-500 cursor-pointer"
                        @click="activeTabs = 'featuredProducts'"
                        :class="{
                            'border-beige-500': activeTabs === 'featuredProducts',
                            'text-beige-500': activeTabs === 'featuredProducts',
                            'hover:text-beige-500': activeTabs !== 'featuredProducts'
                        }">
                        <h4 class="inline-block" :class="{ 'text-beige-400': activeTabs === 'featuredProducts' }">
                            {{ __('Featured Products') }}
                        </h4>
                    </div>
                    <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-beige-100 hover:border-beige-500 focus:outline-none focus:border-beige-500 cursor-pointer"
                        @click="activeTabs = 'bestOfers'"
                        :class="{
                            'border-beige-500': activeTabs === 'bestOfers',
                            'text-beige-500': activeTabs === 'bestOfers',
                            'hover:text-beige-500': activeTabs !== 'bestOfers'
                        }">
                        <h4 class="inline-block" :class="{ 'text-beige-400': activeTabs === 'bestOfers' }">
                            {{ __('Best Offers') }}
                        </h4>
                    </div>
                    <div class="py-5 px-8 sm:py-2 sm:px-5 text-left font-bold text-gray-500 uppercase border-b-2 border-beige-100 hover:border-beige-500 focus:outline-none focus:border-beige-500 cursor-pointer"
                        @click="activeTabs = 'hotProducts'"
                        :class="{
                            'border-beige-500': activeTabs === 'hotProducts',
                            'text-beige-500': activeTabs === 'hotProducts',
                            'hover:text-beige-500': activeTabs !== 'hotProducts'
                        }">
                        <h4 class="inline-block" :class="{ 'text-beige-400': activeTabs === 'hotProducts' }">
                            {{ __('Hot Products') }}
                        </h4>
                    </div>
                </div>
                <div class="px-4" x-show="activeTabs === 'featuredProducts'">
                    <div role="featuredProducts" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0"
                        class="w-full mb-16">
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @foreach ($this->featuredProducts as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="px-4" x-show="activeTabs === 'bestOfers'">
                    <div role="bestOfers" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0" class="w-full mb-16">
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @foreach ($this->bestOffers as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="px-4" x-show="activeTabs === 'hotProducts'">
                    <div role="hotProducts" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0"
                        class="w-full mb-16">
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @foreach ($this->hotProducts as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 px-4 mx-auto bg-gray-100">
            <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                @foreach ($this->sections as $section)
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
                @endforeach
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
        var swiper = widnow.Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 30,
            speed: 400,
            autoHeight: true,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    })
    </script>
@endpush


@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

