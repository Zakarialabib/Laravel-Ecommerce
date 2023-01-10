@props(['product'])

@php
    $gallery = json_decode($product->gallery);
@endphp

<div class="relative mb-10">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('images/products/' . $product->image) }}" 
                alt="{{ $product->name }}"  loading="lazy"
                class="w-full h-full object-cover">
            </div>

            @if ($gallery)
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item) }}" 
                            class="w-full h-full object-cover"
                            alt="{{ $product->name }}" 
                            loading="lazy">
                    </div>
                @endforeach
            @endif

            @if($product->embeded_video)
            <div class="swiper-slide">
                {!! $product->embeded_video !!}
            </div>
            @endif
        </div>
        
        <div class="swiper-pagination"></div>

        
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

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
