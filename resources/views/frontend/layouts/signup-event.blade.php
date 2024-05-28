<!doctype html>
<html class="no-js" lang="">


@include('includes.frontend.en.header')

<body class="white-background">

    <!-- preloader -->
    @include('includes.frontend.en.preloader')
    <!-- preloader-end -->

    @include('includes.frontend.en.headerBar')

    <!-- main-area -->
    <main>

        @yield('content')

    </main>
    <!-- main-area-end -->

    <!-- footer-area -->
    @include('includes.frontend.en.footer')

</body>

</html>
