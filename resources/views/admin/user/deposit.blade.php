@extends('layouts.load')
@section('content')

						<div class="content-area">
							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">
                        					@include('alerts.admin.form-error') 
											<form id="geniusformdata" action="{{ route('admin-user-deposit-update',$data->id) }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}


												<div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="left-area">
                                                                    <h4 class="heading">{{ __("Current Balance") }} *</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <h6 class="heading">{{ $sign->sign }}{{ $data->balance }} </h6>
                                                        </div>
                                                    </div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
                                                                <h4 class="heading">{{ __("Amount") }} *</h4>
                                                                <p class="sub-heading">({{ __("In") }} {{ $sign->name }})</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" class="input-field" name="amount" placeholder="{{ __("Amount") }}" required="" value="1" min="1" step="0.1">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Details") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="details" placeholder="{{ __("Details") }}" required="" value="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Action") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
                                                        <select class="input-field" name="type">
                                                            <option value="plus">{{__('Add')}}</option>
                                                            <option value="minus">{{__('Subtract')}}</option>
                                                        </select>
													</div>
												</div>


                                                <input type="hidden" name="currency_sign" value="{{ $sign->sign }}">
                                                <input type="hidden" name="currency_code" value="{{ $sign->name }}">
						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ __("Submit") }}</button>
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