@extends('layouts.aside')
@section('content')
<style>
    .pricing-section-two .pr-column-wrapper .pr-header {
        border-bottom: none;
        padding: 30px;
        background-color: white;
    }

    .pricing-section-two .pr-column-wrapper {
        background-color: white;
    }

    .price-container {
        font-family: Arial, sans-serif;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
    }

    .price-container .currency-symbol {
        margin-right: 5px;
    }

    .price-container input {
        border: none;
        border-bottom: 1px solid #333;
        outline: none;
        font-weight: 600;
        color: #333;
        padding: 0;
        width: 200px;
        background: transparent;
    }

    .price-container input::placeholder {
        font-size: 15px;
        /* Set placeholder font size */
        color: #999;
        /* Optional: Lighter color for the placeholder text */
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
</style>

<div class="loading-screen d-none">
    <i class="fa-solid fa-spinner fa-spin-pulse" style="font-size: 100px; color: #B95CF4;"></i>
    <div class="loading-text">
        <span style="font-size:16px;">Loading</span>
        <br>
        Updating Credits ....
    </div>
</div>

<div class="pricing-section-two">
    <div class="wrapper">
        <div class="row gx-xxl-5">

            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Individual</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ 0.12 per credit</span>

                        <div class="plan color-dark fw-600 planOneActualPrice actual-price">$ 120</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-one" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            1000 Credits</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Pro</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />

                        <span style="font-size:15px">$ 0.10 per credit</span>

                        <div class="plan color-dark fw-600 planTwoActualPrice">$ 499</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-two" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            5000 Credits</button>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Elite</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ 0.05 per credit</span>

                        <div class="plan color-dark fw-600 planThreeActualPrice">$ 999</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-three" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            20,000 Credits</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Enterprise</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ 0.04 per credit</span>

                        <div class="plan color-dark fw-600 planFourActualPrice">$ 1999</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-four" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            50,000 Credits</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Titanium</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ 0.035 per credit</span>

                        <div class="plan color-dark fw-600 planFiveActualPrice">$ 3499</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-five" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            100,000 Credits</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan">
                            <span style="font-weight:500">Diamond</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ 0.02 per credit</span>

                        <div class="plan color-dark fw-600 planSixActualPrice">$ 4999</div>
                    </div>
                    <div class=" text-white text-center">
                        <button class=" btn btn-two plan-six" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="font-size:15px">
                            250,000 Credits</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pr-column-wrapper border-0 pt-20 mt-30 button-styles setPlanTwo">
                    <div class="pr-header text-center">
                        <!-- Adjusted margin-bottom -->
                        <div class="plan color-dark fw-500">
                            <span style="color:#D38BFF;font-size:12px;font-weight:500">(Pay as you go)</span><br>
                            <span style="font-weight:500">Business</span>
                        </div>
                        <img src="{{url('web/assets/images/icon/coin.svg')}}" class="lazy-img mx-auto"
                            style="width: 65px;" />
                        <span style="font-size:15px">$ {{$pricePerCredit}} per credit</span>

                        <div class="plan color-dark fw-600">
                            <div class="price-container">
                                <span class="currency-symbol">$</span>
                                <input id="amountInput" name="amountInput" type="number" placeholder="Enter Amount"
                                    style="width:100%;" oninput="updateCredits()">
                            </div>
                        </div>
                    </div>
                    <!-- /.pr-header -->
                    <div class=" text-white text-center pb-10">
                        <!-- Adjusted margin-top -->
                        <button id="creditsDisplay" class="btn btn-two setPlanPay" style="font-size:15px">Get
                            Credits</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!--Coupon Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- Added modal-sm class for smaller modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="couponModalLabel">Coupon Code</h1> <!-- Reduced font size -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Enter Coupon Code
                <input type="text" class="form-control" name="coupon_code">
                <span class="coupon-alredy-applied d-none" style="font-size:11px;color:#D9534F">Coupon Already
                    Applied</span>
                <span class="coupon-error d-none" style="font-size:11px;color:#D9534F">Enter Coupon To get
                    Discount</span>
                <span class="coupon-invalid d-none" style="font-size:11px;color:#D9534F">Invalid Coupon</span>
                <span class="coupon-success d-none" style="font-size:11px;color:#5CB85C">Coupon Applied</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary apply-coupon">Apply</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="total-payable"></p>
                <form class="pt-20" action="{{ route('payment.post') }}" method="post" id="payment-form">
                    @csrf
                    <div class="form-row pb-60">
                        <input type="hidden" name="price_id" />
                        <input type="hidden" id="card_holder_name"
                            name="card_holder_name" required>
                        <input type="hidden" id="total_amount" name="total_amount" required>
                        <input type="hidden" id="obtained_credits" name="obtained_credits" required>
                        <input type="hidden" id="card_holder_email" 
                            name="card_holder_email" required>
                        <input type="hidden" name="subscription_id"
                            value="{{$last_transaction ? $last_transaction->payment_id : ''}}" />
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Get Credits</button>
                </form>

            </div>
        </div>
    </div>
</div>







<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


    function updateCredits() {
        const amountInput = document.getElementById('amountInput');
        const creditsDisplay = document.getElementById('creditsDisplay');
        const costPerCredit = parseFloat({{$pricePerCredit}});
        const amount = parseFloat(amountInput.value);

        console.log(costPerCredit)
        if (!isNaN(amount) && amount > 0) {
            const credits = Math.floor(amount / costPerCredit);
            creditsDisplay.textContent = `Get ${credits} Credits`;
            creditsDisplay.setAttribute('data-bs-toggle', 'modal');
            creditsDisplay.setAttribute('data-bs-target', '#exampleModal');

            // Set the credits and amount values in hidden fields
            $('input[name="obtained_credits"]').val(credits);
            $('input[name="total_amount"]').val(amount);
            $('.total-payable').html('Total Amount: $ ' + amount);

            // Change the form action when credits are updated


        } else {
            creditsDisplay.textContent = 'Credits';
            creditsDisplay.removeAttribute('data-bs-toggle');
            creditsDisplay.removeAttribute('data-bs-target');
            // Reset the form action to default route when input is invalid
        }
    }

</script>

<script>
    $(document).ready(function () {
    
        var user_data=localStorage.getItem('user_details')
        if(!user_data)
    {
        window.location.href = '{{ route('welcome') }}';
    }
    user_data = JSON.parse(user_data);
        var user_id=user_data.id
        var email=user_data.email 
         
        $('input[name="card_holder_name"]').val(user_data.name);            
        $('input[name="card_holder_email"]').val(email);        
        $('.plan-one').click(function () {
            setPlanOne();
        });
        $('.plan-two').click(function () {
            setPlanTwo();
        });
        $('.plan-three').click(function () {
            setPlanThree();
        });
        $('.plan-four').click(function () {
            setPlanFour();
        });
        $('.plan-five').click(function () {
            setPlanFive();
        });
        $('.plan-six').click(function () {
            setPlanSix();
        });
        $('.setPlanPay').click(function () {
            document.getElementById('payment-form').setAttribute('action', '{{ route("manuall-payment") }}');
        });
        var coupon_applied = false;
        $('.apply-coupon').click(function () {
            var coupon_code = $('input[name="coupon_code"]').val();
            if (coupon_applied) {
                $(".coupon-alredy-applied").removeClass('d-none');
                setTimeout(function () {
                    $(".coupon-alredy-applied").addClass('d-none');
                }, 5000);
            } else {
                if (coupon_code) {
                    //console.log(coupon_code)
                    verifyCoupon(coupon_code);
                } else {
                    $(".coupon-error").removeClass('d-none');
                    setTimeout(function () {
                        $(".coupon-error").addClass('d-none');
                    }, 5000);
                }
            }
        });

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

                    if (response.success) {
                        coupon_applied = true;
                        var discount = parseInt(response.success);

                        var actual_price_one = $('.planOneActualPrice').text();
                        actual_price_one = actual_price_one.replace('$', '');
                        actual_price_one = parseFloat(actual_price_one);
                        var discount_price_one = actual_price_one - (discount / 100) * actual_price_one;

                        var actual_price_two = $('.planTwoActualPrice').text();
                        actual_price_two = actual_price_two.replace('$', '');
                        actual_price_two = parseFloat(actual_price_two);
                        var discount_price_two = actual_price_two - (discount / 100) * actual_price_two;

                        var actual_price_three = $('.planThreeActualPrice').text();
                        actual_price_three = actual_price_three.replace('$', '');
                        actual_price_two = parseFloat(actual_price_two);
                        var discount_price_three = actual_price_three - (discount / 100) * actual_price_three;
                        console.log(discount_price_one, ' - ', discount_price_two, ' - ', discount_price_three)
                        $('.planOneActualPrice').html('$ ' + discount_price_one);
                        $('.planTwoActualPrice').html('$ ' + discount_price_two);
                        $('.planThreeActualPrice').html('$ ' + discount_price_three);
                        $(".coupon-success").removeClass('d-none');

                        setTimeout(function () {
                            $(".coupon-success").addClass('d-none');
                            $('input[name="coupon_code"]').val("");
                            $('#couponModal').modal('hide')

                        }, 3000);
                    } else if (response.error) {
                        $(".coupon-invalid").removeClass('d-none');
                        setTimeout(function () {
                            $(".coupon-invalid").addClass('d-none');
                        }, 5000);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        }

    });

    function setPlanOne() {
        var priceText = $('.planOneActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(1000)
        $('input[name="price_id"]').val('price_1Q9pBbEu9UK6AhgwJdTtPaM6')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }

    function setPlanTwo() {
        var priceText = $('.planTwoActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(5000)
        $('input[name="price_id"]').val('price_1Q9pCKEu9UK6Ahgwnt8P1aZM')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }

    function setPlanThree() {
        var priceText = $('.planThreeActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(20000)
        $('input[name="price_id"]').val('price_1Q9pCtEu9UK6AhgwRz8ZW5OW')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }

    function setPlanFour() {
        var priceText = $('.planFourActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(50000)
        $('input[name="price_id"]').val('price_1Q9pDTEu9UK6AhgwU9YXiY1M')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }
    function setPlanFive() {
        var priceText = $('.planFiveActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(100000)
        $('input[name="price_id"]').val('price_1Q9pDyEu9UK6AhgwBTuAr22U')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }
    function setPlanSix() {
        var priceText = $('.planSixActualPrice').text().trim();
        var priceWithoutDollar = priceText.replace('$', '').trim();
        var priceInteger = parseInt(priceWithoutDollar, 10);
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(250000)
        $('input[name="price_id"]').val('price_1Q9pEZEu9UK6AhgwZNLEioyi')
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
        document.getElementById('payment-form').setAttribute('action', '{{ route("payment.post") }}');
    }

    function setPlanPay() {
        var priceText = $('input[name="amountInput"]').val()
        $('input[name="total_amount"]').val(priceInteger)
        $('input[name="obtained_credits"]').val(2500)
        $('.total-payable').html('Total Amount: $ ' + priceInteger)
    }


</script>

<script src="https://js.stripe.com/v3/"></script>
<script>

    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {

        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                errorElement.classList.add('error');
            } else {
                $('.loading-screen').removeClass('d-none')
                stripeTokenHandler(result.token);
            }
        });
    });
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
                    $('.loading-screen').addClass('d-none')
                    location.reload()

                } else {
                    $('.loading-screen').addClass('d-none')
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

</script>

@stop