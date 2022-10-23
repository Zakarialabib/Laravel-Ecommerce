@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Add Slider') }} <a class="add-btn" href="{{route('admin-sl-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-index') }}">{{ __('Sliders') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-create') }}">{{ __('Add Slider') }}</a>
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
                      <form id="geniusform" action="{{route('admin-sl-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('alerts.admin.form-both')

                                      {{-- Sub Title Section --}}


                                      <div class="row">
                                        <div class="col-lg-3">
                                          <div class="left-area">
                                            <h4 class="heading">{{ __('Select Language') }}*</h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-7">
                                          <select name="language_id" required="">
                                              @foreach(DB::table('languages')->get() as $ldata)
                                              <option value="{{ $ldata->id }}">{{ $ldata->language }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                      </div>



                                      <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>{{ __('Sub Title') }}</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="subtitle_text">{{ __('Text') }}*</label>
                                                  <textarea class="form-control" name="subtitle_text" id="subtitle_text" rows="5"  placeholder="{{ __('Enter Title Text') }}"></textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="subtitle_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="subtitle_size" value="" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="subtitle_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="subtitle_color" value="#000000"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="subtitle_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="subtitle_anime" name="subtitle_anime">
                                                                <option value="fadeIn">fadeIn</option>
                                                                <option value="fadeInDown">fadeInDown</option>
                                                                <option value="fadeInLeft">fadeInLeft</option>
                                                                <option value="fadeInRight">fadeInRight</option>
                                                                <option value="fadeInUp">fadeInUp</option>
                                                                <option value="flip">flip</option>
                                                                <option value="flipInX">flipInX</option>
                                                                <option value="flipInY">flipInY</option>
                                                                <option value="slideInUp">slideInUp</option>
                                                                <option value="slideInDown">slideInDown</option>
                                                                <option value="slideInLeft">slideInLeft</option>
                                                                <option value="slideInRight">slideInRight</option>
                                                                <option value="rollIn">rollIn</option>
                                                          </select>
                                                    </div>
                                                   </div>

                                                </div>
                                              </div>
                                        </div>
                                        </div>

                                      {{-- Sub Title Section Ends--}}


                                      {{-- Title Section --}}

                                      <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>{{ __('Title') }}</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="title_text">{{ __('Text') }}*</label>

                                                  <textarea class="form-control" name="title_text" id="title_text" rows="5"  placeholder="{{ __('Enter Title Text') }}"></textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="title_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="title_size" value="" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="title_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="title_color" value="#000000"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="title_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="title_anime" name="title_anime">
                                                                <option value="fadeIn">fadeIn</option>
                                                                <option value="fadeInDown">fadeInDown</option>
                                                                <option value="fadeInLeft">fadeInLeft</option>
                                                                <option value="fadeInRight">fadeInRight</option>
                                                                <option value="fadeInUp">fadeInUp</option>
                                                                <option value="flip">flip</option>
                                                                <option value="flipInX">flipInX</option>
                                                                <option value="flipInY">flipInY</option>
                                                                <option value="slideInUp">slideInUp</option>
                                                                <option value="slideInDown">slideInDown</option>
                                                                <option value="slideInLeft">slideInLeft</option>
                                                                <option value="slideInRight">slideInRight</option>
                                                                <option value="rollIn">rollIn</option>
                                                          </select>
                                                    </div>
                                                   </div>

                                                </div>
                                              </div>
                                        </div>
                                        </div>

                                      {{-- Title Section Ends--}}


                                      {{-- Details Section --}}

                                      <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>{{ __('Description') }}</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="details_text">{{ __('Text') }}*</label>

                                                  <textarea class="form-control" name="details_text" id="details_text" rows="5"  placeholder="{{ __('Enter Title Text') }}"></textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="details_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="details_size" value="" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="details_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="details_color" value="#000000"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="details_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="details_anime" name="details_anime">
                                                                <option value="fadeIn">fadeIn</option>
                                                                <option value="fadeInDown">fadeInDown</option>
                                                                <option value="fadeInLeft">fadeInLeft</option>
                                                                <option value="fadeInRight">fadeInRight</option>
                                                                <option value="fadeInUp">fadeInUp</option>
                                                                <option value="flip">flip</option>
                                                                <option value="flipInX">flipInX</option>
                                                                <option value="flipInY">flipInY</option>
                                                                <option value="slideInUp">slideInUp</option>
                                                                <option value="slideInDown">slideInDown</option>
                                                                <option value="slideInLeft">slideInLeft</option>
                                                                <option value="slideInRight">slideInRight</option>
                                                                <option value="rollIn">rollIn</option>
                                                          </select>
                                                    </div>
                                                   </div>

                                                </div>
                                              </div>
                                        </div>
                                        </div>

                                      {{-- Title Section Ends--}}


                        <div class="row">
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
                                  <p class="text">{{ __('Prefered Size: (1920x800) or Square Sized Image') }}</p>
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
                            <input type="text" class="input-field" name="link" placeholder="{{ __('Link') }}" required="" value="">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Text Position') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select  name="position" required="">
                                  <option value="">{{ __('Select Position') }}</option>
                                  <option value="left">{{ __('Left') }}</option>
                                  <option value="center">{{ __('Center') }}</option>
                                  <option value="right">{{ __('Right') }}</option>
                                </select>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">

                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Slider') }}</button>
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
