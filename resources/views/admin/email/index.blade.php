@extends('layouts.dashboard')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('EMAIL TEMPLATES') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Email Templates') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Email Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-mail-index') }}">{{ __('Email Templates') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <livewire:admin.email.index />
    </div>
@endsection
