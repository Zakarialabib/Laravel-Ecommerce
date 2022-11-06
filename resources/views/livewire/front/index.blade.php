<div>
    <div class="relative container mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            @foreach ($sliders as $slider)
                <div class="w-full md:w-1/2 px-4 mb-12 lg:mb-0 pt-20 lg:py-32">
                    <div class="max-w-md">
                        <h2 class="mb-8 text-5xl lg:text-6xl font-semibold font-heading">
                            {{ $slider->title }}
                        </h2>
                        <p class="mb-20 text-lg text-gray-600">
                            {{ $slider->details }}
                        </p>
                        <a class="inline-block hover:bg-orange-400 text-white font-bold font-heading py-6 px-8 rounded-md uppercase transition duration-200 bg-orange-500"
                            href="{{ $slider->link }}">
                            {{ 'Discover now' }}
                        </a>
                    </div>
                </div>
                <div class="relative w-full md:w-1/2 px-4 mb-12 lg:mb-0">
                    <div class="hidden lg:block absolute top-0 transform translate-y-1/2 right-0 w-1">
                        <a class="block w-1/2 h-40 bg-blue-600" href="#"></a><a
                            class="block w-1/2 h-40 bg-gray-300" href="#"></a>
                    </div>
                    @if ($featuredbanner)
                        @foreach ($featuredbanner as $banner)
                            <div class="absolute bottom-1/2 -mb-24 lg:right-6 inline-block bg-white rounded-lg">
                                <div class="flex p-3">
                                    <div class="w-auto pt-5 px-4 lg:px-9">
                                        <h3 class="mb-2 text-xl font-bold font-heading w-32">
                                            {{ $banner->title }}
                                        </h3>
                                        <p class="mb-4 lg:mb-0 text-lg font-semibold font-heading text-blue-500">
                                            {{ $banner->details }}
                                        </p>
                                        <a class="lg:absolute bottom-0 flex items-center justify-center w-12 h-12 lg:-mb-6 hover:bg-orange-400 text-white rounded-md bg-orange-500"
                                            href="#">
                                            <svg class="w-2 h-4" width="8" height="12" viewbox="0 0 8 12"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.97656 6.00252L0.851562 1.87752L2.02957 0.699219L7.33258 6.00252L2.02957 11.3058L0.851562 10.1275L4.97656 6.00252Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="w-auto">
                                        <img class="h-full lg:h-36 rounded-xl object-cover"
                                            src="{{ asset('images/featuredbanners/' . $banner->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <img class="mx-auto h-96 lg:h-auto" src="{{ asset('images/sliders/' . $slider->photo) }}"
                        alt="">
                </div>
            @endforeach
        </div>
        <div class="w-full lg:w-5/6 xl:absolute left-0 bottom-0 right-0 bg-white py-12 px-8 lg:ml-auto">
            <div class="flex flex-wrap items-center justify-center -mx-2 -mb-12">
                @foreach ($brands as $brand)
                    <div class="w-1/2 md:w-1/3 lg:w-1/6 px-2 mb-12">
                        <img class="mx-auto h-6" src="{{ asset('images/brands' . $brand->image) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="hidden navbar-menu fixed top-0 left-0 bottom-0 w-5/6 max-w-sm z-50">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav class="relative flex flex-col py-6 px-6 w-full h-full bg-white border-r overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-3xl font-bold font-heading" href="#">
                    <img class="h-9" src="yofte-assets/logos/yofte-logo.svg" alt="" width="auto">
                </a>
                <button class="navbar-close">
                    <svg class="h-2 w-2 text-gray-500 cursor-pointer" width="10" height="10" viewbox="0 0 10 10"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00002 1L1 9.00002M1.00003 1L9.00005 9.00002" stroke="black" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="flex mb-8 justify-between">
                <a class="inline-flex items-center font-semibold font-heading" href="#">
                    <svg class="mr-3" width="32" height="31" viewbox="0 0 32 31" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.0006 16.3154C19.1303 16.3154 21.6673 13.799 21.6673 10.6948C21.6673 7.59064 19.1303 5.07422 16.0006 5.07422C12.871 5.07422 10.334 7.59064 10.334 10.6948C10.334 13.799 12.871 16.3154 16.0006 16.3154Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M24.4225 23.8963C23.6678 22.3507 22.4756 21.0445 20.9845 20.1298C19.4934 19.2151 17.7647 18.7295 15.9998 18.7295C14.2349 18.7295 12.5063 19.2151 11.0152 20.1298C9.52406 21.0445 8.33179 22.3507 7.57715 23.8963"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                    <span>{{ __('Sign In') }}</span>
                </a>
                <div class="flex items-center">
                    <a class="mr-10" href="#">
                        <svg width="23" height="20" viewbox="0 0 23 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.4998 19.2061L2.70115 9.92527C1.92859 9.14433 1.41864 8.1374 1.24355 7.04712C1.06847 5.95684 1.23713 4.8385 1.72563 3.85053V3.85053C2.09464 3.10462 2.63366 2.45803 3.29828 1.96406C3.9629 1.47008 4.73408 1.14284 5.5483 1.00931C6.36252 0.875782 7.19647 0.939779 7.98144 1.19603C8.7664 1.45228 9.47991 1.89345 10.0632 2.48319L11.4998 3.93577L12.9364 2.48319C13.5197 1.89345 14.2332 1.45228 15.0182 1.19603C15.8031 0.939779 16.6371 0.875782 17.4513 1.00931C18.2655 1.14284 19.0367 1.47008 19.7013 1.96406C20.3659 2.45803 20.905 3.10462 21.274 3.85053V3.85053C21.7625 4.8385 21.9311 5.95684 21.756 7.04712C21.581 8.1374 21.071 9.14433 20.2984 9.92527L11.4998 19.2061Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </a>
                    <a class="flex items-center" href="#">
                        <svg class="mr-3" width="23" height="23" viewbox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                            <path
                                d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                        </svg>
                        <span
                            class="inline-block w-6 h-6 text-center bg-gray-100 rounded-full font-semibold font-heading">3</span>
                    </a>
                </div>
            </div>
            <input
                class="block mb-10 py-5 px-8 bg-gray-100 rounded-md border-transparent focus:ring-blue-300 focus:border-blue-300 focus:outline-none"
                type="search" placeholder="Search">
            <ul class="text-3xl font-bold font-heading">
                <li class="mb-8"><a href="#">{{ __('Category') }}</a></li>
                <li class="mb-8"><a href="#">{{ __('Catalog') }}</a></li>
                <li><a href="#">{{ __('Brand<') }}/a></li>
            </ul>
        </nav>
    </div>
    </section>

    <section class="py-10 bg-gray-100 overflow-x-hidden">
        <div class="container mx-auto px-10">
            <h2 class="mb-16 md:mb-24 text-4xl md:text-5xl font-bold font-heading">The Latest And The Greatest</h2>
            <div class="flex mb-16">
                <div class="w-full flex flex-wrap -mx-3">
                    @foreach ($products as $product)
                        <div class="w-full lg:w-1/3 px-3 mb-16 lg:mb-0">
                            <a class="block mb-10" href="{{ route('front.product', $product->slug) }}">
                                <div class="relative">
                                    @if($product->old_price)
                                    <span
                                        class="absolute bottom-0 left-0 ml-6 mb-6 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                        -{{ $product->discount }}%
                                    </span>
                                    @endif
                                    <img class="w-full h-96 object-cover"
                                        src="{{ asset('images/products/' . $product->image) }}" alt="">
                                </div>
                                <div class="mt-12">
                                    <div class="mb-2">
                                        <h3 class="mb-3 text-3xl font-bold font-heading text-blue-900">
                                            {{ $product->name }}
                                        </h3>
                                        <p class="text-xl font-bold font-heading text-white">
                                            <span class="text-blue-900">{{ $product->price }} DH</span>
                                            <span
                                                class="text-xs text-gray-500 font-semibold font-heading line-through">{{ $product->old_price }}</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a class="inline-block hover:bg-orange-400 text-white font-bold font-heading py-4 px-8 rounded-md uppercase transition duration-200 bg-orange-500"
                                href="{{ route('front.product', $product->slug) }}">
                                {{ __('Learn more') }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-gray-100">
        <div class="container mx-auto px-10">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6 lg:mb-0">
                    <div class="relative h-full text-center pt-16 bg-white">
                        <img class="hidden md:block absolute z-10 top-0 left-1/2 ml-16 lg:ml-8 mt-16"
                            src="yofte-assets/elements/dots.svg" alt="">
                        <div class="pb-12 border-b">
                            <span
                                class="inline-flex mb-16 items-center justify-center w-20 h-20 bg-blue-300 rounded-full">
                                <svg width="37" height="37" viewbox="0 0 37 37" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M34.9845 11.6702C33.7519 10.3368 32 9.60814 30.0543 9.60814H24.9767V6.75543C24.9767 6.2438 24.5581 5.8252 24.0465 5.8252H0.930233C0.418605 5.8252 0 6.2438 0 6.75543V27.2128C0 27.7244 0.418605 28.143 0.930233 28.143H4.63566C4.93798 29.864 6.43411 31.174 8.24031 31.174C10.0465 31.174 11.5426 29.864 11.845 28.143H24.0465H26.0853C26.3876 29.864 27.8837 31.174 29.6899 31.174C31.4961 31.174 32.9922 29.864 33.2946 28.143H36.0698C36.5814 28.143 37 27.7244 37 27.2128V17.6004C36.9922 15.143 36.3023 13.0888 34.9845 11.6702ZM1.86047 7.68566H23.1163V10.5384V26.2903H11.6822C11.1783 24.8795 9.82171 23.864 8.24031 23.864C6.65892 23.864 5.30233 24.8795 4.79845 26.2903H1.86047V7.68566ZM8.24031 29.3136C7.24806 29.3136 6.44186 28.5074 6.44186 27.5151C6.44186 26.5229 7.24806 25.7167 8.24031 25.7167C9.23256 25.7167 10.0388 26.5229 10.0388 27.5151C10.0388 28.5074 9.23256 29.3136 8.24031 29.3136ZM29.6899 29.3136C28.6977 29.3136 27.8915 28.5074 27.8915 27.5151C27.8915 26.5229 28.6977 25.7167 29.6899 25.7167C30.6822 25.7167 31.4884 26.5229 31.4884 27.5151C31.4884 28.5074 30.6822 29.3136 29.6899 29.3136ZM35.1318 26.2826H33.1318C32.6279 24.8717 31.2713 23.8562 29.6899 23.8562C28.1085 23.8562 26.7519 24.8717 26.2481 26.2826H24.9845V11.4686H30.062C33.1938 11.4686 35.1395 13.8174 35.1395 17.6004V26.2826H35.1318Z"
                                        fill="white"></path>
                                </svg>
                            </span>
                            <h3 class="mb-4 text-xl font-bold font-heading">Free Shipping</h3>
                            <p>From $45</p>
                        </div>
                        <div class="pt-12 px-14 pb-14 text-center">
                            <p class="text-lg text-gray-500">Ante ipsum primis in faucibus orci luctus.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6 lg:mb-0">
                    <div class="relative h-full text-center pt-16 bg-white">
                        <img class="hidden lg:block absolute z-10 top-0 left-1/2 ml-16 lg:ml-8 mt-16"
                            src="yofte-assets/elements/dots.svg" alt="">
                        <div class="pb-12 border-b">
                            <span
                                class="inline-flex mb-16 items-center justify-center w-20 h-20 bg-indigo-300 rounded-full">
                                <svg width="39" height="36" viewbox="0 0 39 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M33.7601 5.67776C30.3819 2.38616 25.8883 0.572266 21.1139 0.572266C16.2512 0.572266 11.7014 2.44089 8.30713 5.83414C7.93802 6.20161 7.94604 6.79581 8.32318 7.16329C8.70032 7.52294 9.31017 7.51512 9.68731 7.14765C12.7205 4.12188 16.7727 2.45653 21.1139 2.45653C29.9165 2.44871 37.0742 9.42284 37.0742 17.9998C37.0742 26.5767 29.9165 33.5508 21.1139 33.5508C12.3113 33.5508 5.15359 26.5767 5.15359 17.9998V17.8043L6.7424 19.3524C6.92696 19.5322 7.17571 19.626 7.42446 19.626C7.67322 19.626 7.91395 19.5322 8.10653 19.3524C8.48367 18.9849 8.48367 18.3907 8.10653 18.0232L4.88077 14.8724C4.50363 14.5049 3.89378 14.5049 3.51664 14.8724L0.282856 18.0232C-0.0942853 18.3907 -0.0942853 18.9849 0.282856 19.3524C0.467414 19.5322 0.716167 19.626 0.96492 19.626C1.21367 19.626 1.4544 19.5322 1.64698 19.3524L3.23579 17.8043V17.9998C3.23579 22.6518 5.09742 27.0302 8.47565 30.3218C11.8539 33.6134 16.3475 35.4273 21.1219 35.4273C25.8964 35.4273 30.39 33.6134 33.7682 30.3218C37.1464 27.0302 39 22.6518 39 17.9998C39 13.3477 37.1384 8.96937 33.7601 5.67776Z"
                                        fill="white"></path>
                                    <path
                                        d="M20.4014 8C17.272 8 14.7283 10.4785 14.7283 13.5277V16.1938H12.9629C12.4333 16.1938 12 16.616 12 17.132V26.4908C12 27.0068 12.4333 27.429 12.9629 27.429H27.848C28.3776 27.429 28.8109 27.0068 28.8109 26.4908V17.1399C28.8109 16.6238 28.3776 16.2016 27.848 16.2016H26.0826V13.5355C26.0826 10.4863 23.5309 8 20.4014 8ZM16.6541 13.5355C16.6541 11.5183 18.3392 9.88427 20.4014 9.88427C22.4637 9.88427 24.1488 11.5262 24.1488 13.5355V16.2016H16.6541V13.5355ZM26.885 25.5526H13.9258V18.0703H26.885V25.5526Z"
                                        fill="white"></path>
                                </svg>
                            </span>
                            <h3 class="mb-4 text-xl font-bold font-heading">Secure Shopping</h3>
                            <p>100% Guarantee</p>
                        </div>
                        <div class="pt-12 px-14 pb-14 text-center">
                            <p class="text-lg text-gray-500">Fusce pharetra lectus felis, eget temp.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4 px-3 mb-6 md:mb-0">
                    <div class="relative h-full text-center pt-16 bg-white">
                        <img class="hidden md:block absolute z-10 top-0 left-1/2 ml-16 lg:ml-8 mt-16"
                            src="yofte-assets/elements/dots.svg" alt="">
                        <div class="pb-12 border-b">
                            <span
                                class="inline-flex mb-16 items-center justify-center w-20 h-20 bg-pink-400 rounded-full">
                                <svg width="31" height="37" viewbox="0 0 31 37" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.59532 15.0855C9.59532 14.5814 9.18285 14.1689 8.67872 14.1689H1.33066C0.826531 14.1689 0.414062 14.5814 0.414062 15.0855C0.414062 15.5897 0.826531 16.0021 1.33066 16.0021H8.67872C9.18285 16.0021 9.59532 15.5897 9.59532 15.0855Z"
                                        fill="white"></path>
                                    <path
                                        d="M29.669 14.1689H22.3209C21.8168 14.1689 21.4043 14.5814 21.4043 15.0855C21.4043 15.5897 21.8168 16.0021 22.3209 16.0021H29.669C30.1731 16.0021 30.5856 15.5897 30.5856 15.0855C30.5856 14.5814 30.1807 14.1689 29.669 14.1689Z"
                                        fill="white"></path>
                                    <path
                                        d="M15.4996 9.18126C16.0037 9.18126 16.4162 8.76879 16.4162 8.26466V0.916598C16.4162 0.412469 16.0037 0 15.4996 0C14.9955 0 14.583 0.412469 14.583 0.916598V8.26466C14.583 8.76879 14.9955 9.18126 15.4996 9.18126Z"
                                        fill="white"></path>
                                    <path
                                        d="M20.3199 11.1823C20.5567 11.1823 20.7858 11.0906 20.9691 10.915L26.1708 5.71327C26.5298 5.35427 26.5298 4.77376 26.1708 4.41476C25.8118 4.05576 25.2313 4.05576 24.8723 4.41476L19.6706 9.61645C19.3116 9.97545 19.3116 10.556 19.6706 10.915C19.8539 11.0906 20.0907 11.1823 20.3199 11.1823Z"
                                        fill="white"></path>
                                    <path
                                        d="M10.0305 10.915C10.2062 11.0906 10.443 11.1823 10.6798 11.1823C10.9166 11.1823 11.1457 11.0906 11.329 10.915C11.688 10.556 11.688 9.97545 11.329 9.61645L6.12733 4.41476C5.76833 4.05576 5.18782 4.05576 4.82882 4.41476C4.46982 4.77376 4.46982 5.35427 4.82882 5.71327L10.0305 10.915Z"
                                        fill="white"></path>
                                    <path
                                        d="M26.5146 20.8684C25.8195 20.2726 24.9411 19.9442 24.0474 19.9442H23.2149H20.2206H18.7999V16.2396C18.7999 14.4675 18.2729 13.1766 17.2264 12.4051C15.5765 11.1983 13.3385 11.8781 13.2392 11.9086C12.8573 12.0309 12.5976 12.3822 12.5976 12.7794V17.2478C12.5976 18.6074 11.9483 19.7608 10.6575 20.6851C9.67976 21.3878 8.67914 21.7086 8.54929 21.7468L8.45763 21.7697C8.1139 21.3802 7.60978 21.1357 7.04454 21.1357H3.56147C2.52266 21.1357 1.6748 21.9836 1.6748 23.0224V34.4493C1.6748 35.4881 2.52266 36.336 3.56147 36.336H7.05982C7.51812 36.336 7.94586 36.1679 8.26667 35.893C8.9694 36.5804 9.92419 37.0005 10.9554 37.0005H14.4308H14.7898H21.9011C23.001 37.0005 23.971 36.7332 24.712 36.2367C25.6591 35.5951 26.2473 34.5792 26.4153 33.2807L27.8284 24.4966C28.0499 23.137 27.5458 21.7468 26.5146 20.8684ZM7.11329 34.4493C7.11329 34.4799 7.09037 34.5028 7.05982 34.5028H3.56147C3.53092 34.5028 3.508 34.4799 3.508 34.4493V23.0224C3.508 22.9918 3.53092 22.9689 3.56147 22.9689H7.05982C7.09037 22.9689 7.11329 22.9918 7.11329 23.0224V34.4493ZM26.0181 24.214L24.605 33.0133C24.605 33.021 24.605 33.0362 24.5974 33.0515C24.5363 33.5786 24.3377 35.175 21.9011 35.175H14.7898H14.4308H10.9554C9.97765 35.175 9.12216 34.4417 8.9694 33.4716C8.96176 33.4334 8.95412 33.3952 8.94648 33.3647V23.5418L8.99995 23.5265C9.01523 23.5265 9.02287 23.5189 9.03814 23.5189C9.09161 23.5036 10.3901 23.137 11.681 22.2127C13.476 20.9371 14.4308 19.2185 14.4308 17.2478V13.5356C14.9349 13.4821 15.63 13.5051 16.1418 13.8793C16.6917 14.2842 16.9667 15.0785 16.9667 16.2319V20.8531C16.9667 21.3572 17.3792 21.7697 17.8833 21.7697H20.2206H23.2149H24.0474C24.5057 21.7697 24.9564 21.9454 25.323 22.2509C25.873 22.7245 26.1327 23.4731 26.0181 24.214Z"
                                        fill="white"></path>
                                </svg>
                            </span>
                            <h3 class="mb-4 text-xl font-bold font-heading">Customer Satisfaction</h3>
                            <p>100% Positive Feedbacks</p>
                        </div>
                        <div class="pt-12 px-14 pb-14 text-center">
                            <p class="text-lg text-gray-500">Praesent ultrices ac lectus non placerat!</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4 px-3">
                    <div class="relative h-full text-center pt-16 bg-white">
                        <div class="pb-12 border-b">
                            <span
                                class="inline-flex mb-16 items-center justify-center w-20 h-20 bg-orange-300 rounded-full">
                                <svg width="35" height="37" viewbox="0 0 35 37" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M30.0586 14.0693V12.6468C30.0586 9.24223 28.8538 6.07857 26.6695 3.73109C24.4309 1.32143 21.3527 0 17.9947 0H16.821C13.463 0 10.3849 1.32143 8.14622 3.73109C5.96197 6.07857 4.75714 9.24223 4.75714 12.6468V14.0693C2.10651 14.2481 0 16.4557 0 19.1529V21.3761C0 24.1821 2.28529 26.4674 5.09139 26.4674H7.95966C8.47269 26.4674 8.89244 26.0477 8.89244 25.5347V14.9866C8.89244 14.4735 8.47269 14.0538 7.95966 14.0538H6.62269V12.6468C6.62269 6.49832 11.0067 1.86555 16.8132 1.86555H17.987C23.8013 1.86555 28.1775 6.49832 28.1775 12.6468V14.0538H26.8405C26.3275 14.0538 25.9078 14.4735 25.9078 14.9866V25.5269C25.9078 26.0399 26.3275 26.4597 26.8405 26.4597H28.1464C27.7655 31.3256 24.4153 32.4527 22.8607 32.7092C22.4332 31.3956 21.1973 30.4473 19.7437 30.4473H17.4118C15.6084 30.4473 14.1393 31.9164 14.1393 33.7197C14.1393 35.5231 15.6084 37 17.4118 37H19.7515C21.2595 37 22.5265 35.9739 22.9074 34.5903C23.6691 34.4815 24.8739 34.2095 26.071 33.5099C27.7578 32.5227 29.7555 30.5095 30.0197 26.4519C32.6859 26.2887 34.8002 24.0733 34.8002 21.3683V19.1452C34.808 16.4557 32.7092 14.2403 30.0586 14.0693ZM7.04244 24.5941H5.10693C3.32689 24.5941 1.88109 23.1483 1.88109 21.3683V19.1452C1.88109 17.3651 3.32689 15.9193 5.10693 15.9193H7.04244V24.5941ZM19.7515 35.1345H17.4118C16.6345 35.1345 16.0048 34.5048 16.0048 33.7275C16.0048 32.9502 16.6345 32.3206 17.4118 32.3206H19.7515C20.5288 32.3206 21.1584 32.9502 21.1584 33.7275C21.1584 34.5048 20.5288 35.1345 19.7515 35.1345ZM32.9424 21.3683C32.9424 23.1483 31.4966 24.5941 29.7166 24.5941H27.7811V15.9193H29.7166C31.4966 15.9193 32.9424 17.3651 32.9424 19.1452V21.3683Z"
                                        fill="white"></path>
                                </svg>
                            </span>
                            <h3 class="mb-4 text-xl font-bold font-heading">Support</h3>
                            <p>Online Support 24/7</p>
                        </div>
                        <div class="pt-12 px-14 pb-14 text-center">
                            <p class="text-lg text-gray-500">Ante ipsum primis in faucibus orci luctus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features -->

    <!-- Start Sections -->
    @foreach ($sections as $section)
        <section class="py-10 bg-gray-100 overflow-x-hidden">
            <div class="container px-4 mx-auto">
                <div class="relative py-20 md:py-40 bg-orange-300">
                    <img class="hidden md:block absolute inset-0 w-full h-full"
                        src="{{ asset('images/sections' . $section->image) }}" alt="">
                    <div class="relative text-center">
                        <div class="inline-block px-4 relative mb-6">
                            <div class="absolute top-0 left-0 h-1 bg-gray-900 w-full"></div>
                            <div class="absolute bottom-0 left-0 h-1 bg-gray-900 w-full"></div>
                            <h2 class="relative text-7xl font-bold font-heading text-white">{{ $section->title }}</h2>
                        </div>
                        <p class="mb-12 text-2xl font-bold font-heading text-white uppercase italic">
                            {{ $section->subtitle }}</p>
                        <a class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-bold font-heading py-5 px-8 rounded-md uppercase transition duration-200"
                            href="{{ $section->link }}">{{ $section->link_text }}</a>
                        {{ __('Get Started') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
</div>
