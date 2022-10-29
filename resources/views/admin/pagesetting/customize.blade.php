@extends('layouts.dashboard')

@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Home Page Customization') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-ps-customize') }}">{{ __('Home Page Customization') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="social-links-area">
                            <div class="gocover"
                                style="background: url({{ asset('assets/images/' . $gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                            </div>
                            <form id="geniusform" action="{{ route('admin-ps-homeupdate') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <x-form-alert />

                                <div class="row justify-content-center">

                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label" for="category">{{ __('Featured Products') }} *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="category" value="1"
                                                {{ $data->category == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label" for="slider">{{ __('Slider') }} *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="slider" value="1"
                                                {{ $data->slider == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                </div>

                                <div class="row justify-content-center">

                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label"
                                            for="top_big_trending">{{ __('Top Rated, Big Save & Trending') }} *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="top_big_trending" value="1"
                                                {{ $data->top_big_trending == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2"></div>

                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label" for="partner">{{ __('Partner') }} *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="partner" value="1"
                                                {{ $data->partner == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row justify-content-center">

                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label" for="best_sellers">{{ __('Best Selling Product') }}
                                            *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="best_sellers" value="1"
                                                {{ $data->best_sellers == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="col-lg-2"></div>
                                    
                                    <div class="col-lg-4 d-flex justify-content-between">
                                        <label class="control-label" for="blog">{{ __('Blogs') }} *</label>
                                        <label class="switch">
                                            <input type="checkbox" name="blog" value="1"
                                                {{ $data->blog == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="submit-btn">{{ __('Submit') }}</button>
                                    </div>
                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
