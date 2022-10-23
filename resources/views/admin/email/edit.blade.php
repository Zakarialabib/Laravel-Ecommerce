@extends('layouts.load')

@section('content')
    <div class="content-area">
        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            @include('alerts.admin.form-error')

                            <div class="row">
                                <div class="col-md-6 offset-md-4">
                                    <p>{{ __('Use the BB codes, it show the data dynamically in your emails.') }}</p>
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Meaning') }}</th>
                                                <th>{{ __('BB Code') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ __('Customer Name') }}</td>
                                                <td>{customer_name}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Customer last Name') }}</td>
                                                <td>{customer_lastname}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Order Amount') }}</td>
                                                <td>{order_amount}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Admin Name') }}</td>
                                                <td>{admin_name}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Admin Email') }}</td>
                                                <td>{admin_email}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Website Title') }}</td>
                                                <td>{website_title}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Order Number') }}</td>
                                                <td>{order_number}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <form id="geniusformdata" action="{{ route('admin-mail-update', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Email Type') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" placeholder="{{ __('Email Type') }}"
                                            required="" value="{{ $data->email_type }}" disabled="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Email Subject') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="email_subject"
                                            placeholder="{{ __('Email Subject') }}" required=""
                                            value="{{ $data->email_subject }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Email Body') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <textarea class="nic-edit" name="email_body" placeholder="{{ __('Email Body') }}">{{ $data->email_body }}</textarea>
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
