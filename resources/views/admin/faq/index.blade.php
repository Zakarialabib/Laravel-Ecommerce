@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('FAQ') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Faq') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Menu Page Settings') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-faq-index') }}">{{ __('Faq') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <a class="add-btn text-white" href="{{ route('admin-faq-create') }}">
                        <i class="fas fa-plus"></i> <span class="remove-mobile">{{ __('Add New') }}<span>
                    </a>
                </div>
            </div>
        </div>
        @livewire('admin.faq.index')
    </div>

    {{-- ADD / EDIT MODAL --}}

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="submit-loader">
                    <img src="{{ asset('assets/images/' . $gs->admin_loader) }}" alt="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD / EDIT MODAL ENDS --}}


    {{-- DELETE MODAL --}}

    <div class="modal fade" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100">{{ __('Confirm Delete') }}</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-center">{{ __('You are about to delete this Faq.') }}</p>
                    <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="" class="d-inline delete-form" method="POST">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit"
                            class="font-bold border-transparent uppercase justify-center text-xs py-2 px-2 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 mr-1 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300">{{ __('Delete') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- DELETE MODAL ENDS --}}
@endsection
