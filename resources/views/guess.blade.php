<!DOCTYPE html>
<html lang="en">
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

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

    <!-- vendor css -->
    <link href="{{ url('lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ url('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.landing.css')}}">

  </head>
  <body class="home-body">
    @include('layouts.guess.header')
    <div class="home-slider">
      <div class="home-lead">
        <div class="df-logo-initial mg-b-15"><p>df</p></div>
        <p class="home-text">Responsive Bootstrap 5 Dashboard Template</p>

        <h6 class="home-headline">Make your dashboard app more professional with this <span>super awesome</span> and <span>premium quality</span> dashboard design template.</h6>

        <div class="d-flex wd-lg-350">
          <a href="https://themeforest.net/item/dashforge-responsive-admin-dashboard-template/23725961" class="btn btn-brand-01 btn-uppercase flex-fill">Buy Now - $20</a>
          <a href="template/classic/dashboard-one.html" class="btn btn-white btn-uppercase flex-fill mg-l-10">Explore Demo</a>
        </div>

        <div class="d-flex tx-20 mg-t-40">
          <div class="tx-purple"><i class="fab fa-bootstrap"></i></div>
          <div class="tx-orange pd-l-10"><i class="fab fa-html5"></i></div>
          <div class="tx-primary pd-l-10"><i class="fab fa-css3-alt"></i></div>
          <div class="tx-pink pd-l-10"><i class="fab fa-sass"></i></div>
          <div class="tx-warning pd-l-10"><i class="fab fa-js"></i></div>
          <div class="tx-danger pd-l-10"><i class="fab fa-npm"></i></div>
          <div class="tx-danger pd-l-10"><i class="fab fa-gulp"></i></div>
          <div class="bd-l mg-l-10 mg-sm-l-20 pd-l-10 pd-sm-l-20"></div>
          <div class="tx-color-03" data-toggle="tooltip" data-title="Ongoing development"><i class="fab fa-angular"></i></div>
          <div class="tx-color-03 pd-l-10" data-toggle="tooltip" data-title="Coming soon"><i class="fab fa-react"></i></div>
          <div class="tx-color-03 pd-l-10" data-toggle="tooltip" data-title="Coming soon"><i class="fab fa-vuejs"></i></div>
        </div>

        <div class="tx-12 mg-t-40">
          <a href="docs.html" class="link-03">Doc<span class="d-none d-sm-inline">umentation</span><span class="d-sm-none">s</span></a>
          <a href="changelog.html" class="link-03 mg-l-10 mg-sm-l-20">Changelog</a>
          <a href="https://themeforest.net/licenses/standard" target="_blank" class="link-03 mg-l-10 mg-sm-l-20">Licenses</a>
          <a href="https://themeforest.net/page/customer_refund_policy" target="_blank" class="link-03 mg-l-10 mg-sm-l-20">Refund Policy</a>
        </div>
      </div>
      <div class="home-slider-img">
        <div><img src="assets/img/home-1.png" alt=""></div>
        <div><img src="assets/img/home-2.png" alt=""></div>
        <div><img src="assets/img/home-2-dark.png" alt=""></div>
      </div>
      <div class="home-slider-bg-one"></div>
    </div><!-- home-slider -->

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/js/dashforge.js"></script>
    <script>
      $(document).ready(function() {
        'use strict'

        $('[data-toggle="tooltip"]').tooltip()


      });
    </script>
  </body>
</html>
