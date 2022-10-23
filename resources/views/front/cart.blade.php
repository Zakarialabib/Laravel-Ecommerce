@extends('layouts.app')

@section('title', __('Cart'))

@section('content')
      <div class="relative">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <div class="z-50 fixed top-0 right-0 bottom-0 w-full max-w-xl bg-white overflow-y-scroll">
          <div class="p-6 md:pt-12 md:pb-6 md:px-12 bg-white">
            <div class="text-right">
              <a class="inline-block ml-auto" href="#">
                <svg width="17" height="18" viewbox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="12.0273" y="4.53223" width="2" height="12" transform="rotate(45 12.0273 4.53223)" fill="#161616"></rect><rect x="13.4336" y="13.0186" width="2" height="12" transform="rotate(135 13.4336 13.0186)" fill="#161616"></rect></svg>
              </a>
            </div>
            <div class="flex mb-12 items-center">
              <h3 class="text-4xl font-bold font-heading">Your cart</h3>
              <span class="inline-flex ml-4 items-center justify-center w-8 h-8 rounded-full bg-orange-300 text-base font-bold font-heading text-white">2</span>
            </div>
            <div class="flex flex-wrap -mx-4 mb-10 items-center">
              <div class="w-full md:w-1/3 mb-6 md:mb-0 px-4">
                <div class="flex h-32 items-center justify-center bg-gray-100">
                  <img class="h-full object-contain" src="yofte-assets/images/waterbottle.png" alt="">
                </div>
              </div>
              <div class="w-full md:w-2/3 px-4">
                <div>
                  <h3 class="mb-1 text-xl font-bold font-heading">BRILE water filter carafe</h3>
                  <p class="mb-4 text-gray-500">Maecenas 0.7 commodo sit</p>
                  <div class="flex flex-wrap items-center justify-between">
                    <div class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                      <button class="py-2 hover:text-gray-700">
                        <svg width="12" height="2" viewbox="0 0 12 2" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="12" width="2" height="12" transform="rotate(90 12 0)" fill="currentColor"></rect></g></svg>
                      </button>
                      <input class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md" type="number" placeholder="1">
                      <button class="py-2 hover:text-gray-700">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="5" width="2" height="12" fill="currentColor"></rect><rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="currentColor"></rect></g></svg>
                      </button>
                    </div>
                    <p class="text-lg text-blue-500 font-bold font-heading">$29.89</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-10 items-center">
              <div class="w-full md:w-1/3 mb-6 md:mb-0 px-4">
                <div class="flex h-32 items-center justify-center bg-gray-100">
                  <img class="h-full object-contain" src="yofte-assets/images/basketball.png" alt="">
                </div>
              </div>
              <div class="w-full md:w-2/3 px-4">
                <div class="w-full">
                  <h3 class="mb-1 text-xl font-bold font-heading">Nike basketball ball</h3>
                  <p class="mb-4 text-gray-500">Lorem ipsum dolor L</p>
                  <div class="flex flex-wrap items-center justify-between">
                    <div class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                      <button class="py-2 hover:text-gray-700">
                        <svg width="12" height="2" viewbox="0 0 12 2" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="12" width="2" height="12" transform="rotate(90 12 0)" fill="currentColor"></rect></g></svg>
                      </button>
                      <input class="w-12 m-0 px-2 py-4 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md" type="number" placeholder="1">
                      <button class="py-2 hover:text-gray-700">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.35"><rect x="5" width="2" height="12" fill="currentColor"></rect><rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="currentColor"></rect></g></svg>
                      </button>
                    </div>
                    <p class="text-lg text-blue-500 font-bold font-heading">$29.89</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-6 md:p-12 bg-orange-900">
            <h2 class="mb-6 text-4xl font-bold font-heading text-white">Cart totals</h2>
            <div class="flex mb-8 items-center justify-between pb-5 border-b border-blue-100">
              <span class="text-blue-50">Subtotal</span>
              <span class="text-xl font-bold font-heading text-white">$89.67</span>
            </div>
            <h4 class="mb-2 text-xl font-bold font-heading text-white">Shipping</h4>
            <div class="flex mb-2 justify-between items-center">
              <span class="text-blue-50">Next day</span>
              <span class="text-xl font-bold font-heading text-white">$11.00</span>
            </div>
            <div class="flex mb-10 justify-between items-center">
              <span class="text-blue-50">Shipping to United States</span>
              <span class="text-xl font-bold font-heading text-white">-</span>
            </div>
            <div class="flex mb-10 justify-between items-center">
              <span class="text-xl font-bold font-heading text-white">Order total</span>
              <span class="text-xl font-bold font-heading text-white">$100.67</span>
            </div>
            <a class="block w-full py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200" href="#">Go to Checkout</a>
          </div>
        </div>
      </div>
                
@endsection