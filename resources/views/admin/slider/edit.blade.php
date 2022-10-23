@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Edit Slider') }} <a class="add-btn" href="{{route('admin-sl-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
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
                          <a href="{{route('admin-sl-edit',$data->id)}}">{{ __('Edit') }}</a>
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
                      <form id="geniusform" action="{{route('admin-sl-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('alerts.admin.form-both')



                      <div class="row">
                        <div class="col-lg-3">
                          <div class="left-area">
                            <h4 class="heading">{{ __('Select Language') }}*</h4>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <select name="language_id" required="">
                              @foreach(DB::table('languages')->get() as $ldata)
                              <option value="{{ $ldata->id }}" {{ $ldata->id == $data->language_id ? 'selected' : '' }}>{{ $ldata->language }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                                      {{-- Sub Title Section --}}

                                      <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>{{ __('Sub Title') }}</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="subtitle_text">{{ __('Text') }}*</label>

                                                  <textarea class="form-control" name="subtitle_text" id="subtitle_text" rows="5"  placeholder="{{ __('Enter Title Text') }}">{{$data->subtitle_text}}</textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="subtitle_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="subtitle_size" value="{{$data->subtitle_size}}" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="subtitle_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="subtitle_color" value="{{$data->subtitle_color}}"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="subtitle_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="subtitle_anime" name="subtitle_anime">
                                                                <option value="fadeIn" {{$data->subtitle_anime == 'fadeIn' ? 'selected' :''}}>fadeIn</option>
                                                                <option value="fadeInDown" {{$data->subtitle_anime == 'fadeInDown' ? 'selected' :''}}>fadeInDown</option>
                                                                <option value="fadeInLeft" {{$data->subtitle_anime == 'fadeInLeft' ? 'selected' :''}}>fadeInLeft</option>
                                                                <option value="fadeInRight" {{$data->subtitle_anime == 'fadeInRight' ? 'selected' :''}}>fadeInRight</option>
                                                                <option value="fadeInUp" {{$data->subtitle_anime == 'fadeInUp' ? 'selected' :''}}>fadeInUp</option>
                                                                <option value="flip" {{$data->subtitle_anime == 'flip' ? 'selected' :''}}>flip</option>
                                                                <option value="flipInX" {{$data->subtitle_anime == 'flipInX' ? 'selected' :''}}>flipInX</option>
                                                                <option value="flipInY" {{$data->subtitle_anime == 'flipInY' ? 'selected' :''}}>flipInY</option>
                                                                <option value="slideInUp" {{$data->subtitle_anime == 'slideInUp' ? 'selected' :''}}>slideInUp</option>
                                                                <option value="slideInDown" {{$data->subtitle_anime == 'slideInDown' ? 'selected' :''}}>slideInDown</option>
                                                                <option value="slideInLeft" {{$data->subtitle_anime == 'slideInLeft' ? 'selected' :''}}>slideInLeft</option>
                                                                <option value="slideInRight" {{$data->subtitle_anime == 'slideInRight' ? 'selected' :''}}>slideInRight</option>
                                                                <option value="rollIn" {{$data->subtitle_anime == 'rollIn' ? 'selected' :''}}>rollIn</option>
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

                                                  <textarea class="form-control" name="title_text" id="title_text" rows="5"  placeholder="{{ __('Enter Title Text') }}">{{$data->title_text}}</textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="title_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="title_size" value="{{$data->title_size}}" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="title_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="title_color" value="{{$data->title_color}}"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="title_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="title_anime" name="title_anime">
                                                                <option value="fadeIn" {{$data->title_anime == 'fadeIn' ? 'selected' :''}}>fadeIn</option>
                                                                <option value="fadeInDown" {{$data->title_anime == 'fadeInDown' ? 'selected' :''}}>fadeInDown</option>
                                                                <option value="fadeInLeft" {{$data->title_anime == 'fadeInLeft' ? 'selected' :''}}>fadeInLeft</option>
                                                                <option value="fadeInRight" {{$data->title_anime == 'fadeInRight' ? 'selected' :''}}>fadeInRight</option>
                                                                <option value="fadeInUp" {{$data->title_anime == 'fadeInUp' ? 'selected' :''}}>fadeInUp</option>
                                                                <option value="flip" {{$data->title_anime == 'flip' ? 'selected' :''}}>flip</option>
                                                                <option value="flipInX" {{$data->title_anime == 'flipInX' ? 'selected' :''}}>flipInX</option>
                                                                <option value="flipInY" {{$data->title_anime == 'flipInY' ? 'selected' :''}}>flipInY</option>
                                                                <option value="slideInUp" {{$data->title_anime == 'slideInUp' ? 'selected' :''}}>slideInUp</option>
                                                                <option value="slideInDown" {{$data->title_anime == 'slideInDown' ? 'selected' :''}}>slideInDown</option>
                                                                <option value="slideInLeft" {{$data->title_anime == 'slideInLeft' ? 'selected' :''}}>slideInLeft</option>
                                                                <option value="slideInRight" {{$data->title_anime == 'slideInRight' ? 'selected' :''}}>slideInRight</option>
                                                                <option value="rollIn" {{$data->title_anime == 'rollIn' ? 'selected' :''}}>rollIn</option>
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

                                                  <textarea class="form-control" name="details_text" id="details_text" rows="5"  placeholder="Enter Title Text">{{$data->details_text}}</textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-4">
                                                      <label class="control-label" for="details_size">{{ __('Font Size') }} *<span> {{ __('(px)') }}</span></label>
                                                      <input class="form-control" type="number" name="details_size" value="{{$data->details_size}}" min="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="details_color">{{ __('Font Color') }} *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="details_color" value="{{$data->details_color}}"  class="form-control cp" />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="details_anime">{{ __('Animation') }} *</label>
                                                          <select class="form-control" id="details_anime" name="details_anime">
                                                                <option value="fadeIn" {{$data->details_anime == 'fadeIn' ? 'selected' :''}}>fadeIn</option>
                                                                <option value="fadeInDown" {{$data->details_anime == 'fadeInDown' ? 'selected' :''}}>fadeInDown</option>
                                                                <option value="fadeInLeft" {{$data->details_anime == 'fadeInLeft' ? 'selected' :''}}>fadeInLeft</option>
                                                                <option value="fadeInRight" {{$data->details_anime == 'fadeInRight' ? 'selected' :''}}>fadeInRight</option>
                                                                <option value="fadeInUp" {{$data->details_anime == 'fadeInUp' ? 'selected' :''}}>fadeInUp</option>
                                                                <option value="flip" {{$data->details_anime == 'flip' ? 'selected' :''}}>flip</option>
                                                                <option value="flipInX" {{$data->details_anime == 'flipInX' ? 'selected' :''}}>flipInX</option>
                                                                <option value="flipInY" {{$data->details_anime == 'flipInY' ? 'selected' :''}}>flipInY</option>
                                                                <option value="slideInUp" {{$data->details_anime == 'slideInUp' ? 'selected' :''}}>slideInUp</option>
                                                                <option value="slideInDown" {{$data->details_anime == 'slideInDown' ? 'selected' :''}}>slideInDown</option>
                                                                <option value="slideInLeft" {{$data->details_anime == 'slideInLeft' ? 'selected' :''}}>slideInLeft</option>
                                                                <option value="slideInRight" {{$data->details_anime == 'slideInRight' ? 'selected' :''}}>slideInRight</option>
                                                                <option value="rollIn" {{$data->details_anime == 'rollIn' ? 'selected' :''}}>rollIn</option>
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
                                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/sliders/'.$data->photo):asset('assets/images/noimage.png') }});">
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
                            <input type="text" class="input-field" name="link" placeholder="Link" required="" value="{{$data->link}}">

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
                                  <option value="left" {{ $data->position == 'left' ? 'selected':'' }}>{{ __('Left') }}</option>
                                  <option value="center" {{ $data->position  == 'center' ? 'selected':'' }}>{{ __('Center') }}</option>
                                  <option value="right" {{ $data->position  == 'right' ? 'selected':'' }}>{{ __('Right') }}</option>
                                </select>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">

                            </div>
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
