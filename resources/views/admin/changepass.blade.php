<!doctype html>
<html lang="en" dir="ltr">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="author" content="Hotech&Soft">
    <!-- Title -->
    <title>{{$gs->title}}</title>
    <!-- favicon -->
    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
    <!-- Bootstrap -->
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
    <!-- icofont -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">
    <!-- Sidemenu Css -->
    <link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />   
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">
    <!-- Main Css -->
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet"/>
    
    @yield('styles')

  </head>
  <body>

    <!-- Login and Sign up Area Start -->
    <section class="login-signup">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="login-area">
              <div class="header-area">
                <h4 class="title">{{ __('Change Password') }}</h4>
              </div>
              <div class="login-form">
                <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                <x-form-alert />
                <form id="passwordform" action="{{ route('admin.change.password') }}" method="POST">
                  @csrf

                  <div class="form-input">
                    <input type="password" name="cpass" class="Password" placeholder="{{ __('Current Password') }}" required=""><i class="icofont-ui-password"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" name="newpass" class="Password" placeholder="{{ __('New Password') }}" required=""><i class="icofont-ui-password"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" name="renewpass" class="Password" placeholder="{{ __('Re-Type New Password') }}" required=""><i class="icofont-ui-password"></i>
                  </div>
                  
                  <input type="hidden" name="file_token" value="{{ $token }}">

                  <button class="submit-btn">{{ __('Submit') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Login and Sign up Area End -->

    <!-- Dashboard Core -->
    <script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
    <!-- Fullside-menu Js-->
    <script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>

    <script src="{{asset('assets/admin/js/plugin.js')}}"></script>
    <script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/load.js')}}"></script>
    <!-- Custom Js-->
    <script src="{{asset('assets/admin/js/custom.js')}}"></script>
    <!-- AJAX Js-->
    <script src="{{asset('assets/admin/js/myscript.js')}}"></script>

    <script>

        $("#passwordform").on('submit',function(e){
          e.preventDefault();
          $('button.submit-btn').prop('disabled',true);
          $('.gocover').show();
              $.ajax({
               method:"POST",
               url:$(this).prop('action'),
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               {  
                $('.gocover').hide();
                  if ((data.errors)) {
                  $('.alert-success').hide();
                  $('.alert-danger').show();
                  $('.alert-danger ul').html('');
                    for(var error in data.errors)
                    {
                      $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
                    }
                  }
                  else {
                    $('.alert-success').show();
                    $('.alert-success p').html(data);
                  }
                  $('button.submit-btn').prop('disabled',false);
               }
              });
        
        });
        
        </script>

  </body>

</html>