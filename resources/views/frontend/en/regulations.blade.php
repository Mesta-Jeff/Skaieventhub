@extends('frontend.layouts.signup-event')

@section('title', 'Rules and Regulations')

@section('content')


    <!-- customer-details-area -->
    <section class="customer-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="customer-details-content">
                        <div class="content">
                            <h2 class="title">RULES AND REGULATIONS YOU MUST READ BEFORE CREATING ACCOUNT WITH US...</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- customer-details-area-end -->

    <!-- booking-details-area -->
    <section class="booking-details-area">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-100">
                    <div class="booking-list-item">
                        <div class="booking-list-item-inner">
                            <div class="booking-list-top">
                                <div class="flight-airway">
                                    <div class="flight-logo">
                                        <i class="css fa-regular fa-user" style="margin-right: 15px; font-size: 20px;"></i>
                                        <h5 class="css title">Personal Information</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-list-bottom">
                                <ul>
                                    <li class="css detail"><i class="fa-solid fa-angle-down"></i> Click here</li>
                                </ul>
                            </div>
                        </div>
                        <div class="flight-detail-wrap">
                            <div class="booking-details-wrap">
                                <div class="form-grp checkbox-grp">
                                    <input type="checkbox" id="checkbox">
                                    <label for="checkbox">Add this person to passenger quick pick list</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="booking-sidebar">
                        <h2 class="main-title">Booking Info</h2>
                        <div class="widget">
                            <h2 class="widget-title">Select Discount Option</h2>

                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('en.event')}}" class="btn">Continue from here</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- booking-details-area-end -->

@endsection
