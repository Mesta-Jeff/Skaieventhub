

@include('includes.backend.header')

<!-- Pre-loader -->
@include('includes.backend.preloader')
<!-- End Preloader-->

<!-- Begin page -->
<div class="wrapper">


    <!-- ========== Topbar Start ========== -->
    @include('includes.backend.topbar')
    <!-- ========== Topbar End ========== -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('includes.backend.navigation')
    <!-- ========== Left Sidebar End ========== -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <!-- content -->
        <div class="content" id="app">

            @yield('content')

        </div>

        <!-- Footer Start -->
        @include('includes.backend.footer')
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    <section class="d-print-none">
        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn" data-bs-toggle="popover"
            data-bs-trigger="hover" data-bs-content="View Users online since the last 30 mins" title="{{ env('APP_NAME')}} Notice">
            <i class="ri-group-fill"></i> &nbsp;Users
        </a>
        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn2" data-bs-toggle="popover"
            data-bs-trigger="hover" data-bs-content="Visit the forum chat for current concerns" title="{{ env('APP_NAME')}} Notice">
            <i class="ri-bubble-chart-fill"></i> &nbsp;Forum
        </a>
    </section>


</div>
<!-- END wrapper -->


<!-- Theme Settings -->
@include('includes.backend.themsettings')


<!-- js -->
@include('includes.backend.footerscript')
