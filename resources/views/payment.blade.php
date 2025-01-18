<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <h1>Stripe Payment</h1>

    <form action="{{ route('payment.post') }}" method="post" id="payment-form">
        @csrf
        <div class="form-row">
            <label for="amount">
                Amount
            </label>
            <input type="number" id="amount" name="amount" placeholder="Enter amount" required>
        </div>
        <div class="form-row">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit">Submit Payment</button>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Append the amount input value to the form
            var amountInput = document.getElementById('amount');
            var amountHiddenInput = document.createElement('input');
            amountHiddenInput.setAttribute('type', 'hidden');
            amountHiddenInput.setAttribute('name', 'amount');
            amountHiddenInput.setAttribute('value', amountInput.value);
            form.appendChild(amountHiddenInput);

            form.submit();
        }
    </script>
</body>
</html>
