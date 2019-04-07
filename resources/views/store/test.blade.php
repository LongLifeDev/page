<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LongLifeMicro') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /**
            * The CSS shown here will not be introduced in the Quickstart guide, but shows
            * how you can use CSS to style your Element's container.
        */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
</head>
<body body onload="goStripe()">
    
    <form action="/checkout" method="POST" id="payment-form">
        {{csrf_field()}}
        <div class="form-row">
            <!--<div class='form-group'>-->
                <label for="user-name">
                    Name
                </label>
                <input type="text" id="name" class="form-control">
            
            <div class='form-group'>
                <label for="card-name">
                    Card Name
                </label>
                <input type="text" id="card-name" class="form-control">
            </div>
            <div class='form-group'>
                <label for="address">
                    Street Address
                </label>
                <input type="text" id="address" class="form-control">
            </div>
            <div class='form-group'>
                <label for="city">
                    City
                </label>
                <input type="text" id="city" class="form-control">
            </div>
            <div class='form-group'>
                <label for="country">
                    country
                </label>
                <input type="text" id="country" class="form-control">
            </div>
            <div class='form-group'>
                <label for="state">
                    State
                </label>
                <input type="text" id="state" class="form-control">
            </div>
            <div class='form-group'>
                <label for="zipcode">
                    Postal Code
                </label>
                <input type="text" id="zipcode" class="form-control">
            </div>
            <div class='form-group'>
                <label for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element" class="form-control">
        
                </div>
            </div>
        
            <div id="card-errors" role="alert"></div>
        </div>
    
        
        <button type="submit" class="btn btn-success">Submit Payment</button>
    </form>

    <!-- Scripts -->
    
    <script>
        function goStripe(){
            // Create a Stripe client.
            var stripe = Stripe('pk_test_u4Ddl7OZT1GmxbPn6ulACC0z00yZ0KVkuh');
    
            // Create an instance of Elements.
            var elements = stripe.elements();
    
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Railway", Helvetica, sans-serif',
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
    
            // Create an instance of the card Element.
            var card = elements.create('card', {style: style, hidePostalCode: true});
    
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
    
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
                }
            });
    
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
    
                stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                    }
                });
            });
    
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
    
                // Submit the form
                form.submit();

      
            };

        };
        </script>
</body>

</html>