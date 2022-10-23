@extends('layouts.load')
@section('content')

						<div class="content-area no-padding">
							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">{{ __("Customer Name") }}</th>
                                                <td>{{ $data->user['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __("Amount") }}</th>
                                                <td>{{ $data->type == 'plus' ? '+':'-' }}{{ \PriceHelper::showOrderCurrencyPrice(($data->amount * $data->currency_value),$data->currency_sign) }}</td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __("Transaction ID") }}</th>
                                                <td>{{ $data->txn_number }}</td>
                                            </tr>
                                            @if($data->method != null)
                                            <tr>
                                                <th width="50%">{{ __("Method") }}</th>
                                                <td>{{ $data->method  }}</td>
                                            </tr>
                                            @endif
                                            @if($data->txnid != null)
                                            <tr>
                                                <th width="50%">{{ $data->method  }} {{ __("Transaction ID") }}</th>
                                                <td>{{ $data->txnid }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th width="50%">{{ __("Details") }}</th>
                                                <td>{{ $data->details  }}</td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __("Transaction Date") }}</th>
                                                <td>{{ $data->created_at  }}</td>
                                            </tr>
                                        </table>
                                    </div>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection