@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="heading">{{ __('Customize Menu Links') }}</h4>
        <ul class="links">
          <li>
            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
          </li>
          <li>
            <a href="javascript:;">{{ __('Menu Page Settings') }}</a>
          </li>
          <li>
            <a href="{{ route('admin-ps-menu-links') }}">{{ __('Customize Menu Links') }}</a>
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
              style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <form id="geniusform" action="{{ route('admin-ps-menuupdate') }}" method="POST"
              enctype="multipart/form-data">
              @csrf

              @include('alerts.admin.form-both')

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="home">{{ __('Home') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="home" value="1" {{$data->home==1?"checked":""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="blog">{{ __('Blog') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="blog" value="1" {{$data->blog==1?"checked":""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="faq">{{ __('Faq') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="faq" value="1" {{$data->faq==1?"checked":""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="contact_us">{{ __('Contact Us') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="contact" value="1" {{$data->contact==1?"checked":""}}>
                    <span class="slider round"></span>
                  </label>
                </div>
                
              </div>

              <br>

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