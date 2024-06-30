@extends('frontend.layouts.signup-event')

@section('title', 'Creating Account')

@section('additional-css')
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
@endsection

@section('content')

    <style>

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 140px;
            height: 140px;
            margin: 10px;
            border: 2px solid teal;
        }
    </style>

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
                        <p>Get your event online – break the barrier of client walking to buy ticket, or printing hard card
                            for ticket - jera instant saving 10% or more with <span>{{ config('app.name') }}</span> account
                        </p>
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
                            <h2 class="title">Please Note: You're expected to fill in with valid information. else the
                                account won't be approved</h2>
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
                                    <span class="css">Provide a legal and public information about you, it very essential
                                        to us to know you before we grant you the access to use our platform</span>
                                </div>
                            </div>
                            <div class="booking-list-bottom">
                                <ul>
                                    <li class="css detail"><i class="fa-solid fa-angle-down"></i> Click here</li>
                                    <li class="css">Please Note: (False information can lead you to term of imprisonment)
                                    </li>
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
                                                    <label for="gender">Select your title</label>
                                                    <select id="personal_title" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected>Select option...</option>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Dr">Dr</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Pro">Prof</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">What is your first name</label>
                                                    <input type="text" id="firstname" placeholder="Given Name">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Your Lastname</label>
                                                    <input type="text" id="lastname" placeholder="Sur Name *">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Phone</label>
                                                    <input type="text" id="phone" maxlength="10"
                                                        placeholder="0245482029">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Tel</label>
                                                    <input type="text" id="tel" maxlength="10"
                                                        placeholder="0245482029">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Gender</label>
                                                    <select id="gender" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected>Select option...</option>
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
                                                    <input type="text" id="dob" class="date"
                                                        placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Email</label>
                                                    <input type="text" id="emails"
                                                        placeholder="odenehonas1@gmail.com">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Identity Type</label>
                                                    <select id="id_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="" disabled>Select option...</option>
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
                                                    <label for="email">Upload a pdf front & back scan of the id</label>
                                                    <input type="file" id="scans" accept=".pdf">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Account Type</label>
                                                    <select id="acc_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected>Select option...</option>
                                                        <option value="MoMo">Mobile Money</option>
                                                        <option value="Bank">Bank</option>
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
                                                    <label for="shortBy">Account Host(if momo, use the providers
                                                        name)</label>
                                                    <input type="text" id="acc_host"
                                                        placeholder="eg. MTN or Ecobank">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Account Branch (if momo, use the providers
                                                        name)</label>
                                                    <input type="text" id="acc_branch"
                                                        placeholder="eg. MTN or Telecel">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">What is the name on the account</label>
                                                    <input type="text" id="acc_owner"
                                                        placeholder="eg. Nana Ayisi Solomon Jeff">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Upload profile image</label>
                                                    <input type="file" id="profile" class="file-input"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                            <img id="profile-preview" class="img-fluid img-thumbnail mb-3" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="optional-item">
                                        <div class="form-grp mb-3">
                                            <div class="form">
                                                <label for="email">Select your region of address</label>
                                                <select id="region_id" name="select" class="form-select select2"
                                                    aria-label="Default select example">
                                                    <option value="">Select optional </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="district">Select district of address</label>
                                                    <select id="district_id" name="select" class="form-select select2"
                                                        aria-label="Default select example">
                                                        <option value="" disabled>Select option...</option>
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
                                                            <option value="" disabled>Select option...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-4">
                                                <div class="form-grp mb-3">
                                                    <div class="form">
                                                        <a href="javascript:void(0)" id="btnAddTown" class="btn"
                                                            style="height: 20px !important">Add New Town</a>
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
                                        <i class="css fa-regular fa-calendar"
                                            style="margin-right: 15px; font-size: 20px;"></i>
                                        <h5 class="css title">Event Details</h5>
                                    </div>
                                    <span class="css">You need to give the vivid description of the event you want to
                                        host on our platform, most information can be provide after the event has or have
                                        been approved by management</span>
                                </div>
                            </div>
                            <div class="booking-list-bottom">
                                <ul>
                                    <li class="css detail"><i class="fa-solid fa-angle-down"></i> Click here</li>
                                    <li class="css">Please Note: (False information can lead you to term of
                                        imprisonment)</li>
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
                                                    <input type="text" id="title"
                                                        placeholder="Event main title here">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="email">Sub Title</label>
                                                    <input type="text" id="sub_title"
                                                        placeholder="Event sub title here">
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
                                                <textarea id="reason" name="message"
                                                    placeholder="Give a comprehensive reason for creating the event it is required..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="gender">Event Type</label>
                                                    <select id="event_type" name="select" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="" disabled>Select option...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Alaises (15 Characters long)</label>
                                                    <input type="text" id="event_initials"
                                                        placeholder="eg. VGMA24 or Emy Awards" maxlength="15">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Starting Date</label>
                                                    <input type="text" id="start_date" class="date"
                                                        placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Ending Date</label>
                                                    <input type="text" id="end_date" class="date"
                                                        placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="shortBy">Venue: (where is the event happening)</label>
                                                    <input type="text" id="venue"
                                                        placeholder="eg. Accra-National Theatre">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="banner">Upload Banner (1920 by 1000 px Landscape image)</label>
                                                    <input type="file" id="banner" class="file-input"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="large_image">Upload the large image (1500 by 1500 px Portrait)</label>
                                                    <input type="file" id="large_image" class="file-input"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="medium_image">Upload the main image (1080 by 1080 px Square image)</label>
                                                    <input type="file" id="medium_image" class="file-input"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="small_image">Upload small image (900 by 900 px Square image)</label>
                                                    <input type="file" id="small_image" class="file-input"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-grp mb-3">
                                                <div class="form">
                                                    <label for="small_image">Upload promo video (Optional)</label>
                                                    <input type="file" id="promo_video" accept="video/*">
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <a href="javascript:void(0)" class="btn mt-3" id="save-data">Submit Data</a>
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
                            <h2 class="widget-title" id="price-title">Breakdown of the charges</h2>
                            <ul class="flight-info">
                                <li>
                                    <p>Subscription <span id="maintenancePrice">&#8373;00.00</span></p>
                                </li>
                                <li>
                                    <p>Set-Up <span id="setUPprice">&#8373;00.00</span></p>
                                </li>
                            </ul>
                            <hr>
                            <div class="text-center" style="margin-top: -20px, margin-bottom: 2px">
                                <a>Total: <h2 id="totalPrice">&#8373;00.00</h2></a>
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

    <div class="modal fade" id="imge-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image Before Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="sample_image" />
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@section('additional-js')
    <script src="{{ asset('root/vez/assets/js/pages/team.init.js') }}"></script>
@endsection

<script src="{{ asset('root/forms/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="https://unpkg.com/cropperjs"></script>


<script>


    function resetForm() {
        document.getElementById("author-form").reset();
        document.getElementById("event-form").reset();
    }
    // Call the function on page load
    window.onload = resetForm;


    $(document).ready(function() {

        var $modal = $('#imge-modal');
        var image = document.getElementById('sample_image');
        var cropper;
        var appName = "{{ config('app.name') }}";
        var converted_dob = '';
        var converted_sdate = '';
        var converted_edate = '';

        //PICTURE CHANGE
        $('#profile').change(function (event) {
            const fileInput = $(this);
            const file = event.target.files?.[0];
            if (!file) {
                showAlert('Error', 'Please select an image file.');
                fileInput.val(null);
                $('#profile-preview').attr('src', null);
                $(this).val(null)
                return;
            }
            if (!file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                showAlert('Error', 'Please select a valid image file (e.g., jpeg, png, jpg) within 2MB.');
                fileInput.val(null);
                $('#profile-preview').attr('src', null);
                $(this).val(null)
                return;
            }
            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;
                $modal.modal('show');
            };
            reader.readAsDataURL(file);
        });

        // Scan documents
        $('#scans').change(function(event) {
            var file = event.target.files[0];
            var fileType = file.type;
            var fileSize = file.size;
            var maxFileSize = 2 * 1024 * 1024;

            if (fileType !== 'application/pdf') {
                Swal.fire({
                    icon: 'error', title: 'Invalid File Type', text: 'Please upload a PDF file.',
                });
                $('#scans').val('');
                return;
            }
            if (fileSize > maxFileSize) {
                Swal.fire({
                    icon: 'error', title: 'File Too Large', text: 'The file size should not exceed 2MB.',
                });
                $('#scans').val('');
                return;
            }
        });

        //CALLING THE CROPPING MODAL
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview:'.preview'
            });
            }).on('hidden.bs.modal', function(){
                cropper.destroy();
                cropper = null;
        });

        //function to crop the selected image
        $('#crop').click(function(){

            var requiredWidth = 35;
            var requiredHeight = 45;

            var pixelsPerMM = 3;
            var widthInPixels = requiredWidth * pixelsPerMM;
            var heightInPixels = requiredHeight * pixelsPerMM;

            canvas = cropper.getCroppedCanvas({
                width: widthInPixels,
                height: heightInPixels
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result;
                    $('#profile-preview').attr('src', base64data);
                    $('#profile-preview').show();
                    $modal.modal('hide');
                };
            });
        });


        $('#dob, #start_date, #end_date').change(function() {
            var selectedDate = $(this).val();
            if (selectedDate) {
                var date = new Date(selectedDate);
                var formattedDate = date.toISOString().split('T')[0];

                if ($(this).attr('id') === 'dob') {
                    converted_dob = formattedDate;
                } else if ($(this).attr('id') === 'start_date') {
                    converted_sdate = formattedDate;
                } else if ($(this).attr('id') === 'end_date') {
                    converted_edate = formattedDate;
                }
            }
        });

        // Getting data for the regions
        $.ajax({
            url: '{{ route('settings.regions.get') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#region_id').empty();
                $('#region_id').append($('<option>', {
                    value: '',
                    text: 'Select option...',
                    selected: 'selected',
                    disabled: 'disabled'
                }));
                $.each(data.regions, function(key, value) {
                    $('#region_id').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        // Getting data for the event type
        $.ajax({
            url: '{{ route('events.types.get') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#event_type').empty();
                $('#event_type').append($('<option>', {
                    value: '',
                    text: 'Select option...',
                    selected: 'selected',
                    disabled: 'disabled'
                }));
                $.each(data.types, function(key, value) {
                    $('#event_type').append($('<option>', {
                        value: value.id,
                        text: value.event,
                        'data-prices': value.price
                    }));
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        $('#event_type').change(function() {
            var selectedOption = $(this).find('option:selected');
            var prices = selectedOption.data('prices');
            $('#totalPrice').text('₵' + prices);
            $('#maintenancePrice').text('₵' + (prices - 10).toFixed(2));
            $('#setUPprice').text('₵' + 10.00.toFixed(2));

        });


        // Getting data for IDS
        $.ajax({
            url: '{{ route('settings.identitytypes.get') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#id_type').empty();
                $('#id_type').append($('<option>', {
                    value: '',
                    text: 'Select option...',
                    selected: 'selected',
                    disabled: 'disabled'
                }));
                $.each(data.identities, function(key, value) {
                    $('#id_type').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        // Handle change event for region select
        $('#region_id').change(function() {
            var selected_id = $(this).val();
            if (selected_id) {
                $.ajax({
                    url: '{{ route('settings.districts.byRegion') }}',
                    type: 'GET',
                    data: {
                        region_id: selected_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#district_id').empty();
                        $('#district_id').append($('<option>', {
                            value: '',
                            text: 'Select option ...',
                            selected: 'selected',
                            disabled: 'disabled'
                        }));
                        $.each(data.filtered, function(key, value) {
                            $('#district_id').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + ", " +
                            errorThrown);
                    }
                });
            }
        });

        // Handle change event for region select
        $('#district_id').change(function() {
            var selected_id = $(this).val();
            loadTownsByDistrict(selected_id);
        });

        // Function to handle the AJAX call
        function loadTownsByDistrict(selected_id) {
            if (selected_id) {
                $.ajax({
                    url: '{{ route('settings.towns.byDistricts') }}',
                    type: 'GET',
                    data: {
                        district_id: selected_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#town_id').empty();
                        $('#town_id').append($('<option>', {
                            value: '',
                            text: 'Select option ...',
                            selected: 'selected',
                            disabled: 'disabled'
                        }));
                        $.each(data.filtered, function(key, value) {
                            $('#town_id').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                    }
                });
            }
        };

        // valdating images only
        $('.file-input').on('change', function(event) {
            var file = event.target.files[0];
            var fileType = file.type;
            var fileSize = file.size / 1024 / 1024; // in MB

            // Allowed file types
            var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

            if (!allowedTypes.includes(fileType)) {
                Swal.fire({
                    icon: 'error', title: 'Attention Please',
                    text: 'Invalid file type. Only JPEG, JPG, GIF and PNG are allowed.'
                });
                $(this).val('');
                return;
            }

            if (fileSize > 2) {
                Swal.fire({ icon: 'error', title: 'Please Note', text: 'File size should not be more than 2MB.' });
                $(this).val('');
                return;
            }
        });

        // Creating my own town
        $('#btnAddTown').click(function() {
            var selected_id = $("#district_id").val();

            if (selected_id !== null && selected_id !== undefined && selected_id !== '') {

                Swal.fire({
                    title: 'Confirm Action',
                    html: 'Are you sure you want to add a new town...?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Add',
                    cancelButtonText: 'No, cancel',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show input prompt for town name
                        Swal.fire({
                            title: 'Enter Town Name',
                            input: 'text',
                            inputLabel: 'Town Name',
                            inputPlaceholder: 'Enter the name of the new town',
                            showCancelButton: true,
                            confirmButtonText: 'Add Town',
                            cancelButtonText: 'Cancel',
                            cancelButtonColor: '#d33'
                        }).then((inputResult) => {
                            if (inputResult.isConfirmed) {
                                var temp_town = inputResult.value;
                                if (temp_town) {
                                    $.ajax({
                                        type: "POST",
                                        url: '{{ route('settings.towns.create') }}',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            district_id: selected_id,
                                            name: temp_town
                                        },
                                        success: function(response) {
                                            console.log('Success Response:',
                                                response);
                                            if (response.success) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    text: response
                                                        .message,
                                                }).then(() => {
                                                    loadTownsByDistrict
                                                        (
                                                            selected_id);
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: response
                                                        .message
                                                });
                                            }
                                        },
                                        error: function(xhr, textStatus,
                                            errorThrown) {
                                            var errorMessage = '<strong>' +
                                                appName +
                                                ' transaction request failed because:</strong>';
                                            if (xhr.responseJSON && xhr
                                                .responseJSON.message) {
                                                errorMessage += '<br>' + xhr
                                                    .responseJSON.message;
                                            } else {
                                                errorMessage += '<br>' +
                                                    textStatus + ', ' +
                                                    errorThrown;
                                            }
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                html: errorMessage
                                            });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Input Required',
                                        text: 'Town name cannot be empty.'
                                    });
                                }
                            }
                        });
                    } else {
                        console.log("Add action canceled by user.");
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Selection Required',
                    text: 'You have select the dirstrict you want to add town to.'
                });
            }
        });

        function validateForm(...fields) {
            let allFieldsFilled = true;
            let missingFields = [];

            for (let [index, field] of fields.entries()) {
                if (!field) {
                    allFieldsFilled = false;
                    // Highlight the corresponding input field
                    let fieldId = ['description', 'title', 'subTitle', 'contents', 'reason', 'eventType', 'eventInitials', 'startDate', 'endDate', 'venue', 'banner', 'largeImage', 'mediumImage', 'smallImage', 'personalTitle', 'firstName', 'lastName', 'phone', 'tel', 'gender', 'dob', 'email', 'idType', 'idNumber', 'scanId', 'accType', 'accNumber', 'accBranch', 'profileImage', 'regionId', 'districtId', 'townId', 'accOwner', 'accHost'][index];
                    $(`#${fieldId}`).addClass('is-invalid');
                    missingFields.push(fieldId);
                } else {
                    let fieldId = ['description', 'title', 'subTitle', 'contents', 'reason', 'eventType', 'eventInitials', 'startDate', 'endDate', 'venue', 'banner', 'largeImage', 'mediumImage', 'smallImage', 'personalTitle', 'firstName', 'lastName', 'phone', 'tel', 'gender', 'dob', 'email', 'idType', 'idNumber', 'scanId', 'accType', 'accNumber', 'accBranch', 'profileImage', 'regionId', 'districtId', 'townId', 'accOwner', 'accHost'][index];
                    $(`#${fieldId}`).removeClass('is-invalid');
                }
            }

            if (!allFieldsFilled) {
                Swal.fire({icon: 'error', title: 'Error',text: `Please fill in all fields: ${missingFields.join(', ').replace(/([A-Z])/g, ' $1')}.`});
                return false;
            }

            return true;
        }

        // saving data
        $('#save-data').click(function() {

            // Validate required fields
            var title = $('#title').val();
            var subTitle = $('#sub_title').val();
            var contents = $('#contents').val();
            var description = $('#discription').val();
            var reason = $('#reason').val();
            var eventType = $('#event_type').val();
            var eventInitials = $('#event_initials').val();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var venue = $('#venue').val();
            var banner = $('#banner').prop("files")[0];
            var largeImage = $('#large_image').prop("files")[0];
            var mediumImage = $('#medium_image').prop("files")[0];
            var smallImage = $('#small_image').prop("files")[0];

            var personalTitle = $("#personal_title").val();
            var firstName = $("#firstname").val();
            var lastName = $("#lastname").val();
            var phone = $("#phone").val();
            var tel = $("#tel").val();
            var gender = $("#gender").val();
            var dob = $("#dob").val();
            var email = $("#emails").val();
            var idType = $("#id_type").val();
            var idNumber = $("#id_num").val();
            var scanId = $("#scans").prop("files")[0];
            var accType = $("#acc_type").val();
            var accNumber = $("#acc_num").val();
            var accBranch = $("#acc_branch").val();
            var accHost = $("#acc_host").val();
            var accOwner = $("#acc_owner").val();
            var profileImage = $("#profile").prop("files")[0];
            var regionId = $("#region_id").val();
            var districtId = $("#district_id").val();
            var townId = $("#town_id").val();


            if (!validateForm(
                    description, title, subTitle, contents, reason, eventType, eventInitials, startDate,
                    endDate, venue, banner, largeImage, mediumImage, smallImage, personalTitle,
                    firstName, lastName, phone, tel, gender, dob, email, idType, idNumber, scanId,
                    accType, accNumber, accBranch, profileImage, regionId, districtId, townId, accOwner,
                    accHost
                )) return;

            var base64data = $('#profile-preview').attr('src').split(',')[1];
            var blob = b64toBlob(base64data, 'image/png');

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled',true);

            var formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('event_title', title);
            formData.append('sub_title', subTitle);
            formData.append('content', contents);
            formData.append('description', description);
            formData.append('reason', reason);
            formData.append('event_type_id', eventType);
            formData.append('aliases', eventInitials);
            formData.append('start_date', converted_sdate);
            formData.append('end_date', converted_edate);
            formData.append('venue', venue);
            formData.append('banner', banner);
            formData.append('large_image', largeImage);
            formData.append('medium_image', mediumImage);
            formData.append('small_image', smallImage);

            formData.append('title', personalTitle);
            formData.append('first_name', firstName);
            formData.append('last_name', lastName);
            formData.append('phone', phone);
            formData.append('tel', tel);
            formData.append('gender', gender);
            formData.append('dob', converted_dob);
            formData.append('email', email);
            formData.append('identity_type_id', idType);
            formData.append('id_number', idNumber);
            formData.append('id_scan', scanId);
            formData.append('account_type', accType);
            formData.append('acc_num', accNumber);
            formData.append('acc_branch', accBranch);
            formData.append('acc_owner', accOwner);
            formData.append('acc_host', accHost);
            formData.append('profile', blob);
            formData.append('region_id', regionId);
            formData.append('district_id', districtId);
            formData.append('town_id', townId);

            $.ajax({
                type: 'POST',
                url: '{{ route('event.event-with-author') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.status="success") {
                        Swal.fire({ icon: 'success',  title: 'Success', text: response.message
                            })
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Submit Data').css('cursor', 'pointer');
                                window.location.href = '/en/subscription';
                            });
                    } else {
                        Swal.fire({ icon: 'error',title: 'Error',text: response.message ? response.message : 'Unknown error occurred.'});
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Submit Data').css('cursor',
                        'pointer');
                    var errorMessage =
                        '<strong> transaction request failed because:</strong>';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += '<br>' + xhr.responseJSON.message;
                    } else {
                        errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                    }
                    Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                }
            });

        });

    });

    //Showing universal message
    function showAlert(title, message) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
        });
    };

    // Function to convert base64 to Blob
    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, { type: contentType });
        return blob;
    }


</script>

{{-- Swal.fire({ icon: 'error', title: 'Error', text: "Something here"}); --}}
@endsection
