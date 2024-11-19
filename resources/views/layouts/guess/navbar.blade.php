<a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
<div class="navbar-brand">
    <a href="../index.html" class="df-logo">iMo.<span>fahsion</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
        @include('layouts/logo')
    </div><!-- navbar-menu-wrapper -->
<div class="navbar-right m-0">
    {{-- <a href="http://dribbble.com/themepixels" class="btn btn-social m-2"><i class="fab fa-google"></i></a> --}}
    <!-- <a href="https://github.com/themepixels" class="btn btn-social"><i class="fab fa-github"></i></a>
    <a href="https://twitter.com/themepixels" class="btn btn-social"><i class="fab fa-twitter"></i></a> -->
    <!-- <a href="https://themeforest.net/item/dashforge-responsive-admin-dashboard-template/23725961" class="btn btn-buy"><i data-feather="shopping-bag"></i> <span>Buy Now</span></a> -->
    <a href="{{ route('login') }}" class="btn btn-primary m-2">
        Sign In
    </a>
    <a href="{{ route('register') }}" class="btn btn-secondary m-1">
        Sign Up
    </a>
</div><!-- navbar-right -->