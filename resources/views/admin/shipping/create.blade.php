@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content1">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area" id="modalEdit">
                        @include('alerts.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-shipping-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}


												<div class="row">
													<div class="col-lg-4">
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

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Title') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="title" placeholder="{{ __('Title') }}" required="" value="">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Duration') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="subtitle" placeholder="{{ __('Duration') }}" required="" value="">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Price') }} *</h4>
                                <p class="sub-heading">({{ __('In') }} {{ $sign->name }})</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="number" class="input-field" name="price" placeholder="{{ __('Price') }}" required="" value="" min="0" step="0.01">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create') }}</button>
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