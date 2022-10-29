@extends('layouts.dashboard') 

@section('content')  
          <input type="hidden" id="headerdata" value="{{ __('SHIPPING METHOD') }}">
          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Shipping Methods') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-shipping-index') }}">{{ __('Shipping Methods') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="product-area">
              <div class="row">
                <div class="col-lg-12">

                <div class="heading-area">
                  <h4 class="title">
                    {{ __('Multiple Shipping') }} :
                  </h4>
                                  <div class="action-list">
                                      <select class="process select droplinks {{ $gs->multiple_shipping == 1 ? 'drop-success' : 'drop-danger' }}">
                                        <option data-val="1" value="{{route('admin-gs-status',['multiple_shipping',1])}}" {{ $gs->multiple_shipping == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                        <option data-val="0" value="{{route('admin-gs-status',['multiple_shipping',0])}}" {{ $gs->multiple_shipping == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                      </select>
                                    </div>
                </div>



                  <div class="mr-table allproduct">

                        @include('alerts.admin.form-success')  

                    <div class="table-responsive">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                        
                                          <th>{{ __('Title') }}</th>
                                          <th>{{ __('Price') }}</th>
                                          <th>{{ __('Options') }}</th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

{{-- ADD / EDIT MODAL --}}

                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
                    
                    
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="submit-loader">
                            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

  <div class="modal-header d-block text-center">
    <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Shipping Method.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <form action="" class="d-inline delete-form" method="POST">
              <input type="hidden" name="_method" value="delete" />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="font-bold border-transparent uppercase justify-center text-xs py-2 px-2 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 mr-1 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300">{{ __('Delete') }}</button>
            </form>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection    

@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

(function($) {
		"use strict";

    var table = $('#geniustable').DataTable({
         ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-shipping-datatables') }}',
               columns: [
                  { data: 'title', name: 'title' },
                  { data: 'price', name: 'price' },
                  { data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                  processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

        $(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
          '<a class="add-btn" data-href="{{route('admin-shipping-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
          '<i class="fas fa-plus"></i>  <span class="remove-mobile">{{ __("Add New") }}<span>'+
          '</a>'+
          '</div>');
      });                     
                  
{{-- DATA TABLE ENDS--}}

})(jQuery);

</script>

@endsection   