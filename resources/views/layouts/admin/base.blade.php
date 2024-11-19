@include('layouts.head')
  @include('layouts.admin.header')
  <div class="content ht-100v pd-0">
    <div class="content-body">
      <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cryptocurrency</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
          </div>
          <div class="d-none d-md-flex">
            <button class="btn btn-sm btn-primary btn-uppercase pd-x-20">BTC</button>
            <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">ETH</button>
            <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">LTC</button>
            <button class="btn btn-sm btn-white btn-uppercase pd-x-20 mg-l-5">BTG</button>
            <button class="btn btn-sm btn-icon btn-white btn-uppercase mg-l-5"><i data-feather="more-vertical"></i></button>
          </div>
        </div>
      <div class="row row-xs">
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
  @stack('js')
