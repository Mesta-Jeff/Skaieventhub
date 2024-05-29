@extends('frontend.layouts.signup-event')

@section('title', 'Event Subscription')

@section('content')


    <!-- customer-details-area -->
    <section class="customer-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="customer-details-content">
                        <div class="content text-center">
                            <h2 class="title">EVENT SUBSCRIPTION</h2>
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

            <div class="row justify-content-center" style="margin-top: -60px !important" >
                <div class="col-md-6 booking-details-wrap" style="background-color: transparent;" >
    
                    <div class="booking-sidebar shadow">
                        <h2 class="main-title">Subscription & Setup fees</h2>
                        <div class="widget">
                            <h2 class="widget-title">Detail about your event</h2>

                            <div class="col-md-12">
                                <div class="form-grp mb-3">
                                    <div class="form">
                                        <label for="shortBy">Title</label>
                                        <input type="text" id="event-title" value="Skai Excellence Award" disabled>
                                    </div>
                                </div>
                                <div class="form-grp mb-3">
                                    <div class="form">
                                        <label for="shortBy">Initials</label>
                                        <input type="text" id="event-title" value="SkaiEA'24" disabled>
                                    </div>
                                </div>
                                <div class="form-grp mb-3">
                                    <div class="form">
                                        <label for="shortBy">Type of Event you selected</label>
                                        <input type="text" id="event-title" value="Dinner & Awards" disabled>
                                    </div>
                                </div>
                                <p class="widget-title mb-2">How have you plan to make your payment</p>
                                <div class="form-grp">
                                    <div class="form">
                                        <label for="gender">Select Payment Plan</label>
                                        <select id="payment_plan" name="select" class="form-select"
                                            aria-label="Default select example">
                                            <option value="">--- Select option ---</option>
                                            <option value="Instant">Pay Now</option>
                                            <option value="On-Request">Pay Later</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="text-center">Amount to pay for the subscription and setup only <h2 class="price">GH29.00</h2></span>
                            </div>

                            <div class="text-center">
                                <a class="btn">Make Payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 booking-details-wrap" style="background-color: transparent; margin-top: -70px">
                    <div class="booking-sidebar shadow">
                        <h2 class="main-title">Re-initializing payment</h2>
                        <div class="widget">
                            <h2 class="widget-title">Provide the information below to be able to reinitialize</h2>

                            <div class="col-md-12">
                                <div class="form-grp">
                                    <div class="form">
                                        <label for="shortBy">What is the title of your event</label>
                                        <input type="text" id="event-title" placeholder="eg. Skai Excellence Award">
                                    </div>
                                </div>
                                <div class="form-grp">
                                    <div class="form">
                                        <label for="shortBy">Email you used when creating your account</label>
                                        <input type="text" id="emails" placeholder="eg. odenehonas1@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn">Re-Initialize Payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- booking-details-area-end -->

@endsection
