<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Real estate, Property sale, Property buy">
    <meta name="description" content="Phantomdata designed for Real Estate Agency.">
    <meta property="og:site_name" content="Phantom">
    <meta property="og:url" content="https://creativegigstf.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Phantomdata designed for Real Estate Agency.">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .footer-one .footer-nav {
            width: 46.33%;
        }
    </style>

<?php
$userTotalCredits = DB::table('transactions')->where('email', auth()->user()->email)->latest('created_at')->value('current_total_credits');
$last_transaction=DB::table('transactions')->where('email',auth()->user()->email)
->where('monthly_subscription',1)
->where('subscription_status',1)
->first();
$currentCredits = auth()->user()->credit;
$usedCredits = $userTotalCredits - $currentCredits;

$creditsPercentage = $userTotalCredits?($usedCredits / $userTotalCredits) * 100:0;
if (floor($creditsPercentage) == $creditsPercentage) {
    $creditsPercentage = number_format($creditsPercentage, 0);
} else {
    $creditsPercentage = number_format($creditsPercentage, 1);
}
$creditsPercentageSign=$creditsPercentage."%";
?>


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
                       
                        <li class="plr"><a href="{{route('dashboard')}}" class="d-flex w-100 align-items-center
                        @if(Route::currentRouteName() == 'dashboard')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_1.svg')}}" alt="">
                                <span>Upload File</span>
                            </a></li>

                        <li class="bottom-line pt-30 lg-pt-20 mb-40 lg-mb-30"></li>
                        <li>
                            <div class="nav-title">Profile</div>
                        </li>
                        <li class="plr"><a href="{{route('profile-update')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'profile-update')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_3.svg')}}" alt="">
                                <span>Profile</span>
                            </a></li>

                        <li class="plr"><a href="{{route('how-to-use')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'how-to-use')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_6.svg')}}" alt="">
                                <span>How To Use</span>
                            </a></li>
                        <li>
                            <div class="nav-title">Credits</div>
                        </li>
                        <li class="plr"><a href="{{route('purchase-more')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'purchase-more')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_7.svg')}}" alt="">
                                <span>Subscription</span>
                            </a></li>

                        <li>
                            <div class="nav-title">History</div>
                        </li>
                        <li class="plr"><a href="{{route('my-properties')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'my-properties')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_6.svg')}}" alt="">
                                <span>My Properties</span>
                            </a></li>
                        <li class="plr"><a href="{{route('purchase-history')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'purchase-history')
                            active
                        @endif
                        ">
                                <img src="{{url('web/assets/dashboard/images/icon/icon_9.svg')}}" alt="">
                                <span>Purchase History</span>
                            </a></li>
                        {{-- <li class="plr"><a href="{{route('account-setting')}}" class="d-flex w-100 align-items-center
                         @if(Route::currentRouteName() == 'account-setting')
                            active
                        @endif
                        ">
                                <img @if(Route::currentRouteName()=='account-setting' )
                                    src="{{url('web/assets/dashboard/images/icon/icon_4_active.svg')}}" @else
                                    src="{{url('web/assets/dashboard/images/icon/icon_4.svg')}}" @endif alt="">
                                <span>Account Settings</span>
                            </a></li>--}}


                        <!-- <li class="plr"><a href="add-property.html" class="d-flex w-100 align-items-center">
							<img src="images/icon/icon_7.svg" alt="">
							<span>Add New Property</span>
						</a></li> -->
                        <!-- <li class="plr"><a href="favourites.html" class="d-flex w-100 align-items-center">
							<img src="images/icon/icon_8.svg" alt="">
							<span>Favourites</span>
						</a></li> -->
                        <!-- <li class="plr"><a href="saved-search.html" class="d-flex w-100 align-items-center">
							<img src="images/icon/icon_9.svg" alt="">
							<span>Saved Search</span>
						</a></li> -->
                        <!-- <li class="plr"><a href="review.html" class="d-flex w-100 align-items-center">
							<img src="images/icon/icon_10.svg" alt="">
							<span>Reviews</span>
						</a></li> -->
                    </ul>
                </nav>
                <!-- /.dasboard-main-nav -->

                
                <div class="profile-complete-status bottom-line pb-35 plr">
                <button class="btn-two d-none">
                            <span>Available Credits: <span class="update-user-credits">
                                    {{auth()->user()->credit == "" ? 0 : auth()->user()->credit}}</span></span></button>
                                    <div class="progress-value credit-value-text fw-500">{{$creditsPercentageSign}}</div>
                    <div class="progress-line position-relative">
                        <div class="inner-line credit-value-bar" style="width:{{$creditsPercentageSign}};"></div>
                    </div>
                    <p> <span>Available Credits: <span class="update-user-credits">
                    {{auth()->user()->credit == "" ? 0 : auth()->user()->credit}}</span></span></p>
                </div>

                <div class="bg-white card-box border-20" style="margin-left:20px">
    <span class=""><b>Current Plan</b></span>

    <div class="user-avatar-setting d-flex align-items-center mb-30">
       
     @if($last_transaction && $last_transaction->monthly_subscription == 1) 
     @if($last_transaction->amount == 120)
     
     <pre>Individual ($ 0.12 per credit)<br>
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span></pre>
     
     @elseif($last_transaction->amount == 499)
     
     <pre>Pro ($ 0.10 per credit)<br>
     <b>Status:</b> <span style="color:#9152FF">Subscribed</span></pre>
     
     @elseif($last_transaction->amount == 999)

     <pre>Elite ($ 0.05 per credit)<br><b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>

     @elseif($last_transaction->amount == 1999)

     <pre>Enterprise ($ 0.04 per credit)<br> <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>
     
     @elseif($last_transaction->amount == 3499)

     <pre>Titanium ($ 0.035 per credit)<br> <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>
     
     @elseif($last_transaction->amount == 4999)

     <pre>Diamond ($ 0.02 per credit)<br> <b>Status:</b> <span style="color:#9152FF">Subscribed</span> </pre>

     @endif
        @else
        No Subcription 
        @endif
    </div>
</div>
                <!-- /.profile-complete-status -->

                <div class="plr">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf


                        <a href="{{route('logout')}}" onclick="event.preventDefault();
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
                        @if(Route::currentRouteName() == 'dashboard')
                            Upload File
                        @endif
                        @if(Route::currentRouteName() == 'profile-update')
                            Profile
                        @endif
                        @if(Route::currentRouteName() == 'account-setting')
                            Account Setting
                        @endif
                        @if(Route::currentRouteName() == 'password-update')
                            Update Password
                        @endif
                        @if(Route::currentRouteName() == 'how-to-use')
                        How to Use Phantom Data 👻
                        @endif
                        @if(Route::currentRouteName() == 'purchase-more')
                            Purchase More Credits
                        @endif
                        @if(Route::currentRouteName() == 'my-properties')
                            My Properties
                        @endif
                        @if(Route::currentRouteName() == 'purchase-history')
                            Purchase History
                        @endif
                    </h5>
                    <button class="dash-mobile-nav-toggler d-block d-md-none me-auto">
                        <span></span>
                    </button>
                    <div class="search-form ms-auto"></div>
                    <div class="d-none d-md-block me-3">
                        @if(Route::currentRouteName() == 'dashboard')
                            <button class="btn-two upload-again d-none"><span>Upload Again</span>
                            </button>
                            <!-- <button class="btn-two export-current-csv d-none"><span>Export CSV</span>
                            </button> -->
                        @endif
                        @if(Route::currentRouteName() == 'my-properties')
                            <button class="d-none btn-two export-csv"><span><i class="fa-solid fa-file-csv"></i> Export</span>
                            </button>
                        @endif

                        @if(Route::currentRouteName() == 'purchase-more')
                            <button class="d-none btn-two" data-bs-toggle="modal" data-bs-target="#couponModal"><span> Apply Coupon</span>
                            </button>
                        @endif

                      
                    </div>
                    <div class="user-data position-relative">
                        <button class="user-avatar online position-relative rounded-circle dropdown-toggle"
                            type="button" id="profile-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img style="width:60px;height:60px" id="imagePreview2"
                                src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : url('web/assets/dashboard/images/icon/icon03.svg') }}">
                        </button>
                        <!-- /.user-avatar -->
                        <div class="user-name-data">
                            <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                            <li>
                            <div class="nav-title text-center">{{Auth::user()->name}}</div>
                            <hr>
                        </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{route('profile-update')}}">
                                        <i class="fa-regular fa-user"></i>
                                        <span class="ms-2 ps-1">Profile</span></a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{route('account-setting')}}">
                                        <i class="fa-solid fa-gear"></i>
                                        <span class="ms-2 ps-1">Account Settings</span></a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                                        this.closest('form').submit();"
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

    <!-- Theme js -->
    <script src="{{url('web/assets/js/theme.js')}}"></script>
    <script>
         $(document).ready(function () {
        updateBarColor()
    });
    function updateBarColor() {
        var valueText = $('.credit-value-text').text();
        valueText = valueText.replace('%', '');
        valueText = parseFloat(valueText);
        //console.log(valueText);
        if (valueText < 50) {
            $('.credit-value-text').css('color', '#5CB85C')
            $('.inner-line').css('background-color', '#5CB85C')
        } else if (valueText >= 50 && valueText < 80) {
            $('.credit-value-text').css('color', '#F7C600')
            $('.inner-line').css('background', '#F7C600')
        } else if (valueText >= 80 && valueText <= 99.9) {
            $('.credit-value-text').css('color', 'orange')
            $('.inner-line').css('background', 'orange')
        } else if (valueText >= 100) {
            $('.credit-value-text').css('color', '#D9534F')
            $('.inner-line').css('background', '#D9534F')
        }
    }
    </script>
</body>