@extends('layouts.load')
@section('content')


{{-- ADD ORDER TRACKING --}}

                            <div class="add-product-content1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area" id="modalEdit">
                                                <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                            <input type="hidden" id="track-store" value="{{route('admin-order-track-store')}}">
                                            <form id="trackform" action="{{route('admin-order-track-store')}}" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                @include('alerts.admin.form-both')  

                                                <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="left-area">
                                                                <h4 class="heading">{{ __('Title') }} *</h4>
                                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <textarea class="input-field" id="track-title" name="title" placeholder="{{ __('Title') }}" required=""></textarea>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="left-area">
                                                                <h4 class="heading">{{ __('Details') }} *</h4>
                                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <textarea class="input-field" id="track-details" name="text" placeholder="{{ __('Details') }}" required=""></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="left-area">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <button class="addProductSubmit-btn" id="track-btn" type="submit">{{ __('ADD') }}</button>
                                                        <button class="addProductSubmit-btn ml=3 d-none" id="cancel-btn" type="button">{{ __('Cancel') }}</button>
                                                        <input type="hidden" id="add-text" value="{{ __('ADD') }}">
                                                        <input type="hidden" id="edit-text" value="{{ __('UPDATE') }}">
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<hr>

                                                <h5 class="text-center">{{__('TRACKING DETAILS')}}</h5>

<hr>

{{-- ORDER TRACKING DETAILS --}}

						<div class="content-area no-padding">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">


                                    <div class="table-responsive show-table ml-3 mr-3">
                                        <table class="table" id="track-load" data-href={{ route('admin-order-track-load',$order->id) }}>
                                            <tr>
                                                <th>{{ __("Title") }}</th>
                                                <th>{{ __("Details") }}</th>
                                                <th>{{ __("Date") }}</th>
                                                <th>{{ __("Time") }}</th>
                                                <th>{{ __("Options") }}</th>
                                            </tr>
                                            @foreach($order->tracks as $track)

                                            <tr data-id="{{ $track->id }}">
                                                <td width="30%" class="t-title">{{ $track->title }}</td>
                                                <td width="30%" class="t-text">{{ $track->text }}</td>
                                                <td>{{  date('Y-m-d',strtotime($track->created_at)) }}</td>
                                                <td>{{  date('h:i:s:a',strtotime($track->created_at)) }}</td>
                                                <td>
                                                    <div class="action-list">
                                                        <a data-href="{{ route('admin-order-track-update',$track->id) }}" class="track-edit"> <i class="fas fa-edit"></i>{{__('Edit')}}</a>
                                                        <a href="javascript:;" data-href="{{ route('admin-order-track-delete',$track->id) }}" class="track-delete"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection