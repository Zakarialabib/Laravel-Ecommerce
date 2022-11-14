@extends('layouts.dashboard')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('PAGE') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Pages') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Menu Page Settings') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-page-index') }}">{{ __('Pages') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <a class="add-btn text-white" data-href="{{ route('admin-page-create') }}" id="add-data"
                        data-toggle="modal" data-target="#modal1">
                        <i class="fas fa-plus"></i> <span class="remove-mobile">{{ __('Add New') }}<span>
                    </a>
                </div>
            </div>
        </div>
        @livewire('admin.page.index')
    </div>
@endsection
