<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>Modes Fashion</title>

    <!-- vendor css -->
    <link href="{{ url('lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!-- <link href="{{ url('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet"> -->
    <link href="{{ url('lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">
    <link href="{{ url('assets/css/yearpicker.css')}}" rel="stylesheet">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.dashboard.css')}}">

    <link rel="stylesheet" href="{{ url('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('lib/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}">
    <link href="{{ url('lib/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <style>
      .select2-container {
        z-index: 2000 !important;
      }
      .select2-selection__rendered {
        line-height: 32px !important;
      }

      .select2-selection {
        height: 34px !important;
      }

      .yearpicker-container {
        z-index: 2001;
      }
    </style>
    @yield('styles')
  </head>