@props(['gallery', 'image', 'video' => null])

@php
    $gallery = json_decode($gallery);
@endphp

<div class="relative mb-10">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('images/products/' . $image) }}" alt="product image" class="w-full h-full object-cover">
            </div>

            @if ($gallery)
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item) }}" alt="product image"
                            class="w-full h-full object-cover">
                    </div>
                @endforeach
            @endif

            @if ($video)
                <div class="swiper-slide">
                    {!! $video !!}
                </div>
            @endif
        </div>

        <div class="swiper-pagination"></div>


        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <!-- Thumbnail swiper -->
    <div class="swiper myThumbs">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('images/products/' . $image) }}" alt="product image"
                    class="w-full h-full object-cover">
            </div>

            @if ($gallery)
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item) }}" alt="product image"
                            class="w-full h-full object-cover">
                    </div>
                @endforeach
            @endif

            @if ($video)
                <div class="swiper-slide">
                    {!! $video !!}
                </div>
            @endif
        </div>
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
            // Initialize thumbnail swiper
            var thumbs = new Swiper(".myThumbs", {
                slidesPerView: 3,
                spaceBetween: 10,
                loop: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });

            // Sync main swiper with thumbnail swiper
            swiper.controller.control = thumbs;
            thumbs.controller.control = swiper;
        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @endpush
@endonce
