@extends('layouts.app')

@section('content')

<script>
     $(document).ready(function () {
                    var user_data=localStorage.getItem('user_details')
                    user_data = JSON.parse(user_data);
                    if(user_data)
                {

                    $('.dashboard-btn').removeClass('d-none')
                    $('.nav-dashbaord-btn').removeClass('d-none')
                }else{
                    $('.register-btn').removeClass('d-none')
                    $('.nav-register-btn').removeClass('d-none')
                    $('.nav-login-btn').removeClass('d-none')
                }
     });

</script>



<body>
    <style>
        body {
            background-color: white;
        }

        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            flex-direction: column;
            /* Stacks items vertically */
            justify-content: center;
            align-items: center;
            z-index: 999999;
            text-align: center;
            /* Centers text alignment */
            backdrop-filter: blur(7px);
            /* Adds blur effect */
        }

        .loading-text {
            margin-top: 20px;
            /* Space between spinner and text */
            font-size: 24px;
            /* Adjust font size as needed */
            color: #333;
            /* Text color */
        }

        .back-shadow {
            box-shadow: 0px 0px 20px 5px #e7cdf7;
        }
    </style>
    <div class="loading-screen d-none">
        <i class="fa-solid fa-spinner fa-spin-pulse" style="font-size: 100px; color: #B95CF4;"></i>
        <div class="loading-text">
            <span style="font-size:16px;">Payment Successfull</span>
            <br>
            Preparing Your Dashboard ....
        </div>
    </div>
    <div class="main-page-wrapper">
        <!-- ===================================================
            Loading Transition
        ==================================================== -->

        <div class="hero-banner-one bg-pink z-1 pt-225 xl-pt-200 pb-250 xl-pb-150 lg-pb-100 position-relative"
            style="height: 100vh;">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-xxl-10 col-xl-9 col-lg-10 col-md-10 m-auto">
                        {{-- <h1 class="hero-heading text-center wow fadeInUp">--}}
                            {{-- Data for <br> <span class="d-inline-block position-relative">Quest Data <img--}} {{--
                                    src="{{url('web/assets/images/shape/shape_01.svg')}}" alt="" --}} {{--
                                    class="lazy-img"></span></h1>--}}
                        <center>
                            <img class="img-fluid" style="width:15%" src="{{url('web/assets/images/logo.png')}}" alt="">
                            <!-- <span style="color:#B95CF4;font-weight:900;font-size:100px">Phantom</span> -->

                        </center>
                        <p class="fs-24 color-dark text-center pt-35 pb-35 wow fadeInUp" data-wow-delay="0.1s">
                            Instant homeowner property data
                        </p>
                        <p class="text-center">

                          
                                <a href="{{route('dashboard')}}" class="btn-one dashboard-btn d-none"><i class="fa-regular fa-user"></i>
                                    <span>Dashboard</span></a>
                            
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="fc2"
                                        class="btn-two register-btn d-none">
                                        <span>Get Started</span>
                                    </a>
                                    <!-- For Mobile Only -->
                                <div class="d-md-none text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="fc1"
                                        class="btn-one login-btn d-none">
                                        <span>Login</span>
                                    </a>
                                </div>
                         
                        </p>
                    </div>
                </div>
            </div>
            <img src="{{url('web/assets/images/assets/ils_01.svg')}}" alt="" class="lazy-img shapes w-100 illustration">
        </div>
        <!-- /.hero-banner-one -->

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                <div class="container">
                    <div class="user-data-form modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="form-wrapper m-auto w-100">
                            <ul class="nav nav-tabs w-100" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fc1"
                                        role="tab">Login
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fc2"
                                        role="tab">Signup
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mt-30">
                                <div class="tab-pane show active" role="tabpanel" id="fc1">
                                    <div class="text-center mb-20">
                                        <h6>Welcome Back!</h6>
                                        <p class="color-dark" style="font-size:15px">Still don't have an account?
                                            <a href="#" id="signup-link">Sign up</a>
                                        </p>
                                    </div>

                                    <h6 class="text-danger text-center email-not-found d-none">Email Not Found</h6>
                                    <h6 class="text-danger text-center incorrect-password d-none">Incorrect Password
                                    </h6>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group-meta position-relative mb-25">
                                                <label>Email*</label>
                                                <span class="text-danger login-email-error d-none">Email
                                                    Required*</span>
                                                <span class="text-danger login-email-valid-error d-none">Email not
                                                    valid*</span>
                                                <input type="email" name="login_email"
                                                    placeholder="Youremail@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group-meta position-relative mb-20">
                                                <label>Password*</label>
                                                <span class="text-danger login-password-error d-none">Password
                                                    Required*</span>
                                                <span class="text-danger login-password-length-error d-none">Password
                                                    Should Contain atleat 8 charecters*</span>
                                                <input type="password" name="login_password"
                                                    placeholder="Enter Password" class="pass_log_id">
                                                <span class="placeholder_icon"><span class="passVicon"><img
                                                            src="{{url('web/assets/images/icon/icon_68.svg')}}"
                                                            alt=""></span></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="agreement-checkbox d-flex justify-content-between align-items-center">
                                                <!-- <div>
                                                    <input type="checkbox" id="remember">
                                                    <label for="remember">Keep me logged in</label>
                                                </div> -->
                                                <!---- <a href="#">Forget Password?</a>----->
                                            </div> <!-- /.agreement-checkbox -->
                                        </div>
                                        <div class="col-12">
                                            <button class="btn-two w-100 text-uppercase d-block mt-20 login-btn">
                                                <span class="login-text">Login</span>
                                                <span class="login-loader d-none"><i
                                                        class="fa-solid fa-spinner fa-spin-pulse"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->

                                <div class="tab-pane" role="tabpanel" id="fc2">
                                    <div class="text-center mb-20">
                                        <h6>Register</h6>

                                        <p class="color-dark" style="font-size: 15px">Already have an account?
                                            <a href="#" id="login-link">Login</a>
                                        </p>
                                    </div>

                                    <!----------------  STEP 1 ------------------->
                                    <div class="step-one">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group-meta position-relative mb-25">
                                                    <label>Name*</label>
                                                    <span class="text-danger name-error d-none">Full Name
                                                        Required*</span>
                                                    <input id="name" type="text" name="name" placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group-meta position-relative mb-25">
                                                    <label>Phone*</label>
                                                    <span class="text-danger phone-error d-none">Phone Number
                                                        Required*</span>
                                                    <span class="text-danger phone-digit-error d-none">Phone Number Not
                                                        valid*</span>
                                                    <span class="text-danger phone-regex-error d-none">Phone Number not
                                                        valid*</span>
                                                    <input type="text" id="phone" name="phone"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group-meta position-relative mb-25">
                                                    <label>Email*</label>
                                                    <span class="text-danger email-error d-none">Email Required*</span>
                                                    <span class="text-danger already-registered-error d-none">Email
                                                        Already
                                                        Taken*</span>
                                                    <span class="text-danger email-valid-error d-none">Email not
                                                        valid*</span>
                                                    <input type="email" name="email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group-meta position-relative mb-20">
                                                    <label>Password*</label>
                                                    <span class="text-danger password-error d-none">Password
                                                        Required*</span>
                                                    <span class="text-danger password-length-error d-none">Password
                                                        Should Contain at least 8 characters*</span>
                                                    <input type="password" name="password" placeholder="Enter Password"
                                                        class="pass_log_id">
                                                    <span class="placeholder_icon"><span class="passVicon"><img
                                                                src="{{url('web/assets/images/icon/icon_68.svg')}}"
                                                                alt=""></span></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group-meta position-relative mb-20">
                                                    <label>Confirm Password*</label>
                                                    <span class="text-danger confirm-password-error d-none">Confirm
                                                        Password Required*</span>
                                                    <span
                                                        class="text-danger confirm-password-match-error d-none">Password
                                                        Not Match*</span>
                                                    <input type="password" name="confirm_password"
                                                        placeholder="Confirm Password" class="pass_log_id">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button style="float: right"
                                                    class="btn-two text-uppercase d-block mt-20 next-step-two">Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!----------------  STEP 2 ------------------->
                                    <div class="step-two d-none">
                                        <div class="row">
                                            <span class="text-danger text-center amount-error d-none">Select Plan to
                                                continue</span>
                                            <input type="hidden" id="amount" name="amount" placeholder="Enter Amount">
                                            <input disabled hidden type="text" name="credit">
                                            <div class="col-4">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanOne">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Individual
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.12 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-one">$ 120</div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">1000 Credits</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Pro
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.10 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-two">$ 500</div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center pb-10">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">5000 Credits</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanThree">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Elite
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.05 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-three">$ 999
                                                        </div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center pb-10">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">20,000
                                                            Credits</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4 d-none">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanFour">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Enterprise
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.04 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-four">$ 1999
                                                        </div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center pb-10">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">50,000
                                                            Credits</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-none">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanFive">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Titanium
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.035 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-five">$ 3499
                                                        </div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center pb-10">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">100,000
                                                            Credits</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-none">
                                                <div
                                                    class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanSix">
                                                    <div class="pr-header text-center mb-20">
                                                        <!-- Adjusted margin-bottom -->
                                                        <div class="plan color-dark fw-500">Diamond
                                                        </div>
                                                        <img src="{{url('web/assets/images/icon/coin.svg')}}"
                                                            class="lazy-img mx-auto" style="width: 65px;" />
                                                        <span style="font-size:15px">$ 0.02 per credit</span>

                                                        <div class="plan color-dark fw-600 actual-price-six">$ 4999
                                                        </div>
                                                    </div>
                                                    <!-- /.pr-header -->
                                                    <div class="pr-footer text-white text-center pb-10">
                                                        <!-- Adjusted margin-top -->
                                                        <span class="fw-bold" style="font-size:15px">250,000
                                                            Credits</span>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- <div class="col-9 mt-10 pt-10">
                                                <input type="text" name="coupon_code" class="form-control"
                                                    placeholder="Enter Coupon Code">
                                            </div>
                                            <div class="col-3 mt-10 pt-10">
                                                <button class="btn btn-one-w100 apply-coupon">Apply</button>
                                            </div> -->
                                            <div class="col-12 text-center">
                                                <span style="font-size:15px" class="coupon-response"></span>
                                            </div>
                                            <div class="mt-50">
                                            </div>
                                            <div class="col-12">
                                                <button style="float: right"
                                                    class="btn-two text-uppercase d-block mt-20 next-step-three">
                                                    Continue
                                                </button>
                                                <button style="float: left"
                                                    class="btn-two text-uppercase d-block mt-20 previous-step-one">
                                                    Previous
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!----------------  STEP 3 ------------------->
                                    <div class="step-three d-none">
                                        <p class="total-payable"></p>
                                        <form class="pt-20" action="{{ route('payment.post') }}" method="post"
                                            id="payment-form">
                                            @csrf
                                            <div class="form-row pb-60">
                                                <input name="coupon_id" type="hidden" value="0" />

                                                <input type="hidden" id="price_id" name="price_id" />
                                                <input type="hidden" id="card_holder_name" name="card_holder_name"
                                                    required>
                                                <input type="hidden" id="total_amount" name="total_amount" required>
                                                <input type="hidden" id="obtained_credits" name="obtained_credits"
                                                    required>
                                                <input type="hidden" id="card_holder_email" name="card_holder_email"
                                                    required>

                                                <div class="form-row pb-60">
                                                    <label for="card-element">
                                                        Credit or debit card
                                                    </label>
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>


                                                <div class="col-12">
                                                    <button type="submit" style="float: right"
                                                        class="btn-two text-uppercase d-block mt-20 register-user">
                                                        Sign Up
                                                    </button>
                                        </form>
                                        <button type="button" style="float: left"
                                            class="btn-two text-uppercase d-block mt-20 previous-step-two">Previous
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
                <!-- /.form-wrapper -->
            </div>
            <!-- /.user-data-form -->
        </div>
    </div>
    </div>


    </div>
</body>

<script>
    $(document).ready(function () {
        $('#loginModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var tabId = button.data('tab'); // Extract tab id from data-tab attribute

            // Activate the corresponding tab
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');
            $('#' + tabId).addClass('show active');
            $('[data-bs-target="#' + tabId + '"]').addClass('active');
        });

        $('#signup-link').click(function (e) {
            e.preventDefault();
            $('#fc1').removeClass('show active');
            $('#fc2').addClass('show active');
        });

        $('#login-link').click(function (e) {
            e.preventDefault();
            $('#fc2').removeClass('show active');
            $('#fc1').addClass('show active');
        });
    });
</script>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Your Stripe public key
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    // Create an instance of Elements
    var elements = stripe.elements();

    // Create an instance of the card Element
    var card = elements.create('card');

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                errorElement.classList.add('error');
            } else {
                $('.loading-screen').removeClass('d-none')
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID using AJAX
    function stripeTokenHandler(token) {

        var form = document.getElementById('payment-form');
        var formData = new FormData(form);
        formData.append('stripeToken', token.id);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    registerUser(); // Call your custom function if successful
                } else {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error;
                    errorElement.classList.add('error');
                }
            })
            .catch(error => {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = 'An error occurred. Please try again.';
                errorElement.classList.add('error');
            });
    }

    function registerUser() {

        var token = $('meta[name="csrf-token"]').attr('content');
        var name = $('input[name="name"]').val();
        var phone = $('input[name="phone"]').val();

        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        var credit = $('input[name="credit"]').val();

        var jsonData = JSON.stringify({

            'name': name,
            'phone': phone,
            'email': email,
            'credit': credit,
            'password': password,
        });

        // /console.log(jsonData);
        $.ajax({
            type: 'POST',
            url: '{{route('register')}}',
            data: jsonData,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function (response) {
                if (response.success) {
                    $('.loading-screen').addClass('d-none')
                    //console.log(response.user_details)
                    const userDetails = response.user_details;
                    localStorage.setItem('user_details', JSON.stringify(userDetails));
                    var user_data=localStorage.getItem('user_details')
                    user_data = JSON.parse(user_data);
                    if(user_data.id && user_data.email)
                {
                    //console.log('Working')
                    window.location.href = '{{ route('dashboard') }}';
                }else{
                    console.log('Error');
                }
                    
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    }
</script>

<script>
    $(document).ready(function () {
        var coupon_applied = false;
        $('#loginModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.btn-close').click(function () {
            resetModal();
        });

        $('.apply-coupon').click(function () {
            if (coupon_applied) {
                $(".coupon-response").html('<span style="color:#D9534F">Coupon Already Applied</span>');
                setTimeout(function () {
                    $(".coupon-response").html('');
                }, 5000);
                return;
            }
            var coupon_code = $('input[name="coupon_code"]').val();
            if (coupon_code) {
                verifyCoupon(coupon_code);
            } else {
                $(".coupon-response").html('<span style="color:#D9534F">Enter Coupon Code to get Discount</span>');
                setTimeout(function () {
                    $(".coupon-response").html('');
                }, 5000);
            }
        });

        function resetModal() {
            $('.step-one').removeClass('d-none');
            $('.step-two').addClass('d-none');
            $('.step-three').addClass('d-none');

            $('input[name="name"]').val("");
            $('input[name="email"]').val("");
            $('input[name="password"]').val("");
            $('input[name="confirm_password"]').val("");
            $('input[name="amount"]').val("");
            $('input[name="credit"]').val("");
            $('input[name="login_email"]').val("");
            $('input[name="login_password"]').val("");
        }

        function verifyCoupon(coupon_code) {

            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var jsonData = JSON.stringify({
                'coupon_code': coupon_code,
            });
            $.ajax({
                type: 'POST',
                url: '{{route('verify-coupon')}}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    var coupon_id = response.coupon_id;
                    $('input[name="coupon_id"]').val(coupon_id);
                    if (response.success) {
                        coupon_applied = true;
                        var discount = parseInt(response.success);
                        var actual_price_one = $('.actual-price-one').text();
                        actual_price_one = actual_price_one.replace('$', '');
                        actual_price_one = parseFloat(actual_price_one);

                        var actual_price_two = $('.actual-price-two').text();
                        actual_price_two = actual_price_two.replace('$', '');
                        actual_price_two = parseFloat(actual_price_two);

                        var actual_price_three = $('.actual-price-three').text();
                        actual_price_three = actual_price_three.replace('$', '');
                        actual_price_three = parseFloat(actual_price_three);

                        var discount_price_one = actual_price_one - (discount / 100) * actual_price_one;
                        $('.actual-price-one').text('$' + discount_price_one)
                        var discount_price_two = actual_price_two - (discount / 100) * actual_price_two;
                        $('.actual-price-two').text('$' + discount_price_two)
                        var discount_price_three = actual_price_three - (discount / 100) * actual_price_three;
                        $('.actual-price-three').text('$' + discount_price_three)
                        $('input[name="amount"]').val('');
                        $('.setPlanOne').removeClass('back-shadow')
                        $('.setPlanTwo').removeClass('back-shadow')
                        $('.setPlanThree').removeClass('back-shadow')
                        $(".coupon-response").html('<span style="color:#5CB85C">Coupon Applied</span>');

                        setTimeout(function () {
                            $(".coupon-response").html('');
                        }, 5000);

                    } else if (response.error) {
                        $(".coupon-response").html('<span style="color:#D9534F">Invalid Coupon</span>');
                        setTimeout(function () {
                            $(".coupon-response").html('');
                        }, 5000);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });
</script>
<!----------------------------  STEPS SCRIPT      ----------------------------------->
<script>
    $(document).ready(function () {
        var phoneRegex = /^[+\d\s()-]+$/;
        $('#phone').inputmask('+1 999 999 9999', {
            showMaskOnFocus: true,
            showMaskOnHover: false,
            numericInput: false
        });


        //-------------- STEP 1 ALREADY DISPLAY ------------//
        //-------------- NEXT STEP 2 ------------//
        $(".next-step-two").click(function () {
            validateDataStepOne();

        });


        //-------------- NEXT STEP 3 ------------//
        $(".next-step-three").click(function () {
            var payable = $('input[name="amount"]').val()
            $('.total-payable').html('<span>Total Amount: $ ' + payable + '</span>')
            validateDataStepTwo();
        });


        //-------------- PREVIOUS STEP 1 ------------//
        $(".previous-step-one").click(function () {
            $('.step-two').addClass('d-none');
            $('.step-one').removeClass('d-none');
        });
        //-------------- PREVIOUS STEP 1 ------------//
        $(".previous-step-two").click(function () {
            $('.step-three').addClass('d-none');
            $('.step-two').removeClass('d-none');
        });

        $('.setPlanOne').click(function () {
            var actual_price_one = $('.actual-price-one').text();
            actual_price_one = actual_price_one.replace('$', '');
            actual_price_one = parseFloat(actual_price_one);
            $('input[name="amount"]').val(actual_price_one);
            console.log(actual_price_one)
            $('input[name="credit"]').val("1000");
            $('input[name="price_id"]').val("price_1Q9pBbEu9UK6AhgwJdTtPaM6");
            $('.setPlanOne').addClass('back-shadow')
            $('.setPlanTwo').removeClass('back-shadow')
            $('.setPlanThree').removeClass('back-shadow')
            $('.setPlanFour').removeClass('back-shadow')
            $('.setPlanFive').removeClass('back-shadow')
            $('.setPlanSix').removeClass('back-shadow')
        });
        $('.setPlanTwo').click(function () {
            var actual_price_two = $('.actual-price-two').text();
            actual_price_two = actual_price_two.replace('$', '');
            actual_price_two = parseFloat(actual_price_two);
            $('input[name="amount"]').val(actual_price_two);
            console.log(actual_price_two)
            $('input[name="credit"]').val("5000");
            $('input[name="price_id"]').val("price_1Q9pCKEu9UK6Ahgwnt8P1aZM");
            $('.setPlanOne').removeClass('back-shadow')
            $('.setPlanTwo').addClass('back-shadow')
            $('.setPlanThree').removeClass('back-shadow')
            $('.setPlanFour').removeClass('back-shadow')
            $('.setPlanFive').removeClass('back-shadow')
            $('.setPlanSix').removeClass('back-shadow')
        });
        $('.setPlanThree').click(function () {
            var actual_price_three = $('.actual-price-three').text();
            actual_price_three = actual_price_three.replace('$', '');
            actual_price_three = parseFloat(actual_price_three);
            $('input[name="amount"]').val(actual_price_three);
            console.log(actual_price_three)
            $('input[name="credit"]').val("20000");
            $('input[name="price_id"]').val("price_1Q9pCtEu9UK6AhgwRz8ZW5OW");
            $('.setPlanOne').removeClass('back-shadow')
            $('.setPlanTwo').removeClass('back-shadow')
            $('.setPlanThree').addClass('back-shadow')
            $('.setPlanFour').removeClass('back-shadow')
            $('.setPlanFive').removeClass('back-shadow')
            $('.setPlanSix').removeClass('back-shadow')
        });
        $('.setPlanFour').click(function () {
            var actual_price_four = $('.actual-price-four').text();
            actual_price_four = actual_price_four.replace('$', '');
            actual_price_four = parseFloat(actual_price_four);
            $('input[name="amount"]').val(actual_price_four);
            console.log(actual_price_four)
            $('input[name="credit"]').val("50000");
            $('input[name="price_id"]').val("price_1Q9pDTEu9UK6AhgwU9YXiY1M");
            $('.setPlanOne').removeClass('back-shadow')
            $('.setPlanTwo').removeClass('back-shadow')
            $('.setPlanThree').removeClass('back-shadow')
            $('.setPlanFour').addClass('back-shadow')
            $('.setPlanFive').removeClass('back-shadow')
            $('.setPlanSix').removeClass('back-shadow')
        });

        $('.setPlanFive').click(function () {
            var actual_price_five = $('.actual-price-five').text();
            actual_price_five = actual_price_five.replace('$', '');
            actual_price_five = parseFloat(actual_price_five);
            $('input[name="amount"]').val(actual_price_five);
            console.log(actual_price_five)
            $('input[name="credit"]').val("100000");
            $('input[name="price_id"]').val("price_1Q9pDyEu9UK6AhgwBTuAr22U");
            $('.setPlanOne').removeClass('back-shadow')
            $('.setPlanTwo').removeClass('back-shadow')
            $('.setPlanThree').removeClass('back-shadow')
            $('.setPlanFour').removeClass('back-shadow')
            $('.setPlanFive').addClass('back-shadow')
            $('.setPlanSix').removeClass('back-shadow')
        });

        $('.setPlanSix').click(function () {
            var actual_price_six = $('.actual-price-six').text();
            actual_price_six = actual_price_six.replace('$', '');
            actual_price_six = parseFloat(actual_price_six);
            $('input[name="amount"]').val(actual_price_six);
            console.log(actual_price_six)
            $('input[name="credit"]').val("250000");
            $('input[name="price_id"]').val("price_1Q9pEZEu9UK6AhgwZNLEioyi");
            $('.setPlanOne').removeClass('back-shadow')
            $('.setPlanTwo').removeClass('back-shadow')
            $('.setPlanThree').removeClass('back-shadow')
            $('.setPlanFour').removeClass('back-shadow')
            $('.setPlanFive').removeClass('back-shadow')
            $('.setPlanSix').addClass('back-shadow')
        });

        function validateDataStepOne() {

            var name = $('input[name="name"]').val();
            var phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var password = $('input[name="password"]').val();
            var confirm_password = $('input[name="confirm_password"]').val();


            if (name && phone && phone.length == 15 && phone.match(phoneRegex) && email && isValidEmail(email) && password && password.length >= 8 && confirm_password && password == confirm_password) {
                // submitContactForm();
                $('input[name="card_holder_name"]').val(name);
                $('input[name="card_holder_email"]').val(email);
                validateEmailFromDataBase()


            } else {

                if (name == "") {
                    $(".name-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".name-error").addClass('d-none');
                    }, 5000);

                }

                if (phone === "") {
                    $(".phone-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".phone-error").addClass('d-none');
                    }, 5000);
                } else if (phone.length != 15) {
                    $(".phone-digit-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".phone-digit-error").addClass('d-none');
                    }, 5000);
                } else if (!phone.match(phoneRegex)) {
                    $(".phone-regex-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".phone-regex-error").addClass('d-none');
                    }, 5000);
                }

                if (email == "") {
                    $(".email-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".email-error").addClass('d-none');
                    }, 5000);

                } else if (!isValidEmail(email)) {
                    $(".email-valid-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".email-valid-error").addClass('d-none');
                    }, 5000);
                }

                if (password == "") {
                    $(".password-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".password-error").addClass('d-none');
                    }, 5000);

                } else if (password.length < 8) {
                    $(".password-length-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".password-length-error").addClass('d-none');
                    }, 5000);
                }
                if (confirm_password == "") {
                    $(".confirm-password-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".confirm-password-error").addClass('d-none');
                    }, 5000);
                } else if (password != confirm_password) {
                    $(".confirm-password-match-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".confirm-password-match-error").addClass('d-none');
                    }, 5000);
                }

            }

        }

        function validateDataStepTwo() {
            var amount = $('input[name="amount"]').val();
            var credits = $('input[name="credit"]').val();
            var isDigit = /^\d+$/.test(amount);

            if (amount) {
                $('input[name="total_amount"]').val(amount);
                $('input[name="obtained_credits"]').val(credits);

                // submitContactForm();
                $('.step-two').addClass('d-none');
                $('.step-three').removeClass('d-none');
            } else {

                if (amount == "") {
                    $(".amount-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".amount-error").addClass('d-none');
                    }, 5000);

                } else if (!isDigit) {
                    $(".amount-syntax-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".amount-syntax-error").addClass('d-none');
                    }, 5000);

                }
            }
        }

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validateEmailFromDataBase() {
            var token = $('meta[name="csrf-token"]').attr('content');

            var email = $('input[name="email"]').val();
            var jsonData = JSON.stringify({
                'email': email,
            });

            $.ajax({
                type: 'POST',
                url: '{{route('verify-email')}}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                'X-CSRF-TOKEN': token
            },
                success: function (response) {
                    if (response.success) {
                        // registerUser()
                        $('.step-one').addClass('d-none');
                        $('.step-two').removeClass('d-none');
                    } else if (response.duplicateEntry) {
                        $(".already-registered-error").removeClass('d-none')
                        setTimeout(function () {
                            $(".already-registered-error").addClass('d-none');
                        }, 5000);

                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
                });
            }

        });
</script>

<!--------------------------- LOGIN SCRIPT  ------------------------------->
<script>
    $(document).ready(function () {
        $(".login-btn").click(function () {
            $('.login-btn').prop('disabled', true);
            $('.login-text').addClass('d-none');
            $('.login-loader').removeClass('d-none');
            validateData();
        });

        function validateData() {

            var email = $('input[name="login_email"]').val();
            var password = $('input[name="login_password"]').val();


            if (email && isValidEmail(email) && password && password.length >= 8) {
                submitContactForm();
            } else {
                $('.login-btn').prop('disabled', false);
                $('.login-text').removeClass('d-none');
                $('.login-loader').addClass('d-none');

                if (email == "") {
                    $(".login-email-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".login-email-error").addClass('d-none');
                    }, 5000);

                } else if (!isValidEmail(email)) {
                    $(".login-email-valid-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".login-email-valid-error").addClass('d-none');
                    }, 5000);
                }

                if (password == "") {
                    $(".login-password-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".login-password-error").addClass('d-none');
                    }, 5000);

                } else if (password.length < 8) {
                    $(".login-password-length-error").removeClass('d-none')
                    setTimeout(function () {
                        $(".login-password-length-error").addClass('d-none');
                    }, 5000);
                }


            }

        }

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function submitContactForm() {


            var token = $('meta[name="csrf-token"]').attr('content');
            var email = $('input[name="login_email"]').val();
            var password = $('input[name="login_password"]').val();

            var jsonData = JSON.stringify({


                'email': email,
                'password': password,
            });

            // /console.log(jsonData);
            $.ajax({
                type: 'POST',
                url: '{{route('login')}}',
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    
                    if(response.success)
                {
                    const userDetails = response.user_details;
                    localStorage.setItem('user_details', JSON.stringify(userDetails));
                    var user_data=localStorage.getItem('user_details')
                    user_data = JSON.parse(user_data);
                    if(user_data.id && user_data.email)
                {
                    //console.log('Working')
                    window.location.href = '{{ route('dashboard') }}';
                }
            }
                    

                    if (response.emaiNotFound) {
                        $(".email-not-found").removeClass('d-none')
                        setTimeout(function () {
                            $(".email-not-found").addClass('d-none');
                        }, 5000);
                        $('.login-btn').prop('disabled', false);
                        $('.login-text').removeClass('d-none');
                        $('.login-loader').addClass('d-none');
                    }
                    if (response.passwordIncorrect) {
                        $(".incorrect-password").removeClass('d-none')
                        setTimeout(function () {
                            $(".incorrect-password").addClass('d-none');
                        }, 5000);
                        $('.login-btn').prop('disabled', false);
                        $('.login-text').removeClass('d-none');
                        $('.login-loader').addClass('d-none');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        }


    });
</script>

@stop