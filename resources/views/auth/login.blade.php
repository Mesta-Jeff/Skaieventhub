<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Skai-Tick a product from Skaimount</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('root/hyp/assets/images/logo-dark-sm.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('root/vez/assets/js/layout.js') }}"></script>
    <link href="{{ asset('root/vez/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('root/vez/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden" style="border-radius: 10px">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="#" class="d-block">
                                                    <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}"
                                                        alt="" height="28">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                design, easy for customization. Thanks very much! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident culpa at neque natus rerum, beatae est consectetur numquam atque id dicta ipsam necessitatibus quae accusamus inventore nobis eveniet temporibus dolore. Lorem ipsum dolor sit amet consectetur adipisicing elit."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem cupiditate natus nemo quae impedit dolores, officiis ea incidunt molestias harum illo officia delectus enim ratione ducimus consequuntur nam? Aperiam, explicabo? "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                design, easy for customization. Rem cupiditate natus nemo quae impedit dolores, officiis ea incidunt molestias harum illo officia delectus enim ratione ducimus consequuntur nam? Aperiam, explicabo?  "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6" id="mid">

                                    <div class="nav-tabs-custom text-center mt-3">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link text-center active" data-bs-toggle="tab"
                                                    href="#cu_home" role="tab"><i
                                                        class="la la-home d-block"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-center" data-bs-toggle="tab"
                                                    href="#cu_profile" role="tab"><i
                                                        class="la la-lock d-block"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-center" id="btnRef" href="#!"><i
                                                        class="la la-refresh d-block"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-center" id="btnBirth" href="#!"><i
                                                        class="la la-user d-block"></i></a>
                                            </li>
                                        </ul>
                                    </div>


                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="cu_home" role="tabpanel">
                                            <div style="max-height: 500px; overflow-y: auto;">
                                                <div class="text-center mb-2">
                                                    <h3 class="text-primary" style="font-weight: bold !important">
                                                        General Notice, You must read this</h3>
                                                </div>
                                                <p class="mb-0 text-muted">
                                                    Raw denim you probably haven't heard of them jean shorts Austin.
                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex est
                                                    libero, maxime laboriosam sit consectetur inventore aspernatur porro
                                                    id numquam provident vero ullam at quas enim.
                                                    <br><br>Amet iste minus quia. Lorem ipsum dolor sit amet consectetur
                                                    adipisicing elit. Autem beatae tenetur similique quas fuga
                                                    aspernatur ipsum molestiae ullam dolorum? Eaque nihil dolore vel
                                                    cupiditate. A repellat soluta nam natus dolorum.
                                                    <br><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                    Provident culpa at neque natus rerum, beatae est consectetur numquam
                                                    atque id dicta ipsam necessitatibus quae accusamus inventore nobis
                                                    eveniet temporibus dolore. Lorem ipsum dolor sit amet consectetur
                                                    adipisicing elit. Rem cupiditate natus nemo quae impedit dolores,
                                                    officiis ea incidunt molestias harum illo officia delectus enim
                                                    ratione ducimus consequuntur nam? Aperiam, explicabo?
                                                    <br><br><strong class="text-danger">Note: </strong>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae
                                                    tempore at minima! Temporibus incidunt, labore eos maxime quaerat,
                                                    eaque aliquid illo praesentium vero consequuntur modi aut mollitia.
                                                    Inventore, ut labore?
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                    <br><br> Numquam perferendis alias iste incidunt quis beatae tenetur
                                                    quidem quisquam culpa. Obcaecati maiores fuga nihil modi fugiat
                                                    repellat consectetur voluptatibus ipsam ut. Lorem ipsum dolor, sit
                                                    amet consectetur adipisicing elit. <br><br>Illum dolore quisquam,
                                                    rerum aspernatur magnam laudantium atque obcaecati dicta
                                                    voluptatibus neque architecto quae assumenda reiciendis, fugiat
                                                    tempore cumque laborum incidunt maxime. Lorem ipsum dolor sit, amet
                                                    consectetur adipisicing elit. Laudantium aliquam asperiores eius aut
                                                    voluptas incidunt animi quos tenetur officia numquam aperiam neque
                                                    quo ipsum, modi nostrum cum repellat necessitatibus placeat.

                                                </p>
                                            </div>
                                            <div class="mt-2 mb-2 text-center">
                                                <button class="btn btn-success" id="btncontinue"
                                                    type="button">Continue</button>
                                            </div>
                                        </div>

                                        <div class="tab-pane p-3" id="cu_profile" role="tabpanel">
                                            <div class="p-lg-8 p-2">
                                                <div class="text-center">
                                                    <h5 class="text-primary">Welcome Back !</h5>
                                                    <p class="text-muted">Sign in to continue to eWork</p>
                                                </div>
                                                <div id="myAlert" class="alert alert-danger mt-4" role="alert" style="display:none;">
                                                    <p id="my_para"></p>
                                                </div>

                                                <div class="mt-4" style="max-width: 80%; padding-left: 60px;">
                                                    <form action="">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Provide Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                placeholder="Enter username" onselectstart="return false" onpaste="return false;" oncopy="return false"
                                                                oncut="return false" ondrag="return false" ondrop="return false"
                                                                autocomplete="off"
                                                                onkeypress="if(event.keyCode && event.keyCode >= 65 && event.keyCode <= 90) event.preventDefault();"
                                                                required>
                                                                <label id="nameError" style="display: none; color: red;">
                                                                    Username should be accurate and it should exist</label>
                                                        </div>

                                                        <div class="mb-3">
                                                            <div class="float-end">
                                                                <a href="{{ route('recover-password') }}"
                                                                    class="text-muted">Forgot password?</a>
                                                            </div>
                                                            <label class="form-label"
                                                                for="password-input">Password</label>
                                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                                <input type="password"
                                                                    class="form-control pe-5 password-input" aria-label="Password" aria-describedby="password-addon"
                                                                    placeholder="Enter password" id="password-input" onselectstart="return false" onpaste="return false;" oncopy="return false"
                                                                    oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required>
                                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                                        <label id="passError" style="display: none; color: red;">  Please enter a valid password to your account</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="auth-remember-check">
                                                            <label class="form-check-label"
                                                                for="auth-remember-check">Remember me</label>
                                                        </div>

                                                        <div class="mt-4 text-center">
                                                            <button class="btn btn-success" type="button"
                                                                id="btnSubmit">Confirm Action</button>
                                                        </div>

                                                        <div class="mt-4 text-center">
                                                            <div class="signin-other-title">
                                                                <h5 class="fs-13 mb-2 title">Don't have an account ? <a
                                                                        href="#"
                                                                        class="fw-semibold text-primary text-decoration-underline">
                                                                        Signup</a></h5>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer start-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">All Right Reserved, &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> SkaiMount. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Skai Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('root/vez/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('root/vez/assets/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('root/vez/assets/js/pages/password-addon.init.js') }}"></script>
    <script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#btncontinue').click(function() {
                $('#cu_home').removeClass('active');
                $('#cu_profile').addClass('active');
            });

            $('#btnRef').click(function() {
                window.location.reload();
            });

            var rememberedUsername = localStorage.getItem('rememberedUsername');
            if (rememberedUsername !== null) {
                $('#username').val(rememberedUsername);
                $('#auth-remember-check').prop('checked', true);
            }

            var userAgent = navigator.userAgent;

            // Function to detect the operating system
            function detectOS() {
                if (/Windows/.test(userAgent)) return "Windows";
                if (/Mac OS X/.test(userAgent)) return "Mac OS X";
                if (/Linux/.test(userAgent)) return "Linux";
                if (/Android/.test(userAgent)) return "Android";
                if (/iPhone|iPad|iPod/.test(userAgent)) return "iOS";
                return "Unknown";
            }

            // Function to detect the browser
            function detectBrowser() {
                if (/Edge/.test(userAgent)) return "Microsoft Edge";
                if (/Chrome/.test(userAgent)) return "Google Chrome";
                if (/Safari/.test(userAgent)) return "Safari";
                if (/Firefox/.test(userAgent)) return "Mozilla Firefox";
                if (/MSIE|Trident/.test(userAgent)) return "Internet Explorer";
                return "Unknown";
            }

            // Function to get IP address using an IP lookup service
            function getIpAddress(callback) {
                $.getJSON("https://ipapi.co/json/", function(data) {
                    callback(data.ip);
                });
            }

            // Detect and display the operating system and browser
            var osInfo = detectOS();
            var browserInfo = detectBrowser();
            var address = "Unknown";
            var ipaddress = '';

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        reverseGeocode(position.coords.latitude, position.coords.longitude, function(newAddress) {
                            address = newAddress;
                            console.log(address);
                        });
                    },
                    function(error) {
                        console.error('Error getting location:', error.message);
                    }
                );
            } else {
                console.error('Geolocation is not supported by this browser.');
            }

            // Function to reverse geocode coordinates
            function reverseGeocode(latitude, longitude, callback) {
                $.get(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                .done(function(response) {
                    var town = response.address.town || response.address.city;
                    var district = response.address.district || response.address.county;
                    var region = response.address.state || response.address.region;
                    var country = response.address.country;

                    callback(`${country}, ${region} (${town})`);
                })
                .fail(function(error) {
                    console.error('Error in reverse geocoding:', error);
                });
            }

            getIpAddress(function(ip) {
                ipaddress = ip;
            });

            $('#btnSubmit').click(function(e) {
                e.preventDefault();
                var buttonElement = $(this);

                var username = $('#username').val();
                var password = $('#password-addon').prev().val();

                var rememberMe = $('#auth-remember-check').prop('checked');
                if (rememberMe) {
                    localStorage.setItem('rememberedUsername', username);
                } else {
                    localStorage.removeItem('rememberedUsername');
                }

                if (username.length < 5) {
                    $('#nameError').show();
                } else {
                    $('#nameError').hide();
                    $("#myAlert").hide();
                }
                if (password.length < 5) {
                    $('#passError').show();
                } else {
                    $('#passError').hide();
                    $("#myAlert").hide();
                    if (username.length >= 5 && password.length >= 5) {

                        // Send ajax request to the backend
                        buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Authenticating... ').attr("disabled", true);

                        $.ajax({
                            type: "POST",
                            url: '{{ route('signin') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                email: username,
                                password: password,
                                country: address,
                                ip: ipaddress,
                                os: osInfo,
                                browser: browserInfo
                            },
                            success: function(response) {
                                if (response.success) {
                                    window.location.href = response.redirect;
                                } else {
                                    buttonElement.prop('disabled', false).text('Confirm Action').css('cursor', 'pointer');
                                    $("#my_para").html(response.message);
                                    $("#myAlert").show();
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                let errorMessage;

                                // Check if the response contains the specific IP field error
                                try {
                                    const response = JSON.parse(xhr.responseText);
                                    if (response.message) {
                                        errorMessage = response.message;
                                    } else if (response.message && response.message.ip) {
                                        errorMessage = "Please check your internet connection and try again";
                                    } else {
                                        errorMessage = "An unknown error occurred. Please try again also check your internet connection";
                                    }
                                } catch (e) {
                                    errorMessage = "An unknown error occurred. Please try again also check your internet connection";
                                }

                                $("#my_para").html(errorMessage);
                                $("#myAlert").show();
                                buttonElement.prop('disabled', false).text('Confirm Action').css('cursor', 'pointer');
                            }

                        });
                    }
                }
            });

            $("#username").on("input", function() {
                if ($(this).val().length > 0) {
                    $("#myAlert").hide();
                    $('#nameError').hide();
                }
                else{
                    $('#nameError').show();
                }
            });

            $("input[type='password']").on("input", function() {
                if ($(this).val().length > 0) {
                    $('#passError').hide();
                    $("#myAlert").hide();
                } else {
                    $('#passError').show();
                }
            });


        });
        </script>


</body>

</html>
