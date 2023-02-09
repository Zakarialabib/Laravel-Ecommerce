<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ Helpers::settings('site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style type="text/css">
        a[x-apple-data-detectors] {
            color: inherit !important;
        }
    </style>

</head>

<body style="margin: 0; padding: 0;">
    <div class="" style="">
        <div class="b-container">
            <div class="b-header">
                {{-- email header can be customized html --}}
            </div>
        </div>
    </div>

    @yield('content')

    <div class="b-footer" style="margin-top: 0px;">
      <div class="b-container">
          {{-- email footer can be customized html --}}
      </div>
  </div>
</body>

</html>
