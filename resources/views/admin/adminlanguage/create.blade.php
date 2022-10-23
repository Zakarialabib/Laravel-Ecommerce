@extends('layouts.admin')

@section('styles')
    <style type="text/css">
        textarea.input-field {
            padding: 20px 20px 0px 20px;
            border-radius: 0px;
        }
    </style>
@endsection

@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Add Language') }} <a class="add-btn" href="{{ route('admin-tlang-index') }}"><i
                                class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li><a href="javascript:;">{{ __('Language Settings') }}</a></li>
                        <li>
                            <a href="{{ route('admin-tlang-index') }}">{{ __('Admin Panel Language') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-tlang-create') }}">{{ __('Add Language') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="add-product-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <div class="gocover"
                                style="background: url({{ asset('assets/images/' . $gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                            </div>
                            <form id="geniusform" action="{{ route('admin-tlang-create') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include('alerts.admin.form-both')

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Language') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="language"
                                            placeholder="{{ __('Language') }}" required="" value="English">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Language Direction') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="rtl" class="input-field" required="">
                                            <option value="0">{{ __('Left To Right') }}</option>
                                            <option value="1">{{ __('Right To Left') }}</option>
                                        </select>
                                    </div>
                                </div>


                                <hr>

                                <h4 class="text-center">{{ __('SET LANGUAGE KEYS & VALUES') }}</h4>

                                <hr>



                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="featured-keyword-area">

                                            <div class="lang-tag-top-filds" id="lang-section">



                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">New Conversation(s).</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">New Conversation(s).</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">You Have a New Message.</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">You Have a New Message.</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Product(s) in Low Quantity.</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Product(s) in Low Quantity.</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Stock</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Stock</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">New Notification(s).</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">New Notification(s).</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">A New User Has Registered.</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">A New User Has Registered.</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">New Order(s).</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">New Order(s).</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">You Have a new order.</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">You Have a new order.</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Clear All</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Clear All</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">No New Notifications.</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">No New Notifications.</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Welcome!</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Welcome!</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Edit Profile</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Edit Profile</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Change Password</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Change Password</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Logout</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Logout</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Dashboard</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Dashboard</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">All Orders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">All Orders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Pending Orders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Pending Orders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Processing Orders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Processing Orders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Completed Orders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Completed Orders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Declined Orders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Declined Orders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Products</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Products</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Add New Product</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Add New Product</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">All Products</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">All Products</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Deactivated Product</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Deactivated Product</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Affiliate Products</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Affiliate Products</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Add Affiliate Product</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Add Affiliate Product</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">All Affiliate Products</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">All Affiliate Products</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Customers</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Customers</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Customers List</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Customers List</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Withdraws</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Withdraws</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Vendors</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Vendors</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Vendors List</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Vendors List</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Vendor Subscriptions</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Vendor Subscriptions</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Vendor Subscription Plans</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Vendor Subscription Plans</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Manage Categories</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Manage Categories</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Main Category</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Main Category</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Sub Category</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Sub Category</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Child Category</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Child Category</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Bulk Product Upload</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Bulk Product Upload</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Product Discussion</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Product Discussion</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Product Reviews</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Product Reviews</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Comments</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Comments</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Set Coupons</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Set Coupons</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Blog</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Blog</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Categories</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Categories</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Posts</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Posts</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Messages</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Messages</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Tickets</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Tickets</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Disputes</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Disputes</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">General Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">General Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Logo</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Logo</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Favicon</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Favicon</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loader</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loader</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Pickup Locations</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Pickup Locations</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Website Contents</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Website Contents</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Header</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Header</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Footer</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Footer</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Affiliate Information</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Affiliate Information</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Popup Banner</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Popup Banner</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Error Banner</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Error Banner</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Home Page Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Home Page Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Sliders</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Sliders</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Services</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Services</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Right Side Banner1</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Right Side Banner1</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Right Side Banner2</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Right Side Banner2</textarea>
                                                        </div>
                                                    </div>
                                                </div>





                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Large Banners</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Large Banners</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Bottom Small Banners</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Bottom Small Banners</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Reviews</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Reviews</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Partners</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Partners</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Home Page Customization</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Home Page Customization</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">FAQ Page</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">FAQ Page</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Contact Us Page</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Contact Us Page</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Other Pages</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Other Pages</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Email Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Email Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Email Template</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Email Template</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Email Configurations</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Email Configurations</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Group Email</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Group Email</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Payment Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Payment Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Payment Information</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Payment Information</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Payment Gateways</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Payment Gateways</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Currencies</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Currencies</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Social Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Social Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Social Links</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Social Links</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Facebook Login</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Facebook Login</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Google Login</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Google Login</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Language Settings</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Language Settings</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Website Language</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Website Language</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Admin Panel Language</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Admin Panel Language</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Popular Products</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Popular Products</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Google Analytics</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Google Analytics</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Website Meta Keywords</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Website Meta Keywords</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Manage Staffs</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Manage Staffs</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">System Activation</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">System Activation</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Activation</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Activation</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="lang-area">
                                                    <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Generate Backup</textarea>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Generate Backup</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <a href="javascript:;" id="lang-btn" class="add-fild-btn"><i
                                                    class="icofont-plus"></i> Add More Field</a>
                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="left-area">

                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn"
                                            type="submit">{{ __('Create Language') }}</button>
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

            function isEmpty(el) {
                return !$.trim(el.html())
            }


            $("#lang-btn").on('click', function() {

                $("#lang-section").append('' +
                    '<div class="lang-area">' +
                    '<span class="remove lang-remove"><i class="fas fa-times"></i></span>' +
                    '<div class="row">' +
                    '<div class="col-lg-6">' +
                    '<textarea name="keys[]" class="input-field" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<textarea  name="values[]" class="input-field" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');

            });

            $(document).on('click', '.lang-remove', function() {

                $(this.parentNode).remove();
                if (isEmpty($('#lang-section'))) {

                    $("#lang-section").append('' +
                        '<div class="lang-area">' +
                        '<span class="remove lang-remove"><i class="fas fa-times"></i></span>' +
                        '<div class="row">' +
                        '<div class="col-lg-6">' +
                        '<textarea name="keys[]" class="input-field" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>' +
                        '</div>' +
                        '<div class="col-lg-6">' +
                        '<textarea  name="values[]" class="input-field" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '');


                }

            });

        })(jQuery);
    </script>
@endsection
