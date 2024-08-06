
<!DOCTYPE html>
<html lang="ar" dir="RTL">
<head>
  <meta charset="utf-8" />
  <title>Anas Academy</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">

  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="app" id="app">
@include('layouts.sidebar')
<div id="content" class="app-content box-shadow-z0" role="main">
    <div ui-view class="app-body" id="view" style="margin-right: 200px">
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
            <i class="material-icons">&#xe5d2;</i>
          </a>
        <div class="centered">
            <h1>Welcome To Admin Panel</h1>
        </div>
    </div>
</div>

  </div>


  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="{{ asset('scripts/config.lazyload.js') }}"></script>
{{-- <script src="../../"></script> --}}
  <script src="{{ asset('scripts/palette.js') }}"></script>
  <script src="{{ asset('scripts/ui-load.js') }}"></script>
  <script src="{{ asset('scripts/ui-jp.js') }}"></script>
  <script src="{{ asset('scripts/ui-include.js') }}"></script>
  <script src="{{ asset('scripts/ui-device.js') }}"></script>
  <script src="{{ asset('scripts/ui-form.js') }}"></script>
  <script src="{{ asset('scripts/ui-nav.js') }}"></script>
  <script src="{{ asset('scripts/ui-screenfull.js') }}"></script>
  <script src="{{ asset('scripts/ui-scroll-to.js') }}"></script>
  <script src="{{ asset('scripts/ui-toggle-class.js') }}"></script>

  <script src="{{ asset('scripts/app.js') }}"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="{{ asset('scripts/ajax.js') }}"></script>
<!-- endbuild -->
</body>
</html>
