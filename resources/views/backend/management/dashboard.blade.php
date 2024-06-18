

@extends('backend.layouts.app')

@section('title', 'Management Home Page')

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a >{{ env('APP_NAME')}}</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
                <h4 class="page-title"><i class="mdi mdi-home me-1"></i> Welcome to {{ env('APP_NAME')}} @yield('title')</h4>
            </div>
            {{-- <hr style="margin-top: -20px;" width="100%"> --}}
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="row col-md-12" style="margin-left: 5px">
            <span><i class="mdi mdi-bell-outline me-1"></i>Quick Flash Alert</span>
            <hr style="margin-top: 1px;" width="100%">
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card cta-box bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-center">
                        <div class="w-100 overflow-hidden">
                            <h2 class="m-0 cta-box-title text-reset">
                                <i class="mdi mdi-bell-outline"></i> 
                                The content of the message here... 
                                <a class="btn btn-soft-warning btn-sm" >Click here</a>
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
       
        
        <div class="col-xxl-9">
            <div class="row">

                <!-- ANNOUNCEMENT AREA -->
                <div class="row col-md-12" style="margin-left: 5px">
                    <span><i class="mdi mdi-bullhorn-outline me-1"></i>Announcement Area</span>
                    <hr style="margin-top: 1px;" width="100%">
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="card cta-box bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-center">
                                <div class="w-100 overflow-hidden">
                                    <h2 class="mt-0 text-reset"><i class="mdi mdi-bullhorn-outline"></i>&nbsp;</h2>
                                    <h3 class="m-0 fw-normal cta-box-title text-reset">Enhance your <b>Campaign</b> for better outreach</h3>
                                </div>
                                <img class="ms-3" src="{{ asset('root/hyp/assets/images/svg/email-campaign.svg')}}" width="120" alt="#">
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->
                </div>

                <!-- end col -->
                <div class="row col-md-12" style="margin-left: 5px">
                    <span><i class="mdi mdi-briefcase-outline me-1"></i>Event Statistics</span>
                    <hr style="margin-top: 1px;" width="100%">
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="dashboard-wallet.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-cached me-1"></i>Refresh</a>
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-delete-outline me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle">
                                        <span class="avatar-title bg-success-lighten h3 my-0 text-success rounded-circle">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mt-0 mb-1 font-20">0</h4>
                                </div>
                            </div>
                            <div class="row align-items-end justify-content-between mt-1">
                                <div class="col-sm-12">
                                    <h4 class="text-success fw-semibold mb-1">Total Views</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="dashboard-wallet.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-cached me-1"></i>Refresh</a>
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-delete-outline me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle">
                                        <span class="avatar-title bg-primary-lighten h3 my-0 text-primary rounded-circle">
                                            <i class="mdi mdi-comment-outline"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mt-0 mb-1 font-20">0</h4>
                                </div>
                            </div>
                            <div class="row align-items-end justify-content-between mt-1">
                                <div class="col-sm-12">
                                    <h4 class="text-primary fw-semibold mb-1">Total Comments</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="dashboard-wallet.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-cached me-1"></i>Refresh</a>
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-delete-outline me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle">
                                        <span class="avatar-title bg-warning-lighten h3 my-0 text-warning rounded-circle">
                                            <i class="mdi mdi-star-outline"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mt-0 mb-1 font-20">0</h4>
                                </div>
                            </div>
                            <div class="row align-items-end justify-content-between mt-1">
                                <div class="col-sm-12">
                                    <h4 class="text-warning fw-semibold mb-1">Total Stars</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="dashboard-wallet.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-cached me-1"></i>Refresh</a>
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-delete-outline me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle">
                                        <span class="avatar-title bg-info-lighten h3 my-0 text-info rounded-circle">
                                            <i class="mdi mdi-thumb-up-outline"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mt-0 mb-1 font-20">0</h4>
                                </div>
                            </div>
                            <div class="row align-items-end justify-content-between mt-1">
                                <div class="col-sm-12">
                                    <h4 class="text-info fw-semibold mb-1">Total Likes</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-xxl-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Money History</h4>
                        </div>

                        <div class="card-body pt-0">
                            <div class="border border-light p-3 rounded mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="font-18 mb-1">Income</p>
                                        <h3 class="text-primary my-0">$2,76,548</h3>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-primary rounded-circle h3 my-0">
                                            <i class="mdi mdi-arrow-up-bold-outline"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List of events added -->
                <div class="col-md-6 col-xxl-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><i class="mdi mdi-briefcase me-1"></i>List of added events</h4>
                        </div>

                        <div id="event-container" class="card-body pt-0 mb-2" data-simplebar style="max-height: 150px;">

                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-success-lighten text-success border border-success rounded-circle h3 my-0">1</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Title here</h4>
                                    <p class="mb-0 text-muted">Event type here</p>
                                </div>
                                <p class="mb-0 text-success"><i class="mdi mdi-briefcase me-1"></i>Date here</p>
                            </div>
                            <hr>

                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-success-lighten text-success border border-success rounded-circle h3 my-0">2</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Title here</h4>
                                    <p class="mb-0 text-muted">Event type here</p>
                                </div>
                                <p class="mb-0 text-success"><i class="mdi mdi-briefcase me-1"></i>Date here</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- List of  -->
                <div class="row col-md-12" style="margin-left: 5px">
                    <span><i class="mdi mdi-bell-outline me-1"></i>Management Request</span>
                    <hr style="margin-top: 1px;" width="100%">
                </div>
                <div class="col-md-6 col-xxl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><i class="mdi mdi-briefcase me-1"></i>Section E</h4>
                        </div>

                        <div id="event-container" class="card-body pt-0 mb-2" data-simplebar>

                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-success-lighten text-success border border-success rounded-circle h3 my-0">1</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Title here</h4>
                                    <p class="mb-0 text-muted">Event type here</p>
                                </div>
                                <p class="mb-0 text-success"><i class="mdi mdi-briefcase me-1"></i>Date here</p>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            <!-- end row -->
        </div>
        <!-- end col -->

        <div class="col-xxl-3">
            <div class="row">

                <div class="row col-md-12" style="margin-left: 5px">
                    <span><i class="mdi mdi-lock-outline me-1"></i>State Request</span>
                    <hr style="margin-top: 1px;" width="100%">
                </div>
                <div class="col-md-6 col-xxl-12">
                    <div class="card bg-success card-bg-img" style="background-image: url(assets/images/bg-pattern.png);">
                        <div class="card-body">
                            <span class="float-end text-white-50 display-5 mt-n1"><i class="mdi mdi-contactless-payment"></i></span>
                            <h4 class="text-white">Username here</h4>

                            <div class="row mt-4">
                                <div class="col-4">
                                    <p class="text-white-50 font-16 mb-1">Expiry Date</p>
                                    <h4 class="text-white my-0">10/26</h4>
                                </div>

                                <div class="col-4">
                                    <p class="text-white-50 font-16 mb-1">Token</p>
                                    <h4 class="text-white my-0">--</h4>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                        <span class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block"></span>
                                        <span class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block ms-n3"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xxl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Section C</h4>
                            <div class="dropdown">
                                <a href="dashboard-wallet.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-cached me-1"></i>Refresh</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-circle-edit-outline me-1"></i>Edit</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-delete-outline me-1"></i>Remove</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 mb-2" data-simplebar style="max-height: 319px;">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-warning-lighten text-warning border border-warning rounded-circle h3 my-0">
                                            <i class="mdi mdi-currency-btc"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Bitcoin (BTC)</h4>
                                    <p class="mb-0 text-muted">$48,665.80</p>
                                </div>
                                <p class="mb-0 text-success"><i class="mdi mdi-trending-up me-1"></i>10%</p>
                            </div>
                            <hr>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row col-md-12" style="margin-left: 5px">
        <span><i class="mdi mdi-cog-outline me-1"></i>System Controls</span>
        <hr style="margin-top: 1px;" width="100%">
    </div>
    <div class="col-md-6 col-xxl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title"><i class="mdi mdi-home me-1"></i>Section F</h4>
            </div>

            <div id="event-container" class="card-body pt-0 mb-2" data-simplebar>

                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 ms-2">
                        <h4 class="mt-0 mb-1 font-16 fw-semibold">Title here</h4>
                        <p class="mb-0 text-muted">Event type here</p>
                    </div>
                    <p class="mb-0 text-success"><i class="mdi mdi-briefcase me-1"></i>Date here</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
