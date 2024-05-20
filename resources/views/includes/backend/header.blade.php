
<!DOCTYPE html>
<html lang="en" data-layout-mode="detached">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | SkaieventHub a product from Skaimount</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SkaiTheme" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('root/hyp/assets/images/logo-dark-sm.png') }}">


    <!-- Theme Config Js -->
    <link href="{{ asset('root/hyp/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('root/hyp/assets/js/hyper-config.js') }}"></script>

    {{-- OTHERS THEMES --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('root/dek/assets/icon/feather/css/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('root/dek/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('root/dek/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('root/dek/assets/icon/font-awesome/css/font-awesome.min.css') }}">



    <link href="{{ asset('root/hyp/assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('root/hyp/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="{{ asset('root/dek/assets/css/component.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('root/dek/bower_components/sweetalert/css/sweetalert.css') }}">

    <!-- Datatable css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css" />



    @yield('additional-css')


</head>

<body>
