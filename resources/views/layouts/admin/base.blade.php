<!DOCTYPE html>
<html lang="en">
  @include('layouts.head')
  <body class="page-profile">
  @include('layouts.admin.header')
  <div class="d-flex flex-wrap">
    <div class="col-2">@include('layouts.admin.mail_side')</div>
    <div class="col-10">
      <div class="d-flex justify-content-center">
          <div class="content content-fixed">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                @yield('crumb')
                <div class="row row-xs">
                  @yield('content')
                </div><!-- row -->
            </div><!-- container -->
          </div><!-- content -->
      </div>
    </div>
  </div>
  @include('layouts.admin.footer')
  @stack('js')
  </body>
</html>
