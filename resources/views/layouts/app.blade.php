<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Quest Data - Data For Real Estate">
    <meta name="description" content="Quest Data - Data For Real Estate">
    <meta property="og:site_name" content="Homy">
    <meta property="og:url" content="">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Phantom - Data For Real Estate">
    <meta name='og:image' content='images/assets/ogg.png'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#0D1A1C">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#0D1A1C">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#0D1A1C">
    <title>Phantom Data</title>

    <link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">

    <link rel="icon" sizes="180x180" href="{{url('web/assets/images/logo.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('web/assets/images/logo.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('web/assets/images/logo.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('web/assets/css/bootstrap.min.css')}}" media="all">
    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="{{url('web/assets/css/style.css')}}" media="all">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="{{url('web/assets/css/responsive.css')}}" media="all">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.css">



    <style>
        .footer-one .footer-nav {
            width: 46.33%;
        }
    </style>
</head>

<body>
    <div class="main-page-wrapper">
        <header class="theme-main-menu menu-overlay menu-style-one sticky-menu">
            {{-- <div class="alert-wrapper text-center">--}}
                {{-- <p class="fs-16 m0 text-white">The <a href="#" class="fw-500">flash sale</a> go on. The offer--}}
                    {{-- will end in — <span>This Sunday</span></p>--}}
                {{-- </div>--}}
            <!-- /.alert-wrapper -->
            <div class="inner-content gap-one">
                <div class="top-header position-relative">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="logo order-lg-0">
                            <a href="#" class="d-flex align-items-center">
                                <img style="max-width: 260px;" class="img-fluid"
                                    src="{{url('web/assets/images/logo_name.png')}}" alt="">


                            </a>
                        </div>
                        <!-- logo -->
                        <div class="right-widget ms-auto ms-lg-0 me-3 me-lg-0 order-lg-3 d-none d-md-block">
                            <ul class="d-flex align-items-center style-none">
                                <li>
                              
                                        <a href="{{route('dashboard')}}" class="btn-one nav-dashbaord-btn d-none"><i class="fa-regular fa-user"></i>
                                            <span>Dashboard</span></a>
                                    
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="fc1"
                                            class="btn-one nav-login-btn d-none">
                                            <span>Login</span>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="fc2"
                                            class="btn-two nav-register-btn d-none">
                                            <span>Get Started</span>
                                        </a>
                                
                                </li>
                                {{-- <li class="d-none d-md-inline-block ms-3">--}}
                                    {{-- <a href="#" class="btn-two" target="_blank"><span>Get Started</span></a>--}}
                                    {{-- </li>--}}
                            </ul>
                        </div>
                        <nav class="navbar navbar-expand-lg p0 order-lg-2">
                            {{-- <button class="navbar-toggler d-block d-lg-none" type="button"
                                data-bs-toggle="collapse" --}} {{-- data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" --}} {{--
                                aria-label="Toggle navigation">--}}
                                {{-- <span></span>--}}
                                {{-- </button>--}}
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav align-items-lg-center">
                                    <li class="d-block d-lg-none">
                                        <div class="logo"><a href="index.html" class="d-block"><img
                                                    src="images/logo/logo_01.svg" alt=""></a></div>
                                    </li>
                                    {{-- <li class="nav-item">--}}
                                        {{-- <a class="nav-link" href="#" target="_blank">About Us</a>--}}
                                        {{-- </li>--}}
                                    {{-- <li class="nav-item">--}}
                                        {{-- <a class="nav-link" href="#" target="_blank">Features</a>--}}
                                        {{-- </li>--}}
                                    {{-- <li class="nav-item  dashboard-menu">--}}
                                        {{-- <a class="nav-link" href="#" target="_blank">Pricing</a>--}}
                                        {{-- </li>--}}
                                    {{-- <li class="nav-item">--}}
                                        {{-- <a class="nav-link" href="#" target="_blank">Contact Us</a>--}}
                                        {{-- </li>--}}
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div> <!--/.top-header-->
            </div> <!-- /.inner-content -->
        </header>
        <div class="col p-0">
            <main class="site-main" data-bs-spy="scroll" data-bs-target="#siteMenu" data-bs-root-margin="0px 0px -40%"
                data-bs-smooth-scroll="true" tabindex="0">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{url('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/wow/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/slick/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/fancybox/fancybox.umd.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/jquery.lazy.min.js')}}" type="text/javascript"></script>

    <script src="{{url('web/assets/vendor/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/jquery.waypoints.min.js')}}"></script>

    <script src="{{url('web/assets/vendor/nice-select/jquery.nice-select.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/validator.js')}}" type="text/javascript"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
        integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{url('web/assets/js/theme.js')}}"></script>
</body>