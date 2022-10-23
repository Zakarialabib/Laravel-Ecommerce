@extends('layouts.load')

@section('styles')
    <link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="content-area">
        <div class="add-product-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            @include('alerts.admin.form-error')
                            <form id="geniusformdata" action="{{ route('admin-prod-feature', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Flash Deal') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="is_discount" id="is_discount" value="1"
                                                    {{ $data->is_discount == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Hot') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="hot" value="1"
                                                    {{ $data->hot == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="{{ $data->is_discount == 0 ? 'showbox' : '' }}">

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Discount Date') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="input-field" name="discount_date"
                                                placeholder="{{ __('Enter Date') }}" autocomplete="off" id="discount_date"
                                                value="{{ $data->discount_date }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('New') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="latest" value="1"
                                                    {{ $data->latest == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Sale') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="sale" value="1"
                                                    {{ $data->sale == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Best Seller') }} *
                                            </h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="best" value="1"
                                                    {{ $data->best == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Featured') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="featured" value="1"
                                                    {{ $data->featured == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Big Save') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="big" value="1"
                                                    {{ $data->big == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Trending') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="trending" value="1"
                                                    {{ $data->trending == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Highlight in') }} {{ __('Top Rated') }} *</h4>
                                        </div>
                                        <div class="float-right">
                                            <label class="switch">
                                                <input type="checkbox" name="top" value="1"
                                                    {{ $data->top == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="addProductSubmit-btn"
                                            type="submit">{{ __('Submit') }}</button>
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="left-area">

                                            </div>
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
    <script type="text/javascript">
        (function($) {
            "use strict";

            $('#is_discount').on('change', function() {

                if (this.checked) {
                    $(this).parent().parent().parent().next().removeClass('showbox');
                    $('#discount').prop('required', true);
                    $('#discount_date').prop('required', true);
                } else {
                    $(this).parent().parent().parent().next().addClass('showbox');
                    $('#discount').prop('required', false);
                    $('#discount_date').prop('required', false);
                }

            });

        })(jQuery);
    </script>
@endsection
