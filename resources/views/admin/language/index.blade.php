@extends('layouts.dashboard') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('LANGUAGE') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Language Settings') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li><a href="javascript:;">{{ __('Language Settings') }}</a></li>
											<li>
												<a href="{{ route('admin-lang-index') }}">{{ __('Website Language') }} </a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12"> 
									<div class="mr-table allproduct">

                        @include('alerts.admin.form-success') 

										<div class="table-responsive">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('Language') }}</th>
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
            <p class="text-center">{{ __('You are about to delete this Language.') }}</p>
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

    <script type="text/javascript">

(function($) {
		"use strict";

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-lang-datatables') }}',
               columns: [
                        { data: 'language', name: 'language' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
               language: {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

      	 	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn mr-2" href="{{route('admin-lang-import')}}">'+
          '<i class="fas fa-upload"></i>  <span class="remove-mobile">{{ __("Import") }}<span>'+
          '</a>'+
        	'<a class="add-btn" href="{{route('admin-lang-create')}}" id="add-data">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New") }}<span>'+
          '</a>'+
          '</div>');
      });													


	})(jQuery);		

    </script>
@endsection   