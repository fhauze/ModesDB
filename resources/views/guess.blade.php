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
    <!-- <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png"> -->

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <!-- <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png"> -->
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

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{ url('assets/css/dashforge.landing.css')}}">

    <!-- Map  -->
    <!-- <link href="{{('/lib/prismjs/themes/prism-vs.css')}}" rel="stylesheet"> -->
    <link href="{{ url('lib/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">

  </head>
  <body class="home-body container">
    @include('layouts.guess.header')
    <div class="home-slider container">
      <div class="home-lead">
         <div class="df-logo-initial mg-b-15"><p>iMf</p></div>
          <p class="home-text">Indonesian <span class="nsv-link">M</span>odest Fashion</p>
          <p class="c">
            <span class="text-devider">
            Fesyen modest adalah gaya berbusana yang menonjolkan nilai-nilai kesopanan sekaligus memadukan unsur estetika dan keindahan. 
            Gaya ini dirancang untuk memberikan kenyamanan dan perlindungan dengan menutup sebagian besar bagian tubuh manusia, namun tetap mengutamakan kreativitas dalam desain dan pilihan material. 
            Fesyen modest tidak hanya memenuhi standar kesopanan, tetapi juga merepresentasikan identitas budaya, kepribadian, dan kepercayaan pemakainya.
            Di Indonesia, fesyen modest semakin berkembang menjadi bagian penting dari industri kreatif, mencerminkan kekayaan tradisi lokal yang diadaptasi ke dalam tren global. 
            Berbagai desainer Tanah Air mengombinasikan elemen tradisional seperti batik, songket, dan tenun dengan potongan modern, menciptakan busana yang tidak hanya sopan, tetapi juga elegan dan relevan di berbagai acara, baik formal maupun santai.
            </span>
          </p>

        {{-- <div class="d-flex wd-lg-350">
          <a href="" class="btn btn-brand-01 btn-uppercase flex-fill">Pops</a>
          <a href="" class="btn btn-white btn-uppercase flex-fill mg-l-10">Explore Data</a>
        </div> --}}

        <div class="text-left mt-2 p-0"><i>Powered By</i></div>
        <div class="d-flex tx-20 mg-t-0">
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

        {{-- <div class="tx-12 mg-t-40">
          <a href="docs.html" class="link-03">Doc<span class="d-none d-sm-inline">umentation</span><span class="d-sm-none">s</span></a>
          <a href="changelog.html" class="link-03 mg-l-10 mg-sm-l-20">Changelog</a>
          <a href="https://themeforest.net/licenses/standard" target="_blank" class="link-03 mg-l-10 mg-sm-l-20">Licenses</a>
          <a href="https://themeforest.net/page/customer_refund_policy" target="_blank" class="link-03 mg-l-10 mg-sm-l-20">Refund Policy</a>
        </div> --}}
      </div>
      <div class="home-slider-img">
        <div><img src="assets/img/modest-1.jpg" alt=""></div>
        <div><img src="assets/img/modest-2.jpg" alt=""></div>
        <div><img src="assets/img/modest-4.jpg" alt=""></div>
      </div>
      <!-- <div class="home-slider-bg-one"></div> -->
    </div><!-- home-slider -->

    <div class="row container mw-100 m-2">
      <div class="content content-components">
        <div class="container">
          <div data-label="Example" class="col-12">
              <div id="myCarousel" class="mw-100 carousel slide m-0" data-bs-ride="carousel">
                <div class="carousel-inner w-100">
                  <div class="carousel-item active">
                    <div class="row justify-content-center">
                      <div class="col-md-3">
                        <div class="card card-body">
                          <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row justify-content-center">
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card-body">
                        <img class="img-fluid" src="assets/img/modest-1.jpg?text=iMf">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row container mw-100 m-2">
      <div class="content content-components">
        <div class="container">
          <div data-label="Example" class="col-12">
            <div id="map" class="ht-400"></div>
          </div>
        </div>
      </div>
    </div>
    <br/>
    <div class="row container container mw-100 m-2 ">
      <div class="content content-components">
        <div class="container">
          <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card mg-b-12">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">Your Most Recent Earnings</h6>
                  <p class="tx-13 tx-color-03 mg-b-0">Your sales and referral earnings over the last 30 days</p>
                </div>
                <div class="d-flex mg-t-20 mg-sm-t-0">
                  <div class="btn-group flex-fill">
                    <button class="btn btn-white btn-xs active">Range</button>
                    <button class="btn btn-white btn-xs">Period</button>
                  </div>
                </div>
              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                  <div class="media align-items-center">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Gross Earnings</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,958,104</h4>
                    </div>
                  </div>
                  <div class="media align-items-center mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Tax Withheld</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$234,769<small>.50</small></h4>
                    </div>
                  </div>
                  <div class="media align-items-center mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Net Earnings</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,608,469<small>.50</small></h4>
                    </div>
                  </div>
                </div>
              </div><!-- card-body -->
              <div class="table-responsive">
                <table class="table table-dashboard mg-b-0">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th class="text-right">Sales Count</th>
                      <th class="text-right">Gross Earnings</th>
                      <th class="text-right">Tax Withheld</th>
                      <th class="text-right">Net Earnings</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/05/2018</td>
                      <td class="tx-medium text-right">1,050</td>
                      <td class="text-right tx-teal">+ $32,580.00</td>
                      <td class="text-right tx-pink">- $3,023.10</td>
                      <td class="tx-medium text-right">$28,670.90 <span class="mg-l-5 tx-10 tx-normal tx-success d-inline-flex align-items-center"><ion-icon name="arrow-up-outline" class="mg-b-3"></ion-icon> 4.5%</span></td>
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                      <td class="text-right tx-pink">- $2,780.00</td>
                      <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger d-inline-flex align-items-center"><ion-icon name="arrow-down-outline" class="mg-b-3"></ion-icon> 0.8%</span></td>
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                      <td class="text-right tx-pink">- $2,780.00</td>
                      <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger d-inline-flex align-items-center"><ion-icon name="arrow-down-outline" class="mg-b-3"></ion-icon> 0.8%</span></td>
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                      <td class="text-right tx-pink">- $2,780.00</td>
                      <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger d-inline-flex align-items-center"><ion-icon name="arrow-up-outline" class="mg-b-3"></ion-icon> 0.8%</span></td>
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                      <td class="text-right tx-pink">- $2,780.00</td>
                      <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger d-inline-flex align-items-center"><ion-icon name="arrow-up-outline" class="mg-b-3"></ion-icon> 0.8%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->
            <div class="card card-body ht-lg-100">
              {{-- <div class="media align-items-center">
                <span class="tx-color-04"><i data-feather="download" class="wd-60 ht-60"></i></span>
                <div class="media-body mg-l-20">
                  <h6 class="mg-b-10">Download your earnings in CSV format.</h6>
                  <p class="tx-color-03 mg-b-0">Open it in a spreadsheet and perform your own calculations, graphing etc.</p>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.admin.footer')
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('/lib/leaflet/leaflet.js')}}"></script>

    <script src="assets/js/dashforge.js"></script>
    <script>
      $(document).ready(function() {
        'use strict'

        $('[data-toggle="tooltip"]').tooltip()


      });

      $(function(){
        'use strict';
        const map = L.map('map', {
          minZoom: 5,
          maxZoom: 13,
          maxBounds: [[-11, 95], [6, 141]], // Wilayah Indonesia (koordinat barat daya dan timur laut)
          maxBoundsViscosity: 1.0
        }).setView([-2.5489, 118.0149], 5);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const popup = L.popup()
        .setLatLng([-6.2, 106.8166]) // Contoh lokasi: Jakarta
        .setContent('Selamat datang di Jakarta, Indonesia!')
        .openOn(map);

        const islands = [
          { name: "Sumatera", coords: [0.7893, 102.265], color: "red" },
          { name: "Jawa", coords: [-7.6145, 110.7123], color: "blue" },
          { name: "Kalimantan", coords: [0.2742, 113.9536], color: "green" },
          { name: "Sulawesi", coords: [-1.4301, 121.4457], color: "yellow" },
          { name: "Papua", coords: [-4.2699, 138.0803], color: "purple" },
        ];

        islands.forEach(island => {
          // Tambahkan marker
          L.marker(island.coords).addTo(map)
            .bindPopup(`<b>${island.name}</b>`);

          // Tambahkan polygon (hanya perkiraan wilayah)
          // const region = {
          //   "Sumatera": [[6, 95], [6, 105], [-5, 105], [-5, 95]],
          //   "Jawa": [[-5, 105], [-5, 115], [-8.5, 115], [-8.5, 105]],
          //   "Kalimantan": [[5, 108], [5, 120], [-2, 120], [-2, 108]],
          //   "Sulawesi": [[3, 118], [3, 125], [-5, 125], [-5, 118]],
          //   "Papua": [[-1, 130], [-1, 141], [-10, 141], [-10, 130]]
          // };

          // if (region[island.name]) {
          //   L.polygon(region[island.name], { color: island.color, fillOpacity: 0.4 })
          //     .addTo(map)
          //     .bindPopup(`<b>Wilayah ${island.name}</b>`);
          // }
        });

      });

    </script>
  </body>
</html>
