@extends('layouts.app')

@section('title', __('Sign up '))

@section('content')

    <section class="py-20 bg-gray-100 overflow-x-hidden">
        <div class="relative container px-4 mx-auto">
            <div class="absolute inset-0 my-24 -ml-4 bg-orange-300"></div>
            <div class="relative flex flex-wrap bg-white">
                <div class="w-full md:w-4/6 px-4">
                    <div class="lg:max-w-3xl mx-auto py-20 px-4 md:px-10 lg:px-20">
                        <a class="inline-block mb-14 text-3xl font-bold font-heading" href="#">
                            <img class="h-9" src="yofte-assets/logos/yofte-logo.svg" alt="" width="auto">
                        </a>
                        <h3 class="mb-8 text-4xl md:text-5xl font-bold font-heading">Signing up with social is super
                            quick</h3>
                        <p class="mb-10 font-semibold font-heading">Please, do not hesitate</p>
                        <form class="flex flex-wrap -mx-4" action="">
                            <div class="w-full md:w-1/2 px-4 mb-8 md:mb-12">
                                <label for="">
                                    <h4 class="mb-5 text-gray-400 uppercase font-bold font-heading">Your Email</h4>
                                    <input
                                        class="p-5 w-full border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                        type="email">
                                </label>
                            </div>
                            <div class="w-full md:w-1/2 px-4 mb-12">
                                <label for="">
                                    <h4 class="mb-5 text-gray-400 uppercase font-bold font-heading">Password</h4>
                                    <input
                                        class="p-5 w-full border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                                        type="password">
                                </label>
                            </div>
                            <div class="w-full px-4 mb-12" for="">
                                <label class="flex" for="">
                                    <input class="mr-4 mt-1" type="checkbox">
                                    <span class="text-sm">By singning up, you agree to our Terms, Data Policy and
                                        Cookies.</span>
                                </label>
                            </div>
                            <div class="w-full px-4">
                                <button
                                    class="bg-blue-800 hover:bg-blue-900 text-white font-bold font-heading py-5 px-8 rounded-md uppercase">JOIN
                                    yofte</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full md:w-2/6 h-128 md:h-auto flex items-center lg:items-end px-4 pb-20 bg-cover bg-no-repeat"
                    style="background-image: url('yofte-assets/images/placeholder-sign2.png');">
                    <div>
                        <div class="inline-flex items-center mb-2 px-6 py-3 bg-white rounded-full">
                            <span class="mr-6">
                                <svg width="36" height="36" viewbox="0 0 36 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="18" fill="#A692FF"></circle>
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M15.135 24.3373L9 18.2023L9.81024 17.392L15.135 22.7168L26.1898 11.6621L27 12.4724L15.135 24.3373Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clippath id="clip0">
                                            <rect width="18" height="18" fill="white" transform="translate(9 9)">
                                            </rect>
                                        </clippath>
                                    </defs>
                                </svg>
                            </span>
                            <p>A sagittis eleifend</p>
                        </div>
                        <div class="inline-flex items-center px-6 py-3 bg-white rounded-full">
                            <span class="mr-6">
                                <svg width="36" height="36" viewbox="0 0 36 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="18" fill="#A692FF"></circle>
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M15.135 24.3373L9 18.2023L9.81024 17.392L15.135 22.7168L26.1898 11.6621L27 12.4724L15.135 24.3373Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clippath id="clip0">
                                            <rect width="18" height="18" fill="white" transform="translate(9 9)">
                                            </rect>
                                        </clippath>
                                    </defs>
                                </svg>
                            </span>
                            <p>Molestie felis, a aliquam torto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
