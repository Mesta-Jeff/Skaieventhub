@extends('frontend.layouts.signup-event')

@section('title', 'Contact Us')

@section('content')



    <!-- booking-details-area -->
    <section class="booking-details-area">
        <div class="container">
            <div class="row justify-content-center">


                <div class="row justify-content-center">
                    <div class="col-md-12 booking-details-wrap"
                        style="background-color: transparent; margin-bottom: -80px;">
                        <div class="booking-sidebar shadow">
                            <h2 class="main-title">Our Address and contact details</h2>
                            <div class="widget">
                                <h2 class="widget-title">Do you want to get to specific office direct, then check out the team you need help from and get to them</h2>

                                <div class="row col-md-12 contact-form">

                                    <div class="col-xl-6 col-md-6 col-sm-10">
                                        <div class="features-item">
                                            <div class="features-icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="features-content">
                                                <h6 class="title">General Information</h6>
                                                <p>Phone: <span>0000000</span></p>
                                                <p>Email: <span>info@skaimount.com</span></p>
                                                <p>Address: <span>Office (Accra - Spintex , Winneba) / Digital</span></p>
                                                <p>Time: <span>Mon - Sun (24hrs)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-10">
                                        <div class="features-item">
                                            <div class="features-icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="features-content">
                                                <h6 class="title">Management Assistance</h6>
                                                <p>Phone: <span>0000000</span></p>
                                                <p>Email: <span>ceo@skaimount.com</span></p>
                                                <p>Address: <span class="text-danger">Upon your request</span></p>
                                                <p>Time: <span>Mon - Sat (8:00 am - 6:00 pm)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-10">
                                        <div class="features-item">
                                            <div class="features-icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="features-content">
                                                <h6 class="title">Business Enquiries</h6>
                                                <p>Phone: <span>0000000</span></p>
                                                <p>Email: <span>service@skaimount.com</span></p>
                                                <p>Address: <span>Office (Accra - Spintex, Winneba) / Digital</span></p>
                                                <p>Time: <span>Mon - Fri (7:00 am - 7:00 pm)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-10">
                                        <div class="features-item">
                                            <div class="features-icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="features-content">
                                                <h6 class="title">Technical or Developing Team</h6>
                                                <p>Phone: <span>0000000</span></p>
                                                <p>Email: <span>team@skaimount.com</span></p>
                                                <p>Address: <span class="text-danger">Remote Only</span></p>
                                                <p>Time: <span>Mon - Sun (24hrs)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 booking-details-wrap" style="background-color: transparent;">
                        <div class="booking-sidebar shadow">
                            <h2 class="main-title">Send your message or views through</h2>
                            <div class="widget">
                                <div class="col-md-12 contact-form">

                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">Give us you email address so we can reach out to you
                                                back</label>
                                            <input type="text" id="emails" placeholder="eg. odenehonas1@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">The subject of your message</label>
                                            <input type="text" id="subject" placeholder="eg. Anything you dream of">
                                        </div>
                                    </div>
                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">How should we address you when responding to
                                                you...?</label>
                                            <input type="text" id="name"
                                                placeholder="eg. Messta Jeff or Florence Ayisi Tieku">
                                        </div>
                                    </div>
                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">Compose your message here</label>
                                            <textarea id="message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a class="btn">Send Message</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- booking-details-area-end -->

@endsection
