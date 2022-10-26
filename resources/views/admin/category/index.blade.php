@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('CATEGORY') }}">
    <input type="hidden" id="attribute_data" value="{{ __('ADD NEW ATTRIBUTE') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Main Categories') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li><a href="javascript:;">{{ __('Manage Categories') }}</a></li>
                        <li>
                            <a href="{{ route('admin-cat-index') }}">{{ __('Main Categories') }}</a>
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
        @livewire('admin.categories.index')
    </div>
@endsection
