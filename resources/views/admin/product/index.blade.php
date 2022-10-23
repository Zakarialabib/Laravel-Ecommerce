@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('PRODUCT') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Products') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Products') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <a class="add-btn" href="{{ route('admin-prod-create','Physical') }}">
                        <i class="fas fa-plus "></i>
                        <span class="remove-mobile">
                            {{__('Create product')}}
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <livewire:admin.product.index />
    </div>



    {{-- HIGHLIGHT MODAL --}}

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">


        <div class="modal-dialog highlight" role="document">
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

    {{-- HIGHLIGHT ENDS --}}

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
                    <p class="text-center">{{ __('You are about to delete this Product.') }}</p>
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

    {{-- GALLERY MODAL --}}

    <div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="top-area">
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                <div class="upload-img-btn">
                                    <form method="POST" enctype="multipart/form-data" id="form-gallery">
                                        @csrf
                                        <input type="hidden" id="pid" name="product_id" value="">
                                        <input type="file" name="gallery[]" class="hidden" id="uploadgallery"
                                            accept="image/*" multiple>
                                        <label for="image-upload" id="prod_gallery"><i
                                                class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:;" class="upload-done" data-dismiss="modal"> <i
                                        class="fas fa-check"></i> {{ __('Done') }}</a>
                            </div>
                            <div class="col-sm-12 text-center">(
                                <small>{{ __('You can upload multiple Images.') }}</small> )</div>
                        </div>
                    </div>
                    <div class="gallery-images">
                        <div class="selected-image">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GALLERY MODAL ENDS --}}
@endsection

@section('scripts')

    {{-- Gallery Section Update --}}

    <script type="text/javascript">
        $(function($) {
            "use strict";

            $(document).on("click", ".set-gallery", function() {
                var pid = $(this).find('input[type=hidden]').val();
                $('#pid').val(pid);
                $('.selected-image .row').html('');
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin-gallery-show') }}",
                    data: {
                        id: pid
                    },
                    success: function(data) {
                        if (data[0] == 0) {
                            $('.selected-image .row').addClass('justify-content-center');
                            $('.selected-image .row').html(
                                '<h3>{{ __('No Images Found.') }}</h3>');
                        } else {
                            $('.selected-image .row').removeClass('justify-content-center');
                            $('.selected-image .row h3').remove();
                            var arr = $.map(data[1], function(el) {
                                return el
                            });

                            for (var k in arr) {
                                $('.selected-image .row').append('<div class="col-sm-6">' +
                                    '<div class="img gallery-img">' +
                                    '<span class="remove-img"><i class="fas fa-times"></i>' +
                                    '<input type="hidden" value="' + arr[k]['id'] + '">' +
                                    '</span>' +
                                    '<a href="' +
                                    '{{ asset('assets/images/galleries') . '/' }}' + arr[k][
                                        'photo'
                                    ] + '" target="_blank">' +
                                    '<img src="' +
                                    '{{ asset('assets/images/galleries') . '/' }}' + arr[k][
                                        'photo'
                                    ] + '" alt="gallery image">' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>');
                            }
                        }

                    }
                });
            });


            $(document).on('click', '.remove-img', function() {
                var id = $(this).find('input[type=hidden]').val();
                $(this).parent().parent().remove();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin-gallery-delete') }}",
                    data: {
                        id: id
                    }
                });
            });

            $(document).on('click', '#prod_gallery', function() {
                $('#uploadgallery').click();
            });


            $("#uploadgallery").change(function() {
                $("#form-gallery").submit();
            });

            $(document).on('submit', '#form-gallery', function() {
                $.ajax({
                    url: "{{ route('admin-gallery-store') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data != 0) {
                            $('.selected-image .row').removeClass('justify-content-center');
                            $('.selected-image .row h3').remove();
                            var arr = $.map(data, function(el) {
                                return el
                            });
                            for (var k in arr) {
                                $('.selected-image .row').append('<div class="col-sm-6">' +
                                    '<div class="img gallery-img">' +
                                    '<span class="remove-img"><i class="fas fa-times"></i>' +
                                    '<input type="hidden" value="' + arr[k]['id'] + '">' +
                                    '</span>' +
                                    '<a href="' +
                                    '{{ asset('assets/images/galleries') . '/' }}' + arr[k][
                                        'photo'
                                    ] + '" target="_blank">' +
                                    '<img src="' +
                                    '{{ asset('assets/images/galleries') . '/' }}' + arr[k][
                                        'photo'
                                    ] + '" alt="gallery image">' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>');
                            }
                        }

                    }

                });
                return false;

            })

        });
    </script>

    {{-- Gallery Section Update Ends --}}
@endsection
