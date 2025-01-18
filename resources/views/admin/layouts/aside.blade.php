<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Real estate, Property sale, Property buy">
    <meta name="description" content="Homy is a beautiful website template designed for Real Estate Agency.">
    <meta property="og:site_name" content="Homy">
    <meta property="og:url" content="https://creativegigstf.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Homy-Real Estate HTML5 Template & Dashboard">
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
    <title>Phantom Data | Admin Panel</title>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .footer-one .footer-nav {
            width: 46.33%;
        }
    </style>
</head>

<body>
    <div class="main-page-wrapper">
        <aside class="dash-aside-navbar">
            <div class="position-relative">
                <div class="logo d-md-block d-flex align-items-center justify-content-between plr bottom-line pb-30">
                    <a href="{{route('dashboard')}}">
                        <img src="{{url('web/assets/images/logo_name.png')}}" alt="">
                    </a>
                    <button class="close-btn d-block d-md-none"><i class="fa-light fa-circle-xmark"></i></button>
                </div>
                <nav class="dasboard-main-nav pt-30 pb-30 bottom-line">
                    <ul class="style-none">
                        <li class="plr"><a href="{{route('admin.dashboard')}}" class="d-flex w-100 align-items-center
                        @if(Route::currentRouteName() == 'admin.dashboard')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_1.svg')}}" alt="">
                                <span>Dashbaord</span>
                            </a></li>

                        <li class="bottom-line pt-30 lg-pt-20 mb-40 lg-mb-30"></li>


                        <li>
                            <div class="nav-title">Users</div>
                        </li>
                        <li class="plr"><a href="{{route('admin.users-list')}}" class="d-flex w-100 align-items-center
                           @if(Route::currentRouteName() == 'admin.users-list')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_6.svg')}}" alt="">
                                <span>Users List</span>
                            </a></li>
                        <li class="bottom-line pt-30 lg-pt-20 mb-40 lg-mb-30"></li>


                        <li>
                            <div class="nav-title">Properties</div>
                        </li>
                        <li class="plr"><a href="{{route('admin.properties-list')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'admin.properties-list')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_6.svg')}}" alt="">
                                <span>Searched Properties</span>
                            </a></li>

                        <li class="plr"><a href="{{route('admin.transaction-list')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'admin.transaction-list')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_9.svg')}}" alt="">
                                <span>User Transactions</span>
                            </a></li>
                        <li class="plr"><a href="{{route('admin.coupons-list')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'admin.coupons-list')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_6.svg')}}" alt="">
                                <span>Coupons</span>
                            </a></li>
                    </ul>
                </nav>
                <!-- /.dasboard-main-nav -->

                <!-- /.profile-complete-status -->

                <div class="plr">

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="{{route('admin.logout')}}" onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="d-flex w-100 align-items-center logout-btn">
                            <div class="icon tran3s d-flex align-items-center justify-content-center rounded-circle">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_41_white.svg')}}" alt="">
                            </div>
                            <span>Logout</span>
                        </a>
                    </form>
                    </a>
                </div>
            </div>
        </aside>

        <div class="dashboard-body">
            <header class="dashboard-header">
                <div class="d-flex align-items-center justify-content-end">
                    <h5 class="m0 d-none d-lg-block">
                        @if(Route::currentRouteName() == 'admin.dashboard')
                            {{ Auth::guard('admin')->user()->name }} | <span
                                style="font-size:12px;">{{ Auth::guard('admin')->user()->email }}</span>

                        @endif
                        @if(Route::currentRouteName() == 'admin.users-list')
                            Users List
                        @endif
                        @if(Route::currentRouteName() == 'admin.properties-list')
                            Properties List
                        @endif
                        @if(Route::currentRouteName() == 'admin.transaction-list')
                            Transaction List
                        @endif
                        @if(Route::currentRouteName() == 'admin.coupons-list')
                            Coupons List
                        @endif

                    </h5>
                    <button class="dash-mobile-nav-toggler d-block d-md-none me-auto">
                        <span></span>
                    </button>
                    <div class="search-form ms-auto"></div>
                    <div class="d-none d-md-block me-3">
                        @if(Route::currentRouteName() == 'admin.coupons-list')
                            <button type="button" class="btn btn-two" data-bs-toggle="modal" data-bs-target="#couponModal">
                                Add Coupon
                            </button>
                        @endif
                        @if(Route::currentRouteName() == 'admin.users-list')
                            <button type="button" class="btn btn-two" data-bs-toggle="modal" data-bs-target="#userModal">
                                Add User
                            </button>
                        @endif
                    </div>
                    <div class="user-data position-relative">
                        <button class="user-avatar online position-relative rounded-circle dropdown-toggle"
                            type="button" id="profile-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img style="width:60px;height:60px" id="imagePreview2"
                                src="{{url('web/assets/dashboard/images/icon/icon03.svg') }}">
                        </button>
                        <!-- /.user-avatar -->
                        <div class="user-name-data">
                            <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                                
                            <li class="" style="margin-left:15px;">
                            {{ Auth::guard('admin')->user()->name }}
                            
                            </li>
                            <li>
                                    <hr>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <a href="{{route('admin.logout')}}"
                                            onclick="event.preventDefault();this.closest('form').submit();"
                                            class="dropdown-item d-flex align-items-center">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            <span class="ms-2 ps-1">Log Out</span></a>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.user-data -->
                </div>
            </header>

            <div class="col p-0">
                <main class="site-main" data-bs-spy="scroll" data-bs-target="#siteMenu"
                    data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="{{url('web/assets/vendor/jquery.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap JS -->
    <script src="{{url('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <!-- WOW js -->
    <script src="{{url('web/assets/vendor/wow/wow.min.js')}}" type="text/javascript"></script>
    <!-- Slick Slider -->
    <script src="{{url('web/assets/vendor/slick/slick.min.js')}}" type="text/javascript"></script>
    <!-- Fancybox -->
    <script src="{{url('web/assets/vendor/fancybox/fancybox.umd.js')}}" type="text/javascript"></script>
    <!-- Lazy -->
    <script src="{{url('web/assets/vendor/jquery.lazy.min.js')}}" type="text/javascript"></script>
    <!-- js Counter -->
    <script src="{{url('web/assets/vendor/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/jquery.waypoints.min.js')}}"></script>
    <!-- Nice Select -->
    <script src="{{url('web/assets/vendor/nice-select/jquery.nice-select.min.js')}}" type="text/javascript"></script>
    <!-- validator js -->
    <script src="{{url('web/assets/vendor/validator.js')}}" type="text/javascript"></script>
    <script src="{{url('web/assets/vendor/chart.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
        integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
