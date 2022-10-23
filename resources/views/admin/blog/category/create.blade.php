@extends('layouts.load')
@section('content')

						<div class="content-area">

							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
											@include('alerts.admin.form-error') 
											<form id="geniusformdata" action="{{route('admin-cblog-create')}}" method="POST" enctype="multipart/form-data">
												
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
																<h4 class="heading">{{ __('Name') }} *</h4>
																<p class="sub-heading">{{ __('(In French)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="name" placeholder="{{ __('Name') }}" required="" value="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Slug') }} *</h4>
																<p class="sub-heading">{{ __('(In French)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="slug" placeholder="{{ __('Slug') }}" required="" value="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7">
														<button class="addProductSubmit-btn" type="submit">{{ __('Create Category') }}</button>
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