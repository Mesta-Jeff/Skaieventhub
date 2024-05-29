@extends('frontend.layouts.signup-event')

@section('title', 'Creating Account')

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
                            <a href="/">contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- destination-area-end -->

    <!-- customer-details-area -->
    <section class="customer-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="customer-details-content">
                        <div class="content">
                            <h2 class="title">Please Note: You're expected to fill in with valid information. else the account won't be approved</h2>
                            <div class="customer-progress-wrap">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="customer-progress-step">
                                    <ul>
                                        <li>
                                            <span>1</span>
                                            <p>Personal Information</p>
                                        </li>
                                        <li>
                                            <span>2</span>
                                            <p>Event Details</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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

                <!-- Left side big bar -->
                <div class="col-73">

                    <!-- Personal Information -->
                    <div class="booking-list-item">
                        <div class="booking-list-item-inner">
                            <div class="booking-list-top">
                                <div class="flight-airway">
                                    <div class="flight-logo">
                                        <i class="css fa-regular fa-user" style="margin-right: 15px; font-size: 20px;"></i>
                                        <h5 class="css title">Personal Information</h5>
                                    </div>
                                    <span class="css">Provide a legal and public information about you, it very essential to us to know you before we grant you the access to use our platform</span>
                                </div>
                            </div>
                            <div class="booking-list-bottom">
                                <ul>
                                    <li class="css detail"><i class="fa-solid fa-angle-down"></i> Click here</li>
                                    <li class="css">Please Note: (False information can lead you to term of imprisonment)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="flight-detail-wrap">
                            <div class="booking-details-wrap">
                                <form id="author-form" action="post" enctype="multipart/form-data">

                                    <ul>
                                        <li>
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <select id="title" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">Mr.</option>
                                                        <option>Mrs.</option>
                                                        <option>Others..</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-grp mb-3">
                                                <input type="text" id="firstname" placeholder="Give Name">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-grp mb-3">
                                                <input type="text" id="lastname" placeholder="Sur Name *">
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Phone</label>
                                                    <input type="text" id="phone" maxlength="10" placeholder="0245482029">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Tel</label>
                                                    <input type="text" id="tel" maxlength="10" placeholder="0245482029">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Gender</label>
                                                    <select id="gender" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">---Select option---</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Date of Birth</label>
                                                    <input type="text" id="dob" class="date" placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Email</label>
                                                    <input type="text" id="emails" placeholder="odenehonas1@gmail.com">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Identity Type</label>
                                                    <select id="id_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">---Select option---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Identity Number</label>
                                                    <input id="id_num" type="text" placeholder="Id Number here">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Upload scan id</label>
                                                    <input type="file" id="scans">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Account Type</label>
                                                    <select id="acc_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">---Select option---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Account Number</label>
                                                    <input type="text" id="acc_num" placeholder="Account Number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Account Branch (if momo, use the providers name)</label>
                                                    <input type="text" id="acc_branch" placeholder="eg. MTN or Ecobank">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Upload profile image</label>
                                                    <input type="file" id="profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="optional-item">
                                        <div class="form-grp mb-3">
                                            <div class="form">
                                                <label for="email">Select your region of address</label>
                                                <select id="region_id" name="select" class="form-select select2"
                                                    aria-label="Default select example">
                                                    <option value="">Select  optional </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="district">Select district of address</label>
                                                    <select id="district_id" name="select" class="form-select select2"
                                                        aria-label="Default select example">
                                                        <option value="">---Select option---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-9 mt-4">
                                                <div class="form-grp mb-3">
                                                    <div class="form">
                                                        <label for="town">Where do you stay currently</label>
                                                        <select id="town_id" name="select" class="form-select select2"
                                                            aria-label="Default select example">
                                                            <option value="">---Select option---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-4">
                                                <div class="form-grp mb-3">
                                                    <div class="form">
                                                        <a href="#" class="btn" style="height: 20px !important">Add New Town</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- About event -->
                    <div class="booking-list-item">
                        <div class="booking-list-item-inner">
                            <div class="booking-list-top">
                                <div class="flight-airway">
                                    <div class="flight-logo">
                                        <i class="css fa-regular fa-calendar" style="margin-right: 15px; font-size: 20px;"></i>
                                        <h5 class="css title">Event Details</h5>
                                    </div>
                                    <span class="css">You need to give the vivid description of the event you want to host on our platform, most information can be provide after the event has or have been approved by management</span>
                                </div>
                            </div>
                            <div class="booking-list-bottom">
                                <ul>
                                    <li class="css detail"><i class="fa-solid fa-angle-down"></i> Click here</li>
                                    <li class="css">Please Note: (False information can lead you to term of imprisonment)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="flight-detail-wrap">
                            <div class="booking-details-wrap">
                                <form id="event-form" action="post" enctype="multipart/form-data">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Event Title</label>
                                                    <input type="text" id="title" placeholder="EVent main title here">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Sub Title</label>
                                                    <input type="text" id="sub_title" placeholder="EVent sub title here">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="contact-form">
                                            <div class="form-grp mb-3">
                                                <textarea id="contents" name="message" placeholder="What content do you want to show to viewers"></textarea>
                                            </div>
                                            <div class="form-grp mb-3">
                                                <textarea id="discription" name="message" placeholder="Describe your event not more than 500 words"></textarea>
                                            </div>
                                            <div class="form-grp mb-3">
                                                <textarea id="reason" name="message" placeholder="Give a comprehensive reason for creating the event it is required..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Event Type</label>
                                                    <select id="event_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">---Select option---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Alaises</label>
                                                    <input type="text" id="event_initials" placeholder="eg. VGMA24 or Emy Awards" maxlength="15">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Starting Date</label>
                                                    <input type="text" id="start_date" class="date" placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Ending Date</label>
                                                    <input type="text" id="end_date" class="date" placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Venue: (where is the event happening)</label>
                                                    <input type="text" id="venue" placeholder="eg. Accra-National Theatre">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="banner">Upload Banner for the event</label>
                                                    <input type="file" id="banner">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="large_image">Upload the large image</label>
                                                    <input type="file" id="large_image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="medium_image">Upload the medium image</label>
                                                    <input type="file" id="medium_image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="small_image">Upload small image</label>
                                                    <input type="file" id="small_image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="small_image">Upload promo video (Optional)</label>
                                                    <input type="file" id="promo_video">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="btn mt-3">Submit Data</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side right bar -->
                <div class="col-27">
                    <aside class="booking-sidebar">
                        <h2 class="main-title">Event Charges</h2>
                        <div class="widget" style="margin-bottom: -60px">
                            <h2 class="widget-title">Breakdown of the charges</h2>
                            <ul class="flight-info">
                                <li>
                                    <p>Subscription <span>GH00.00</span></p>
                                </li>
                                <li>
                                    <p>Set-Up <span>GH00.00</span></p>
                                </li>
                            </ul>
                            <hr>
                            <div class="text-center" style="margin-top: -20px, margin-bottom: 2px">
                                <a>Total: <h2>GH00.00</h2></a>
                            </div>
                        </div>
                        <div class="widget">
                            <h2 class="widget-title">Do you have a recommended coupon...?</h2>
                            <form action="#" class="discount-form">
                                <i class="flaticon-coupon"></i>
                                <input type="text" placeholder="Enter Code">
                                <button type="submit"><i class="flaticon-tick-1"></i></button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- booking-details-area-end -->

@endsection
