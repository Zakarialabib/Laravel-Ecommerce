@extends('layouts.dashboard')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('PARTNER') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Brands') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Home Page Settings') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-brand-index') }}">{{ __('Brands') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <!-- Button trigger livewire modal -->
                    <x-button primary type="button" onclick="Livewire.emit('createBrand', 'show')">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </div>
        </div>
        @livewire('admin.brands.index')
    </div>
@endsection
