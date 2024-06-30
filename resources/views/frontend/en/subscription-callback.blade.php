
@extends('frontend.layouts.signup-event')

@section('title', 'Skai-Tick Payment Verification')

@section('content')


    <!-- customer-details-area -->
    <section class="customer-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="customer-details-content">
                        <div class="content text-center">
                            <h2 class="title">Payment Verification</h2>
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

            <div id="container3" class="row justify-content-center">
                <div class="col-md-7 booking-details-wrap" style="background-color: transparent; margin-top: -90px">
                    <div class="booking-sidebar shadow">
                        @if (isset($success) && $success)
                            <h2 class="main-title">Success</h2>
                            @else
                            <h2 class="main-title">Attention Please</h2>
                        @endif
                       
                        <div class="widget text-center">
                            @if (isset($message))
                                <h2 class="widget-title mt-2" id="messages">{{ $message }}</h2>
                            @endif
                           {{--  <h2 class="widget-title mt-2" id="messages">
                                Payment made successfully. Your event is still under review, be assured that management will get back to you as soon as the review is complete. We have sent you the payment details. Please keep them confidential, as they are requried in the verification process. Stay connected. Thank you.

                                <br><br>
                                Your request has been approved and payment has been completed successfully. However, your event is still being reviewed; management will contact you as soon as possible. Payment details have also been emailed to you; please keep them confidential as they will be used for verification.Please stay in touch.

                                <br><br>
                                Payment was completed successfully, and your request was approved; however, your event is still being reviewed. The management will contact you as soon as the evaluation is complete. Payment information were emailed to you; please keep them confidential since they will be used for verification.Keep in touch, please.


                                <br><br>
                                Successful payment was completed, and your request was approved; however, your event is still being reviewed. The management will contact you as soon as the evaluation is complete. You have also received payment data, which will be kept confidential and used for verification.Please stay in touch. Thank you


                            </h2> --}}
                            
                            <div class="text-center">
                                <a id="save-data" class="btn" href="/"><i class="fa fa-home me-2"></i>  Go Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- booking-details-area-end -->


    <script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function ()
    {
        
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

       
    });
</script>

@endsection
