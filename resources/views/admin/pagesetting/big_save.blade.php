@extends('layouts.admin')
@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Left Side Banner2') }} </h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Home Page Settings') }} </a>
                        </li>
                        <li>
                          <a href="{{ route('admin-ps-best-seller') }}">{{ __('Left Side Banner2') }} </a>
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

                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{ route('admin-ps-update') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        @include('alerts.admin.form-both')  

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              <h4 class="heading"> {{ __('Banner Image') }} *</h4>
                              <small>{{ __('(Preferred SIze: 250 X 444 Pixel)') }}</small>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload">
                              <div id="image-preview" class="img-preview" style="background: url({{ $data->big_save_banner ? asset('assets/images/'.$data->big_save_banner):asset('assets/images/noimage.png') }});">
                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                <input type="file" name="big_save_banner" class="img-upload" id="image-upload">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Link') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="big_save_banner_link" placeholder="{{ __('Link') }}" required="" value="{{$data->big_save_banner_link}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area"></div>
                          </div>
                          <div class="col-lg-7">
                              <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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