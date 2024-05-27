

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | Skai-Tick a product from Skaimount</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('root/hyp/assets/images/logo-dark-sm.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('root/vez/assets/js/layout.js') }}"></script>
    <link href="{{ asset('root/vez/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">

            @yield('content')

        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">All Right Reserved, &copy;
                                <script>document.write(new Date().getFullYear())</script> SkaiMount. Crafted with <i class="mdi mdi-heart text-danger"></i> by Skai Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>
    
    <script src="{{ asset('root/vez/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/particles.js/particles.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/pages/particles.app.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/pages/passowrd-create.init.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/pages/two-step-verification.init.js') }}"></script>

</body>

</html>
