@extends('frontend.layouts.signup-event')

@section('title', 'WELCOME TO')

@section('content')

    <!-- destination-area -->
    <section class="destination-area destination-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title">
                        <span class="sub-title">Offer Deals</span>
                        <h2 class="title">Your Great Destination</h2>
                    </div>
                    <div class="destination-content">
                        <p>Get your event online – break the barrier of client walking to buy ticket, or printing hard card for ticket - jera instant saving 10% or more with <span>{{ env('APP_NAME')}}</span> account</p>
                        <ul>
                            <li>
                                <div class="counter-item">
                                    <div class="counter-content">
                                        <h2 class="count">over <span class="odometer" data-count="9999"></span>+</h2>
                                        <p>Happy Customers</p>
                                    </div>
                                    <div class="counter-icon">
                                        <i class="flaticon-group"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="counter-item">
                                    <div class="counter-content">
                                        <h2 class="count"><span class="odometer" data-count="100"></span>%</h2>
                                        <p>Client Setisfied</p>
                                    </div>
                                    <div class="counter-icon">
                                        <i class="flaticon-globe"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="content-bottom">
                            <p>Do you want to play an ads on our system, is that your worry...?</p>
                            <a href="{{ route('contact-us')}}">contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- destination-area-end -->


    <!-- booking-details-area -->
    <section class="booking-details-area">
        <div class="container" style="margin-bottom: 50px; margin-top: 50px !important">
            <div class="row justify-content-center">

                {{-- <div class="col-sm-6 col-md-3">
                    <div class="flight-offer-item offer-item-two">
                        <div class="flight-offer-thumb">
                            <img src="{{ asset ('root/forms/assets/img/images/offer_img03.jpg') }}" alt="">
                        </div>
                        <div class="flight-offer-content">
                            <h2 class="title">New York to California</h2>
                            <span>09 Jun 2022 - 16 Jun 2022</span>
                            <p>Economy from</p>
                            <h4 class="price">$ 290</h4>
                        </div>
                        <div class="overlay-content">
                            <h2 class="title">New York to California</h2>
                            <span>09 Jun 2022 - 16 Jun 2022</span>
                            <p>Economy from</p>
                            <h4 class="price">$ 290</h4>
                            <div class="content-bottom">
                                <a href="booking-details.html" class="btn">Booking Now</a>
                                <a href="booking-list.html" class="discover">Discover</a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event-Index')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-file"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Rules & Regulations</h6>
                                <p>Get to know more about how things are done when using our system</p>
                                <a href="{{ route('en.event-Index')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event-Index')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Create Event</h6>
                                <p>Use this platform to create your event and serve it online for clients to reach out</p>
                                <a href="{{ route('en.event-Index')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event.subscribe')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-coding"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Initialize Payment</h6>
                                <p>Do you want to reinitialize the previous subscription payment, then use this props</p>
                                <a href="{{ route('en.event.subscribe')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event.subscribe')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-exchange"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Payment Policies</h6>
                                <p>Know more about our payment, how we accept fund and our we disburse them to stakeholders</p>
                                <a href="{{ route('en.event.subscribe')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event.subscribe')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-discount"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">SMS Regulations</h6>
                                <p>Know more about our payment, how we accept fund and our we disburse them to stakeholders</p>
                                <a href="{{ route('en.event.subscribe')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event.subscribe')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-discount"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Hire Our Team</h6>
                                <p>Get developers and system analysts from us to manage or design your system for you</p>
                                <a href="{{ route('en.event.subscribe')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div><div class="col-xl-4 col-md-4 col-sm-10">
                    <a href="{{ route('en.event.subscribe')}}">
                        <div class="features-item">
                            <div class="features-icon">
                                <i class="flaticon-discount"></i>
                            </div>
                            <div class="features-content">
                                <h6 class="title">Hire Our Team</h6>
                                <p>Get developers and system analysts from us to manage or design your system for you</p>
                                <a href="{{ route('en.event.subscribe')}}" class="text-succes">Discover More</a>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </section>
    <!-- booking-details-area-end -->

@endsection
