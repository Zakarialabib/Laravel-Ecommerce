@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Affialte Program') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-gs-affilate') }}">{{ __('Affialte Program') }}</a>
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
                        <form action="{{ route('admin-gs-update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          @csrf

                        @include('alerts.admin.form-both')  

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    {{ __('Web Based Affilate') }}
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select class="process select droplinks {{ $gs->is_affilate == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-gs-status',['is_affilate',1])}}" {{ $gs->is_affilate == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                      <option data-val="0" value="{{route('admin-gs-status',['is_affilate',0])}}" {{ $gs->is_affilate == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                    </select>
                                  </div>
                            </div>
                          </div>

                          <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{ __('Product Based Affilate') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select
                                        class="process select droplinks {{ $gs->product_affilate == 1 ? 'drop-success' : 'drop-danger' }}">
                                        <option data-val="1" value="{{route('admin-gs-status',['product_affilate',1])}}"
                                            {{ $gs->product_affilate == 1 ? 'selected' : '' }}>{{ __('Activated') }}
                                        </option>
                                        <option data-val="0" value="{{route('admin-gs-status',['product_affilate',0])}}"
                                            {{ $gs->product_affilate == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Affilate Bonus(%)') }}</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Your Site Title Here') }}" name="affilate_charge" value="{{ $gs->affilate_charge }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="img-upload">
                                        <div id="image-preview" class="img-preview text-center" style="background: url({{ $gs->affilate_banner ? asset('assets/images/'.$gs->affilate_banner):asset('assets/images/noimage.png') }});">
                                            <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                            <input type="file" name="affilate_banner" class="img-upload">
                                          </div>
                                    </div>

                            </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
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