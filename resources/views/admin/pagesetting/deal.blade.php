@extends('layouts.admin')

@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Edit Deal Of The Day') }} <a class="add-btn"
                            href="{{ route('admin-gs-deal') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                    <ul class="links">

                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-gs-deal') }}">{{ __('Deal Of The Day') }}</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="add-product-content1 add-product-content2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <div class="gocover"
                                style="background: url({{ asset('assets/images/' . $gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                            </div>
                            <form id="geniusform" action="{{ route('admin-gs-update') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include('alerts.admin.form-both')
                                {{-- Sub Title Section --}}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="subtitle_text">{{ __('Text') }}*</label>
                                        <input type="text" class="form-control" name="deal_title"
                                            value="{{ $gs->deal_title }}" placeholder="Add title here">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="subtitle_text">{{ __('Details') }}*</label>
                                        <input type="text" class="form-control" name="deal_details"
                                            value="{{ $gs->deal_details }}" placeholder="Add details here">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="subtitle_text">{{ __('Date Limit') }}*</label>
                                        <input type="date" class="form-control" name="deal_time"
                                            value="{{ $gs->deal_time }}" placeholder="Add Date here">
                                    </div>
                                </div>
                                {{-- Sub Title Section Ends --}}
                                <div class="row mt-5">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview"
                                                style="background: url({{ $gs->deal_background ? asset('assets/images/' . $gs->deal_background) : asset('assets/images/noimage.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i
                                                        class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                <input type="file" name="deal_background" class="img-upload"
                                                    id="image-upload">
                                            </div>
                                            <p class="text">{{ __('Prefered Size: (1920x800) or Square Sized Image') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn"
                                            type="submit">{{ __('Update Deal') }}</button>
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
