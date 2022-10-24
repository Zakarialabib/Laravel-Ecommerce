@extends('layouts.admin')

@section('styles')
    <style type="text/css">
        .order-table-wrap table#example2 {
            margin: 10px 20px;
        }
    </style>
@endsection


@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i
                                class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Orders') }}</a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Order Details') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="order-table-wrap">
            <div class="row">

                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Order Details') }}
                            </h4>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="45%" width="45%">{{ __('Order ID') }}</th>
                                        <td width="10%">:</td>
                                        <td class="45%" width="45%">{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Total Product') }}</th>
                                        <td width="10%">:</td>
                                        <td width="45%">{{ $order->totalQty }}</td>
                                    </tr>
                                    @if ($order->shipping_title != null)
                                        <tr>
                                            <th width="45%">{{ __('Shipping Method') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">{{ $order->shipping_title }}</td>
                                        </tr>
                                    @endif

                                    @if ($order->shipping_cost != 0)
                                        <tr>
                                            <th width="45%">{{ __('Shipping Cost') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">
                                                {{ \PriceHelper::showOrderCurrencyPrice($order->shipping_cost, $order->currency_sign) }}
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($order->tax != 0)
                                        <tr>
                                            <th width="45%">{{ __('Tax :') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">
                                                {{ \PriceHelper::showOrderCurrencyPrice($order->tax / $order->currency_value, $order->currency_sign) }}
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($order->packing_title != null)
                                        <tr>
                                            <th width="45%">{{ __('Packaging Method') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">{{ $order->packing_title }}</td>
                                        </tr>
                                    @endif

                                    @if ($order->packing_cost != 0)
                                        <tr>
                                            <th width="45%">{{ __('Packaging Cost') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">
                                                {{ \PriceHelper::showOrderCurrencyPrice($order->packing_cost, $order->currency_sign) }}
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th width="45%">{{ __('Total Cost') }}</th>
                                        <td width="10%">:</td>
                                        <td width="45%">
                                            {{ \PriceHelper::showOrderCurrencyPrice(($order->pay_amount + $order->wallet_price) * $order->currency_value, $order->currency_sign) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Ordered Date') }}</th>
                                        <td width="10%">:</td>
                                        <td width="45%">{{ date('d-M-Y H:i:s a', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Payment Method') }}</th>
                                        <td width="10%">:</td>
                                        <td width="45%">{{ $order->method }}</td>
                                    </tr>

                                    @if ($order->method != 'Cash On Delivery' && $order->method != 'Wallet')
                                        @if ($order->method == 'Stripe')
                                            <tr>
                                                <th width="45%">{{ $order->method }} {{ __('Charge ID') }}</th>
                                                <td width="10%">:</td>
                                                <td width="45%">{{ $order->charge_id }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th width="45%">{{ $order->method }} {{ __('Transaction ID') }}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">{{ $order->txnid }}</td>
                                        </tr>
                                    @endif


                                    <th width="45%">{{ __('Payment Status') }}</th>
                                    <th width="10%">:</th>

                                    @if ($order->payment_status == 'Pending')
                                        <span class='badge badge-danger'>{{ __('Unpaid') }}</span>
                                    @else
                                        <span class='badge badge-success'>{{ __('Paid') }}</span>
                                    @endif

                                    @if (!empty($order->order_note))
                                        <th width="45%">{{ __('Order Note') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->order_note }}</td>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="footer-area">
                            <a href="{{ route('admin-order-invoice', $order->id) }}" class="btn_1 "><i
                                    class="fas fa-eye"></i> {{ __('View Invoice') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Billing Details') }}
                                <a class="f15" href="javascript:;" data-toggle="modal"
                                    data-target="#billing-details-edit"><i class="fas fa-edit"></i>{{ __('Edit') }}</a>
                            </h4>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="45%">{{ __('Full Name') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_name }} {{$order->customer_lastname}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Email') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_email }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Phone') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Address') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_address }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Country') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_country }}</td>
                                    </tr>
                                    @if ($order->customer_state != null)
                                        <tr>
                                            <th width="45%">{{ __('State') }}</th>
                                            <th width="10%">:</th>
                                            <td width="45%">{{ $order->customer_state }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th width="45%">{{ __('City') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_city }}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{ __('Postal Code') }}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $order->customer_zip }}</td>
                                    </tr>
                                    @if ($order->coupon_code != null)
                                        <tr>
                                            <th width="45%">{{ __('Coupon Code') }}</th>
                                            <th width="10%">:</th>
                                            <td width="45%">{{ $order->coupon_code }}</td>
                                        </tr>
                                    @endif
                                    @if ($order->coupon_discount != null)
                                        <tr>
                                            <th width="45%">{{ __('Coupon Discount') }}</th>
                                            <th width="10%">:</th>
                                            @if ($gs->currency_format == 0)
                                                <td width="45%">
                                                    {{ $order->currency_sign }}{{ $order->coupon_discount }}</td>
                                            @else
                                                <td width="45%">
                                                    {{ $order->coupon_discount }}{{ $order->currency_sign }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 order-details-table">
                    <div class="mr-table">
                        <h4 class="title">
                            {{ __('Products Ordered') }}
                            <a class="f15" href="javascript:;" data-toggle="modal" class="add-btn-small pl-2"
                                data-target="#add-product"><i class="fas fa-plus"></i>{{ __('Add Product') }}</a>
                        </h4>
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>{{ __('Product ID#') }}</th>
                                        <th>{{ __('Shop Name') }}</th>
                                        <th>{{ __('Vendor Status') }}</th>
                                        <th>{{ __('Product Title') }}</th>
                                        <th>{{ __('Details') }}</th>
                                        <th>{{ __('Total Price') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart['items'] as $key1 => $product)
                                        <tr>

                                            <td><input type="hidden"
                                                    value="{{ $key1 }}">{{ $product['item']['id'] }}</td>

                                            <td>
                                                @if ($product['item']['user_id'] != 0)
                                                    @php
                                                        $user = App\Models\User::find($product['item']['user_id']);
                                                    @endphp
                                                    @if (isset($user))
                                                        <a target="_blank"
                                                            href="{{ route('admin-vendor-show', $user->id) }}">{{ $user->shop_name }}</a>
                                                    @else
                                                        {{ __('Vendor Removed') }}
                                                    @endif
                                                @else
                                                    <a href="javascript:;">{{ App\Models\Admin::find(1)->shop_name }}</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($product['item']['user_id'] != 0)
                                                    @php
                                                        $user = App\Models\VendorOrder::where('order_id', '=', $order->id)
                                                            ->where('user_id', '=', $product['item']['user_id'])
                                                            ->first();
                                                        
                                                    @endphp

                                                    @if ($order->dp == 1 && $order->payment_status == 'Completed')
                                                        <span class="badge badge-success">{{ __('Completed') }}</span>
                                                    @else
                                                        @if ($user->status == 'pending')
                                                            <span
                                                                class="badge badge-warning">{{ ucwords($user->status) }}</span>
                                                        @elseif($user->status == 'processing')
                                                            <span
                                                                class="badge badge-info">{{ ucwords($user->status) }}</span>
                                                        @elseif($user->status == 'on delivery')
                                                            <span
                                                                class="badge badge-primary">{{ ucwords($user->status) }}</span>
                                                        @elseif($user->status == 'completed')
                                                            <span
                                                                class="badge badge-success">{{ ucwords($user->status) }}</span>
                                                        @elseif($user->status == 'declined')
                                                            <span
                                                                class="badge badge-danger">{{ ucwords($user->status) }}</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>


                                            <td>
                                                <input type="hidden" value="{{ $product['license'] }}">

                                                @if ($product['item']['user_id'] != 0)
                                                    @php
                                                        $user = App\Models\User::find($product['item']['user_id']);
                                                    @endphp
                                                    @if (isset($user))
                                                        <a target="_blank"
                                                            href="{{ route('front.product', $product['item']['slug']) }}">{{ mb_strlen($product['item']['name'], 'utf-8') > 30 ? mb_substr($product['item']['name'], 0, 30, 'utf-8') . '...' : $product['item']['name'] }}</a>
                                                    @else
                                                        <a target="_blank"
                                                            href="{{ route('front.product', $product['item']['slug']) }}">{{ mb_strlen($product['item']['name'], 'utf-8') > 30 ? mb_substr($product['item']['name'], 0, 30, 'utf-8') . '...' : $product['item']['name'] }}</a>
                                                    @endif
                                                @else
                                                    <a target="_blank"
                                                        href="{{ route('front.product', $product['item']['slug']) }}">{{ mb_strlen($product['item']['name'], 'utf-8') > 30 ? mb_substr($product['item']['name'], 0, 30, 'utf-8') . '...' : $product['item']['name'] }}</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($product['size'])
                                                    <p>
                                                        <strong>{{ __('Size') }} :</strong>
                                                        {{ str_replace('-', ' ', $product['size']) }}
                                                    </p>
                                                @endif
                                                @if ($product['color'])
                                                    <p>
                                                        <strong>{{ __('color') }} :</strong> <span
                                                            style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; border-radius: 50%; background: #{{ $product['color'] }};"></span>
                                                    </p>
                                                @endif
                                                <p>
                                                    <strong>{{ __('Price') }} :</strong>
                                                    {{ \PriceHelper::showCurrencyPrice($product['item_price'] * $order->currency_value) }}
                                                </p>
                                                <p>
                                                    <strong>{{ __('Qty') }} :</strong> {{ $product['qty'] }}
                                                    {{ $product['item']['measure'] }}
                                                </p>
                                                @if (!empty($product['keys']))
                                                    @foreach (array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                                                        <p>

                                                            <b>{{ ucwords(str_replace('_', ' ', $key)) }} : </b>
                                                            {{ $value }}

                                                        </p>
                                                    @endforeach
                                                @endif

                                            </td>

                                            <td> {{ \PriceHelper::showCurrencyPrice($product['price'] * $order->currency_value) }}
                                                <small>{{ $product['discount'] == 0 ? '' : '(' . $product['discount'] . '% ' . __('Off') . ')' }}</small>
                                            </td>
                                            <td>

                                                <div class="action-list">

                                                    <a class="add-btn edit-product"
                                                        data-href="{{ route('admin-order-product-edit', [$key1, $product['item']['id'], $order->id]) }}"
                                                        data-toggle="modal" data-target="#edit-product-modal">
                                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                    </a>

                                                    <a class="add-btn delete-product"
                                                        data-href="{{ route('admin-order-product-delete', [$key1, $order->id]) }}"
                                                        data-toggle="modal" data-target="#delete-product-modal">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-2">
                    <a class="btn sendEmail send" href="javascript:;" class="send"
                        data-email="{{ $order->customer_email }}" data-toggle="modal" data-target="#vendorform">
                        <i class="fa fa-send"></i> {{ __('Send Email') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Area End -->

    {{-- BILLING DETAILS EDIT MODAL --}}

    @include('admin.order.partials.billing-details')

    {{-- BILLING DETAILS MODAL ENDS --}}

    {{-- SHIPPING DETAILS EDIT MODAL --}}

    @include('admin.order.partials.shipping-details')

    {{-- SHIPPING DETAILS MODAL ENDS --}}

    {{-- ADD PRODUCT MODAL --}}

    @include('admin.order.partials.add-product')

    {{-- ADD PRODUCT MODAL ENDS --}}


    {{--  EDIT PRODUCT MODAL --}}

    <div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="submit-loader">
                    <img src="{{ asset('assets/images/' . $gs->admin_loader) }}" alt="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ __('Edit Item') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{--  EDIT PRODUCT MODAL ENDS --}}

    {{-- DELETE PRODUCT MODAL --}}

    <div class="modal fade" id="delete-product-modal" tabindex="-1" role="dialog" aria-labelledby="modal1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-center">{{ __('You are about to delete this item from this cart.') }}</p>
                    <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a
                        class="font-bold border-transparent uppercase justify-center text-xs py-2 px-2 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 mr-1 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300 btn-ok">{{ __('Delete') }}</a>

                </div>

            </div>
        </div>
    </div>
    {{-- DELETE PRODUCT MODAL ENDS --}}

    {{-- MESSAGE MODAL --}}
    <div class="sub-categori">
        <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorformLabel">{{ __('Send Email') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-form">
                                        <form id="emailreply">
                                            {{ csrf_field() }}
                                            <ul>
                                                <li>
                                                    <input type="email" class="input-field eml-val" id="eml"
                                                        name="to" placeholder="{{ __('Email') }} *"
                                                        value="" required="">
                                                </li>
                                                <li>
                                                    <input type="text" class="input-field" id="subj"
                                                        name="subject" placeholder="{{ __('Subject') }} *"
                                                        required="">
                                                </li>
                                                <li>
                                                    <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ __('Your Message') }} *"
                                                        required=""></textarea>
                                                </li>
                                            </ul>
                                            <button class="submit-btn" id="emlsub"
                                                type="submit">{{ __('Send Email') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MESSAGE MODAL ENDS --}}

    {{-- ORDER MODAL --}}

    <div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="submit-loader">
                    <img src="{{ asset('assets/images/' . $gs->admin_loader) }}" alt="">
                </div>
                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __('Update Status') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-center">{{ __("You are about to update the order's status.") }}</p>
                    <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER MODAL ENDS --}}

@endsection


@section('scripts')
    <script type="text/javascript">
        (function($) {
            "use strict";

            function disablekey() {
                document.onkeydown = function(e) {
                    return false;
                }
            }

            function enablekey() {
                document.onkeydown = function(e) {
                    return true;
                }
            }

            $('#example2').dataTable({
                "ordering": false,
                'lengthChange': false,
                'searching': false,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                'responsive': true
            });

            $(document).on('click', '.license', function(e) {
                var id = $(this).parent().find('input[type=hidden]').val();
                var key = $(this).parent().parent().find('input[type=hidden]').val();
                $('#key').html(id);
                $('#license-key').val(key);
            });
            $(document).on('click', '#license-edit', function(e) {
                $(this).hide();
                $('#edit-license').show();
                $('#license-cancel').show();
            });
            $(document).on('click', '#license-cancel', function(e) {
                $(this).hide();
                $('#edit-license').hide();
                $('#license-edit').show();
            });

            @if (Session::has('license'))

                $.notify('{{ Session::get('license') }}', 'success');
            @endif

            // ADD OPERATION

            $(document).on('click', '.edit-product', function() {

                if (admin_loader == 1) {
                    $('.submit-loader').show();
                }
                $('#edit-product-modal .modal-content .modal-body').html('').load($(this).data('href'),
                    function(response, status, xhr) {
                        if (status == "success") {
                            if (admin_loader == 1) {
                                $('.submit-loader').hide();
                            }
                        }
                    });
            });

            // ADD OPERATION END

            // SHOW PRODUCT FORM SUBMIT

            $(document).on('submit', '#show-product', function(e) {
                e.preventDefault();
                if (admin_loader == 1) {
                    $('.submit-loader').show();
                }
                $('button.addProductSubmit-btn').prop('disabled', true);
                disablekey();
                $.ajax({
                    method: "POST",
                    url: $(this).prop('action'),
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data[0]) {
                            $('#product-show').html('').load(mainurl +
                                "/admin/order/product-show/" + data[1],
                                function(response, status, xhr) {
                                    if (status == "success") {
                                        if (admin_loader == 1) {
                                            $('.submit-loader').hide();
                                        }
                                    }
                                });
                        } else {
                            if (admin_loader == 1) {
                                $('.submit-loader').hide();
                            }
                            $('#product-show').html('<div class="col-lg-12 text-center"><h4>' +
                                data[1] + '.</h4></div>')
                        }

                        $('button.addProductSubmit-btn').prop('disabled', false);

                        enablekey();
                    }

                });

            });

            // SHOW PRODUCT FORM SUBMIT ENDS


            $('#delete-product-modal').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

        })(jQuery);
    </script>
@endsection
