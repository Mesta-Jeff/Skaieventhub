
<!-- Scroll-top -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
</button>
<!-- Scroll-top-end-->

<!-- header-area -->
<header>

    @if (Request::is('en/create-event', '/'))
        <div class="header-top">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="header-top-left">
                            <a href="#"><i class="fa-solid fa-plane"></i> Welcome to Skai-Tick, the ultimate online event ticket selling and buying platform accross the globe</a>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="header-top-right">
                            <ul>
                                <li><a href="{{ route('login')}}">Signin</a></li>
                                <li><a href="/"><i class="fa-solid fa-comments"></i>Feedback</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="sticky-header" class="menu-area menu-style-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="menu-wrap">
                        <nav class="menu-nav">
                            <div class="logo"><h2 style="color: white;" class="title"><img style="margin-right: 10px; margin-bottom: 5px;" width="30" src="{{ asset('root/hyp/assets/images/logo-dark-sm.png') }}" alt="">{{ env('APP_NAME')}} </h2></div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ route('contact-us')}}">Contact Us</a></li>
                                    <li><a target="_blank" href="https://www.skaimount.com">Main Site</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="header-btn sign-in"><a href="{{ route('login')}}" class="btn">Sign In</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

