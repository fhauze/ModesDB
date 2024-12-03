    <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand" style="margin-left:20px !important;">
        <a href="../index.html" class="df-logo">iMo.<span>fahsion</span></a>
        </div><!-- navbar-brand -->
        <div id="navbarMenu" class="navbar-menu-wrapper">
        @include('layouts/logo')
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right mr-0">
        {{-- <a href="http://dribbble.com/themepixels" class="btn btn-social m-2"><i class="fab fa-google"></i></a> --}}
        <!-- <a href="https://github.com/themepixels" class="btn btn-social"><i class="fab fa-github"></i></a>
        <a href="https://twitter.com/themepixels" class="btn btn-social"><i class="fab fa-twitter"></i></a> -->
        <!-- <a href="https://themeforest.net/item/dashforge-responsive-admin-dashboard-template/23725961" class="btn btn-buy"><i data-feather="shopping-bag"></i> <span>Buy Now</span></a> -->
        @if(!Auth::user())
        <a href="{{ route('login') }}" class="btn btn-sm">
            Masuk
        </a>
        <a href="{{ route('register') }}" class="btn btn-sm">
            Daftar
        </a>
        @else
        
        <div class="aside-loggedin d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center">
                <div class="aside-alert-link pt-2">
                    <a href="{{ route('adm.home') }}" class="btn">
                        <i data-feather="pie-chart"></i> Admin Page
                    </a>
                    <a href="" data-bs-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
                </div>
            </div>
        </div>
        @endif
    </div><!-- navbar-right -->