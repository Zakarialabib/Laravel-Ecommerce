@extends('layouts.load')




@section('content')

            <div class="content-area">

              <div class="add-product-content1">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area" id="modalEdit">
                        @include('alerts.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-order-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Payment Status') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select name="payment_status" required="">
                                <option value="Pending" {{$data->payment_status == 'Pending' ? "selected":""}}>{{ __('Unpaid') }}</option>
                                <option value="Completed" {{$data->payment_status == 'Completed' ? "selected":""}}>{{ __('Paid') }}</option>
                              </select>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Delivery Status') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select name="status" required="">
                                <option value="pending" {{ $data->status == "pending" ? "selected":"" }}>{{ __('Pending') }}</option>
                                <option value="processing" {{ $data->status == "processing" ? "selected":"" }}>{{ __('Processing') }}</option>
                                <option value="on delivery" {{ $data->status == "on delivery" ? "selected":"" }}>{{ __('On Delivery') }}</option>
                                <option value="completed" {{ $data->status == "completed" ? "selected":"" }}>{{ __('Completed') }}</option>
                                <option value="declined" {{ $data->status == "declined" ? "selected":"" }}>{{ __('Declined') }}</option>
                              </select>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Track Note') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <textarea class="input-field" name="track_text" placeholder="{{ __('Enter Track Note Here') }}"></textarea>
                          </div>
                        </div>



                        <br>
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

@section('scripts')





@endsection

