<footer class="footer position-fixed bottom-0 w-100 bg-light text-center py-2">
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
<script src="{{ url('lib/ionicons/ionicons/ionicons.esm.js')}}" type="module"></script>
<script src="{{ url('lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ url('lib/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{ url('lib/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{ url('lib/jquery.flot/jquery.flot.stack.js')}}"></script>
<script src="{{ url('lib/jquery.flot/jquery.flot.resize.js')}}"></script>

<script src="{{ url('assets/js/dashforge.js')}}"></script>
<script src="{{ url('assets/js/dashforge.sampledata.js')}}"></script>
<script src="{{ url('assets/js/dashboard-two.js')}}"></script>

<!-- append theme customizer -->
<script src="{{ url('lib/js-cookie/js.cookie.js')}}"></script>
<!-- <script src="{{ url('assets/js/dashforge.settings.js')}}"></script> -->
<script src="{{ url('assets/js/dashforge.aside.js')}}"></script>

<!-- Data table -->
<script src="{{ url('lib/prismjs/prism.js')}}"></script>
<script src="{{ url('lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ url('lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ url('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{ url('assets/js/select2.full.min.js')}}"></script>
<script src="{{ url('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ url('assets/js/yearpicker.js')}}"></script>

@yield('scripts')