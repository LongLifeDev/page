<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Checkout</title>

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

            border: 1px solid #ccd0c2;
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

        #card-errors {
            color: red;
        }
    </style>
</head>
<body body onload="goStripe()">
<div class="container" >
    <h1 class="text-center"><span class="glyphicon glyphicon-leaf" style="font-size: 1em;"></span>LongLifeStore Checkout</h1><br/>
    <p class="text-center" style="margin: 0px 5% 15px"><a href="/getCart" class="btn btn-primary pull-left">Return to Cart</a>This Credit Card processing is live for testing only. <span style="color:red">Do Not send real C.C. info please.</span> You may run tests with this C.C.# 4242 4242 4242 4242 exp:11/22 cvc:244 . <span style="color:red">No products will be shipped.</span> have Fun!</p>
    
    <div class="well" style="margin: 0px 2% 0px 2%">
        <form action="/chargeElements/{{$total}}" method="POST" id="payment-form">
            <div class="row">
                <div class='form-group'>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="name_on_card">
                            Name on Card
                        </label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="required" required>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="email">
                            Email Address
                        </label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="required" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='form-group'>
                    <div class="col-md-8 col-sm-8 col-xs-8"> 
                        <label for="address_line1">
                            Street Address
                        </label>
                        <input type="text" class="form-control" id="address_line1" name="address_line1"placeholder="required" required >
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4"> 
                        <label for="address_line2">
                            Unit
                        </label>
                        <input type="text" class="form-control" id="address_line2" name="address_line2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='form-group'>
                    <div class="col-md-5 col-sm-4 col-xs-5"> 
                        <label for="address_city">
                            City
                        </label>
                        <input type="text" class="form-control" id="address_city" name="address_city"placeholder="required" required >
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-3"> 
                        <label for="address_state">
                            State
                        </label>
                        <select id="address_state" class="form-control" name="address_state" placeholder="required" required>
                            <option value="">N/A</option>
                            <option value="AK">Alaska</option>
                            <option value="AL">Alabama</option>
                            <option value="AR">Arkansas</option>
                            <option value="AZ">Arizona</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DC">District of Columbia</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="IA">Iowa</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MD">Maryland</option>
                            <option value="ME">Maine</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MO">Missouri</option>
                            <option value="MS">Mississippi</option>
                            <option value="MT">Montana</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="NE">Nebraska</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NV">Nevada</option>
                            <option value="NY">New York</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VA">Virginia</option>
                            <option value="VT">Vermont</option>
                            <option value="WA">Washington</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WV">West Virginia</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-4"> 
                        <label for="address_zip">
                            ZipCode
                        </label>
                        <input type="text" id="address_zip" class="form-control" name="address_zip" placeholder="required" required>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4"> 
                        <label for="address_country">
                            country
                        </label>
                        <input type="text" id="address_country" class="form-control" name="address_country">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class='form-group'>
                        <label for="card-element">
                            Credit or Debit Card
                        </label>
                        <div id="card-element" class="form-control">
                
                        </div>
                    </div>
                            
                    <div id="card-errors" role="alert"></div>
                    {{csrf_field()}}

                    <br/>
                    <button type="submit" class="btn btn-success btn-lg">Pay ${{number_format ( $total/100, 2, '.', ' ')}}</button>
                </div>    
            </div>
        </form>
    </div>
</div>

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