@extends('layouts.admin')

@section('styles')

<style type="text/css">
  
textarea.input-field {
  padding: 20px 20px 0px 20px;
  border-radius: 0px;
}

</style>

@endsection

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Add Language') }} <a class="add-btn" href="{{route('admin-lang-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li><a href="javascript:;">{{ __('Language Settings') }}</a></li>
                        <li>
                          <a href="{{ route('admin-lang-index') }}">{{ __('Website Language') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-lang-create') }}">{{ __('Add Language') }}</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content1">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin-lang-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('alerts.admin.form-both')  

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Language') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="language" placeholder="{{ __('Language') }}" required="" value="English">
                          </div>
                        </div>
                        

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Language Direction') }} *</h4>

                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="rtl" class="input-field" required="">
                              <option value="0">{{ __('Left To Right') }}</option>
                              <option value="1">{{ __('Right To Left') }}</option>
                            </select>
                          </div>
                        </div>


                      <hr>
                        
                        <h4 class="text-center">{{ __('SET LANGUAGE KEYS & VALUES') }}</h4>

                      <hr>



                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">

                            </div>
                          </div>
                         <div class="col-lg-8">
                            <div class="featured-keyword-area">

                              <div class="lang-tag-top-filds" id="lang-section">

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">New Conversation(s).</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea  name="values[]" class="input-field" placeholder="Enter Language Value" required="">New Conversation(s).</textarea>
                                    </div>
                                  </div>
                                </div>

                              </div>

                              <a href="javascript:;" id="lang-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{__('Add More Field')}}</a>
                            </div>
                          </div>


                          <div class="col-lg-2">
                            <div class="left-area">

                            </div>
                          </div>

                        </div>
        
<hr>
                        <div class="row">
                          <div class="col-lg-5">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Language') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section('scripts')

<script type="text/javascript">
  
  (function($) {
		"use strict";

  function isEmpty(el){
      return !$.trim(el.html())
  }

  
$("#lang-btn").on('click', function(){

    $("#lang-section").append(''+
                                '<div class="lang-area">'+
                                  '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                  '<div class="row">'+
                                    '<div class="col-lg-6">'+
                                    '<textarea name="keys[]" class="input-field" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>'+
                                    '</div>'+
                                    '<div class="col-lg-6">'+
                                    '<textarea  name="values[]" class="input-field" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                            '');

});

$(document).on('click','.lang-remove', function(){

    $(this.parentNode).remove();
    if (isEmpty($('#lang-section'))) {

    $("#lang-section").append(''+
                                '<div class="lang-area">'+
                                  '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                  '<div class="row">'+
                                    '<div class="col-lg-6">'+
                                    '<textarea name="keys[]" class="input-field" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>'+
                                    '</div>'+
                                    '<div class="col-lg-6">'+
                                    '<textarea  name="values[]" class="input-field" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                            '');


    }

});

})(jQuery);

</script>

@endsection