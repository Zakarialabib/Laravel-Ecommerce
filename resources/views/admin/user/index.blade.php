@extends('layouts.dashboard')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('CUSTOMER') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Customers') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users') }}">{{ __('Customers') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @livewire('admin.customer.index')
    </div>

 
@endsection
