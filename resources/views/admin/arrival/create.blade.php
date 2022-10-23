@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Add Arrival') }} <a class="add-btn" href="{{route('admin-arrival-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-arrival-index') }}">{{ __('Arrival') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-arrival-create') }}">{{ __('Add Arrival') }}</a>
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
                      <form id="geniusform" action="{{route('admin-arrival-store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('alerts.admin.form-both')
                                      {{-- Sub Title Section --}}
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="subtitle_text">{{ __('Text') }}*</label>
                                                  <input type="text" class="form-control" name="title" placeholder="Add title here">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <div class="col-sm-12">
                                                  <label class="control-label" for="subtitle_text">{{ __('Header') }}*</label>
                                                <input type="text" class="form-control" name="header" placeholder="Add header here">
                                              </div>
                                            </div>
                                      {{-- Sub Title Section Ends--}}
                        <div class="row mt-5">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload full-width-img">
                                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                  </div>
                                  <p class="text">{{ __('Prefered Size: (600x770) or Square Sized Image') }}</p>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">

                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Arrival') }}</button>
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
