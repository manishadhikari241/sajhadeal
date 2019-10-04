<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Stripe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style type="text/css">

        .panel-title {

            display: inline;

            font-weight: bold;

        }

        .display-table {

            display: table;

        }

        .display-tr {

            display: table-row;

        }

        .display-td {

            display: table-cell;

            vertical-align: middle;

            width: 61%;

        }

    </style>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h3 class="panel-title display-td">Payment Details</h3>
                        <div class="display-td">
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form  action="{{ route('test_post') }}" method="post" class="require-validation"
                          id="payment-form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                class='form-control' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20'
                                        type='text' data-stripe="number">
                            </div>
                        </div>
                        <div class='form-row row'>

                            <div class='col-xs-12 col-md-4 form-group cvc required'>

                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' data-stripe="cvc" class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>

                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                        data-stripe="exp-month"
                                        type='text'>

                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text' data-stripe="exp-year">

                            </div>

                        </div>


                        <div class='form-row row'>

                            <div class='col-md-12 error form-group hide'>

                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
    var stripe = Stripe("{{ env('STRIPE_KEY') }}");

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
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

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

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
    }
</script>

</body>
</html>
