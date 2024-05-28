

<footer>
    <div class="footer-area footer-bg">

        @if (Request::is('en/index'))
            @includeIf('includes.frontend.en.footer-topbar')
        @endif

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <p>Copyright © 2022 {{ env('APP_NAME')}}. All Rights Reserved By <span>Skai Team</span></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->



<!-- JS here -->
<script src="{{ asset ('root/forms/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/jquery.odometer.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/slick.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/wow.min.js') }}"></script>
<script src="{{ asset ('root/forms/assets/js/main.js') }}"></script>

<script src="{{ asset('root/hyp/assets/vendor/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').each(function() {
            $(this).select2({
                // dropdownParent: $(this).parent(),
                height: '50%',
                width: '100%'
            });
        });
    });
</script>