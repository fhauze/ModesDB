@include('layouts.head')
  @include('layouts.admin.header')
  <div class="content ht-100v pd-0">
    <div class="content-body">
      <div class="row row-xs">
        @yield('crumb')
        <div class="col-md-12">
          <div class="card card-body">
            @yield('content')
          </div>
        </div><!-- container -->
      </div>
    </div>
  </div>


  </div>
  @include('layouts.admin.footer')
  @yield('js')
