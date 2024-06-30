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

            {{-- @if(session('event_id') !== '' && session('event_id') !== null) --}}
                <di id="container1" class="row justify-content-center" style="margin-top: -60px !important" >
                    <div class="col-md-6 booking-details-wrap" style="background-color: transparent;" >
                        <div class="booking-sidebar shadow">
                            <input type="text" hidden id="generatedId" value="{{ $info['id'] ?? '--' }}">
                            <h2 class="main-title">Subscription & Setup fees</h2>
                            <div class="widget">
                                <h2 class="widget-title">Detail about your event</h2>

                                <div class="col-md-12">
                                    <div class="form-grp mb-3">
                                        <div class="form">
                                            <label for="title">Title</label>
                                            <input type="text" id="titles" value="{{ $info['event_title'] ?? '--' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-grp mb-3">
                                        <div class="form">
                                            <label for="event-initials">Initials</label>
                                            <input type="text" id="initials" value="{{ $info['aliases'] ?? '--' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-grp mb-3">
                                        <div class="form">
                                            <label for="event-type">Type of Event you selected</label>
                                            <input type="text" id="types" value="{{ $info['event_type'] ?? '--' }}" disabled>
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
                                    <span class="text-center">Amount to pay for the subscription and setup only <h2 class="price">GH&#8373;{{ $info['price'] ?? '00.00' }}</h2></span>
                                </div>

                                <div class="text-center">
                                    <button id="makePayment" class="btn">Execute Task</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="container3" class="row justify-content-center">
                    <div class="col-md-5 booking-details-wrap" style="background-color: transparent; margin-top: -70px">
                        <div class="booking-sidebar shadow">
                            <h2 class="main-title">PLEASE NOTE!!!</h2>
                            <div class="widget text-center">
                                <h2 class="widget-title mt-2" id="messages">--</h2>
                                <p class="text-center" id="timers" style="font-size: 20px"> <i class="fa fa-spinner fa-spin"></i> 00</p>
                            </div>
                        </div>
                    </div>
                </div>
           {{-- @else --}}

                <div id="container2" class="row justify-content-center">
                    <div class="col-md-5 booking-details-wrap" style="background-color: transparent; margin-top: -70px">
                        <div class="booking-sidebar shadow">
                            <h2 class="main-title">Re-initializing payment</h2>
                            <div class="widget">
                                <h2 class="widget-title">Provide the information below to be able to reinitialize</h2>

                                <div class="col-md-12">
                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">What is the title of your event</label>
                                            <input type="text" id="event-title">
                                        </div>
                                    </div>
                                    <div class="form-grp">
                                        <div class="form">
                                            <label for="shortBy">Email you used when creating your account</label>
                                            <input type="text" id="set">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="save-data" class="btn">Re-Initialize Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- @endif --}}

        </div>
    </section>
    <!-- booking-details-area-end -->


    <script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function ()
    {
        
        var eventId = '{{ session('event_id') }}';
        var info = @json($info);
        // console.log('the info: ' ,info)

        if (Object.keys(info).length > 0) {
            $('#container1').show();
            $('#container2').hide();
        } else {
            $('#container1, #container3').hide();
            $('#container2').show();
        }
       
        // FUnction to validate the inputs before
        function validateForm(...fields) {
            for (let field of fields) {
                if (!field) {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill in all fields.' });
                    return false;
                }
            }
            return true;
        }

        // Save Data Button Click Event
        $('#save-data').on('click', function() {
            var email = $('#set').val();
            var title = $('#event-title').val();

            // Check if fields are not empty
            if (!validateForm(email, title)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: '{{ route("en.event.subscribe") }}',
                type: 'GET',
                data: { email: email,title: title },
                dataType: 'json',
                success: function (response) {
                    console.log('Response:', response);
                    if (response.info && response.info.length > 0) {
                        var eventInfo = response.info[0];
                        buttonElement.prop('disabled', false).text('Re-Initialize Payment').css('cursor', 'pointer');
                        $('#container1').show();
                        $('#container2').hide();

                        $('#titles').val(eventInfo.event_title ?? '--');
                        $('#initials').val(eventInfo.aliases ?? '--');
                        $('#types').val(eventInfo.event_type ?? '--');
                        $('#generatedId').val(eventInfo.id ?? '0');
                        $('.price').text('GH₵' + (eventInfo.price ?? '00.00'));
                        // location.reload();
                    } else {
                        buttonElement.prop('disabled', false).text('Re-Initialize Payment').css('cursor', 'pointer');
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message ?? 'Event not found, check the details and try again' });
                    }
                },
                        
                error: function (xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Re-Initialize Payment').css('cursor', 'pointer');
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            });
        });

        // making the payment request
        $('#makePayment').on('click', function() {
            var email = $('#set').val();
            var title = $('#titles').val();

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin mr-2"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                url: "{{ route('events.subscription.initializePayment') }}",
                method: "POST",
                data: { email: email, title: title },
                success: function(response) {
                    if (response.success) {
                        $('#container1').hide();
                        $('#container3').show();
                        $('#messages').text(response.message);
                        setTimer();
                        // Redirect to Paystack authorization URL
                        window.location.href = response.url;
                    } else {
                        buttonElement.prop('disabled', false).html('Execute Task').css('cursor', 'pointer');
                        $('#messages').text(response.message);
                    }
                },
                error: function(xhr) {
                    buttonElement.prop('disabled', false).html('Execute Task').css('cursor', 'pointer');
                    $('#messages').text('Something went wrong. Please try again.');
                }
            });
        });

        // Getting the timer to verify
        function setTimer()
        {
            var minutes = 1;
            var seconds = 3;
            var timerDisplay = $('#timers');
            function updateTimer() {
                // Format the minutes and seconds to always show two digits
                var displayMinutes = minutes < 10 ? '0' + minutes : minutes;
                var displaySeconds = seconds < 10 ? '0' + seconds : seconds;
                timerDisplay.text(displayMinutes + ':' + displaySeconds);
            }

            updateTimer();
            var timerInterval = setInterval(function() {

                seconds--;
                if (seconds < 0 && minutes > 0) {
                    minutes--;
                    seconds = 59;
                }
                updateTimer();
                if (minutes === 0 && seconds === 0) {
                    clearInterval(timerInterval);
                    alert('Time is up!');
                }
            }, 1000);
        }
       
    });
</script>

@endsection
