@extends('backend.layouts.app')

@section('title', 'Creating New Event')

@section('content')
    <!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a >{{ env('APP_NAME')}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
                <h4 class="page-title"><i class="mdi mdi-briefcase me-1"></i> @yield('title')</h4>
            </div>
        </div>
        <hr style="margin-top: -20px;">
    </div>



    @if(is_null($host_id) || $host_id === '')
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <!--end col-->
                            <div class="col-xxl-12 ms-auto">
                                <div>
                                    <select id="author" class="select2 form-control" >
                                        <option value="" selected>Select author...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="row col-md-12 mt-2">
        <div class="justify-content-center">

            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Payment Breakdown</h4>
                        </div>

                        <div class="card-body pt-0 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-warning-lighten text-warning border border-warning rounded-circle h3 my-0">
                                            1
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Subscription</h4>
                                    <p class="mb-0 text-muted" id="maintenancePrice">GH00.00</p>
                                </div>
                                <p class="mb-0 text-info">0%</p>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded">
                                        <span class="avatar-title bg-success-lighten text-success border border-success rounded-circle h3 my-0">
                                            2
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h4 class="mt-0 mb-1 font-16 fw-semibold">Sut Up</h4>
                                    <p class="mb-0 text-muted"id="setUPprice">GH00.00</p>
                                </div>
                                <p class="mb-0 text-info">0%</p>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-2">
                                    <h3 class="mt-0 mb-1 font-16 fw-semibold">TOTAL CHARGES</h3>
                                </div>
                                <h3 class="mb-0 text-danger"id="totalPrice">GH00.00</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <form id="my-form" method="post" class="row form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" id="gottenid" />

                                <div class="row" style="height: 500px; overflow-y: scroll;">

                                    <div class="col-md-12">
                                        <label for="gender">Event type</label>
                                        <select id="event_type" name="select" class="form-control select2">
                                            <option value="" disabled selected>Choose option...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email">Event title</label>
                                        <input type="text" id="title" class="form-control" placeholder="Event main title here">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email">Sub title</label>
                                        <input type="text" id="sub_title" class="form-control" placeholder="Event sub title here">
                                    </div>

                                    <div class="contact-form mt-2">
                                        <div class="form-outline col-md-12 mb-1">
                                            <textarea id="contents" class="form-control" rows="3" placeholder="What content do you want to show to viewers"></textarea>
                                        </div>
                                        <div class="form-outline mb-1">
                                            <textarea id="discription" class="form-control" rows="3" placeholder="Describe your event not more than 500 words"></textarea>
                                        </div>
                                        <div class="form-outline mb-1">
                                            <textarea id="reason" class="form-control" rows="3" placeholder="Give a comprehensive reason for creating the event it is required..."></textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <label for="shortBy">Alaises (15 Characters long)</label>
                                        <input class="form-control" type="text" id="event_initials" placeholder="eg. VGMA24 or Emy Awards" maxlength="15">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="shortBy">Starting date</label>
                                        <input type="date" id="start_date" class="form-control" placeholder="Select Date">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="shortBy">Ending date</label>
                                        <input type="date" id="end_date" class="form-control" placeholder="Select Date">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="shortBy">Venue: (where is the event happening)</label>
                                        <input type="text" id="venue" class="form-control" placeholder="eg. Accra-National Theatre">
                                    </div>

                                    <div class="col-md-12 mb-1">
                                        <label for="banner">Upload Banner (1920 by 1000 px Landscape image)</label>
                                        <input type="file" id="banner" class="form-control file-input" accept="image/*">
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="large_image">Upload the large image (1500 by 1500 px Portrait)</label>
                                        <input type="file" id="large_image" class="form-control file-input" accept="image/*" required>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="medium_image">Upload the main image (1080 by 1080 px Square image)</label>
                                        <input type="file" id="medium_image" class="form-control file-input" accept="image/*" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="small_image">Upload small image (900 by 900 px Square image)</label>
                                        <input type="file" id="small_image" class="form-control file-input" accept="image/*" required>
                                    </div>
                                </div>

                                <div class="modal-footer mt-2  gap-2">
                                    <button type="button" class="btn btn-soft-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-soft-secondary" id="edit-data">   Clear</button>
                                    <button type="button" class="btn btn-soft-success" id="save-data">Create Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>


<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script>

    // Resseting forms
    function resetForm() {
        document.getElementById("my-form").reset();
    }

    $(document).ready(function ()
    {

        var converted_sdate = '';
        var converted_edate = '';
        var creator_id = '';
        var hostId = "{{ $host_id }}";


        // Getting data for the event type
        $.ajax({
            url: '{{ route('events.types.get') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#event_type').empty();
                $('#event_type').append($('<option>', {
                    value: '',  text: 'Choose option...', selected: 'selected', disabled: 'disabled'
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

        // Getting the auhtors ready
        $.ajax({
            url: '{{ route("events.authors.get") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#author').empty();
                $('#author').append($('<option>', {
                    value: '',  text: 'Choose option...', selected: 'selected', disabled: 'disabled'
                }));
                $.each(data.authors, function(key, value) {
                    var trimText = value.title+ " " + value.first_name + " " + value.last_name + " (" + value.initials + ")"
                    $('#author').append($('<option>', {
                        value: value.id,
                        text: trimText
                    }));
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        // Setting the creotor
        $('#author').on('change', function(event) {
            creator_id = $(this).val();
        });

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

        // Setting price on change
        $('#event_type').change(function() {
            var selectedOption = $(this).find('option:selected');
            var prices = selectedOption.data('prices');
            $('#totalPrice').text('GH' + prices);
            $('#maintenancePrice').text('GH' + (prices - 10).toFixed(2));
            $('#setUPprice').text('GH' + 10.00.toFixed(2));

        });

        $('#start_date, #end_date').change(function() {
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

        function validateForm(...fields) {
            let allFieldsFilled = true;
            let missingFields = [];

            for (let [index, field] of fields.entries()) {
                if (!field) {
                    allFieldsFilled = false;
                    // Highlight the corresponding input field
                    let fieldId = ['description', 'title', 'subTitle', 'contents', 'reason', 'eventType', 'eventInitials', 'startDate', 'endDate', 'venue', 'banner', 'largeImage', 'mediumImage', 'smallImage'][index];
                    $(`#${fieldId}`).addClass('is-invalid');
                    missingFields.push(fieldId);
                } else {
                    let fieldId = ['description', 'title', 'subTitle', 'contents', 'reason', 'eventType', 'eventInitials', 'startDate', 'endDate', 'venue', 'banner', 'largeImage', 'mediumImage', 'smallImage'][index];
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

            if (creator_id === null || creator_id === '') {
                creator_id = hostId;
            }

            if (!validateForm( description, title, subTitle, contents, reason, eventType, eventInitials, startDate,
                    endDate, venue, banner, largeImage, mediumImage, smallImage,creator_id
                )) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled',true);

            var formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('creator_id', creator_id);
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

            $.ajax({
                type: 'POST',
                url: '{{ route("events.create") }}',
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
</script>

@endsection

