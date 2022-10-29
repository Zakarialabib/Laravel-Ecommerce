@extends('layouts.dashboard')
@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Website Logo') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('General Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-gs-logo') }}">{{ __('Website Logo') }}</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="add-logo-area">
            <div class="gocover"
                style="background: url({{ asset('assets/images/' . $gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="special-box bg-gray">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Header Logo') }}
                            </h4>
                        </div>

                        <form class="uplogo-form" id="geniusform" action="{{ route('admin-gs-update') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <x-form-alert />
                            <div class="currrent-logo">
                                <img src="{{ $gs->logo ? asset('assets/images/' . $gs->logo) : asset('assets/images/noimage.png') }}"
                                    alt="">
                            </div>
                            <div class="set-logo">
                                <input class="img-upload1" type="file" name="logo">
                            </div>

                            <div class="submit-area mb-4">
                                <button type="submit" class="submit-btn">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="special-box  bg-gray">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Footer Logo') }}
                            </h4>
                        </div>

                        <form class="uplogo-form" id="geniusform" action="{{ route('admin-gs-update') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <x-form-alert />
                            <div class="currrent-logo">
                                <img src="{{ $gs->footer_logo ? asset('assets/images/' . $gs->footer_logo) : asset('assets/images/noimage.png') }}"
                                    alt="">
                            </div>
                            <div class="set-logo">
                                <input class="img-upload1" type="file" name="footer_logo">
                            </div>

                            <div class="submit-area mb-4">
                                <button type="submit" class="submit-btn">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="special-box  bg-gray">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Invoice Logo') }}
                            </h4>
                        </div>

                        <form class="uplogo-form" id="geniusform" action="{{ route('admin-gs-update') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <x-form-alert />

                            <div class="currrent-logo">
                                <img src="{{ $gs->invoice_logo ? asset('assets/images/' . $gs->invoice_logo) : asset('assets/images/noimage.png') }}"
                                    alt="">
                            </div>

                            <div class="set-logo">
                                <input class="img-upload1" type="file" name="invoice_logo">
                            </div>


                            <div class="submit-area mb-4">
                                <button type="submit" class="submit-btn">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
