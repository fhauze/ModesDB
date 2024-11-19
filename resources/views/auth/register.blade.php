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
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/favicon.png')}}">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

    <!-- vendor css -->
    <link href="{{ url('lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ url('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{  url('lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.auth.css')}}">
    <style type="text/css">
      .cardimage {
        width: 600px;
        height: 500px;
        border: none;
        border-radius: 10px;
        background: radial-gradient(ellipse farthest-side at 76% 77%, rgba(245, 228, 212, 0.25) 4%, rgba(255, 255, 255, 0) calc(4% + 1px)), radial-gradient(circle at 76% 40%, #fef6ec 4%, rgba(255, 255, 255, 0) 4.18%), linear-gradient(135deg, #ff0000 0%, #000036 100%), radial-gradient(ellipse at 28% 0%, #ffcfac 0%, rgba(98, 149, 144, 0.5) 100%), linear-gradient(180deg, #cd6e8a 0%, #f5eab0 69%, #d6c8a2 70%, #a2758d 100%);
        background-blend-mode: normal, normal, screen, overlay, normal;
        box-shadow: 0px 0px 10px 1px #000000;
      }
      .cardimage {
        width: 24rem;
        height: 36rem;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        color: $color-primary-white;
        box-shadow: 0 10px 30px 5px rgba(0, 0, 0, 0.2);
      
        img {
          position: absolute;
          object-fit: cover;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          opacity: 0.9;
          transition: opacity .2s ease-out;
        }

        h2 {
          position: absolute;
          inset: auto auto 30px 30px;
          margin: 0;
          transition: inset .3s .3s ease-out;
          font-family: 'Roboto Condensed', sans-serif;
          font-weight: normal;
          text-transform: uppercase;
        }
        
        p, a {
          position: absolute;
          opacity: 0;
          max-width: 80%;
          transition: opacity .3s ease-out;
        }
        
        p {
          inset: auto auto 80px 30px;
        }
        
        a {
          inset: auto auto 40px 30px;
          color: inherit;
          text-decoration: none;
        }
        
        &:hover h2 {
          inset: auto auto 220px 30px;
          transition: inset .3s ease-out;
        }
        
        &:hover p, &:hover a {
          opacity: 1;
          transition: opacity .5s .1s ease-in;
        }
        
        &:hover img {
          transition: opacity .3s ease-in;
          opacity: 1;
        }

      }

    </style>
  </head>
  <body>
    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="pd-t-20 wd-100p">
              <h4 class="tx-color-01 mg-b-5">Create New Account</h4>
              <p class="tx-color-03 tx-16 mg-b-40">It's free to signup and only takes a minute.</p>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email address">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
              </div>
              <div class="form-group">
                <label>Firstname</label>
                <input type="text" name="first" class="form-control" placeholder="Enter your firstname">
              </div>
              <div class="form-group">
                <label>Lastname</label>
                <input type="text" name="last" class="form-control" placeholder="Enter your lastname">
              </div>
              <div class="form-group tx-12">
                By clicking <strong>Create an account</strong> below, you agree to our terms of service and privacy statement.
              </div><!-- form-group -->

              <button class="btn btn-brand-02 w-100" type="submit">Create Account</button>
              <div class="divider-text">or</div>
              <div class="d-grid gap-2">
                <button class="btn btn-danger btn-block">Sign Up google</button>
                <!-- <button class="btn btn-outline-twitter btn-block">Sign Up With Twitter</button> -->
              </div>
              <div class="tx-13 mg-t-20 tx-center">Already have an account? <a href="{{ route('login')}}">Sign In</a></div>
            </div>
            </form>
          </div><!-- sign-wrapper -->
          <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-600 mx-xl-wd-550">
              <div class="cardimage">
                <img src="{{ url('assets/img/modest-1.jpg')}}" class="img-fluid" alt="">
              </div>
              {{-- <img src="{{ url('assets/img/modest-1.jpg')}}" class="img-fluid" alt=""> --}}
            </div>
          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; 2023 DashForge v1.0.0. </span>
        <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
      </div>
      <div>
        <nav class="nav">
          <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
          <a href="../../change-log.html" class="nav-link">Change Log</a>
          <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
      </div>
    </footer>

    <script src="{{ url('lib/jquery/jquery.min.js')}}"></script>
    <script src="{{ url('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('lib/feather-icons/feather.min.js')}}"></script>
    <script src="{{ url('lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{ url('assets/js/dashforge.js')}}"></script>

    <!-- append theme customizer -->
    <script src="{{ url('lib/js-cookie/js.cookie.js')}}"></script>
    <script src="{{ url('assets/js/dashforge.settings.js')}}"></script>
    <script>
      $(function(){
        'use script'

        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }
      })
    </script>
  </body>
</html>
