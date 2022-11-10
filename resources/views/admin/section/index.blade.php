@extends('layouts.dashboard')
@section('title', __('Section List'))
@section('content')
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8 ">
                    <h4 class="heading">{{ __('Sections') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Home Page Settings') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections') }}">{{ __('Sectioons') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <a class="add-btn text-white" href="">
                        <i class="fas fa-plus"></i> {{ __('Create Section') }}
                    </a>
                </div>
            </div>
        </div>
        @livewire('admin.section.index')
    </div>
@endsection
