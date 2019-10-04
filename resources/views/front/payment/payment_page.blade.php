@extends('front.master_front')

@section('styles')
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
@endsection

@section('content')

    <div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-6">
        <div class="confirm-order__container box-shadow">
            <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">My Order</h4>
            <div class="panel panel-default no-border-shadow">
                <div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td></td>
                                    <td>Product Name</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Amount</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->order_details as $orderDetail)
                                    <tr>
                                        <td class="align-middle">
                                            @foreach($orderDetail->product->images as $image)
                                                @if($image->is_main==1)
                                                    <img class="img-fluid img-responsive cart_image_size"
                                                         src="{{ asset($image->image) }}"
                                                         alt="product-img"/>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="align-middle">{{ $orderDetail->product->title }}</td>
                                        <td class="align-middle">{{ $orderDetail->quantity }}</td>
                                        <td class="align-middle">
                                            ${{ $orderDetail->price }}</td>
                                        <td class="align-middle">
                                            ${{ $orderDetail->total }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="order_summary">
                            <p class="sub_total">
                                <span class="">Sub-Total:</span>
                                <span class="pull-right">Rs.{{ $order->subtotal }}@if($order->discount != 0): (Discount -{{$order->discount}}) @endif</span>
                            </p>
                            <p class="shipping">
                                <span class="">Shipping-Charges:</span>
                                <span class="pull-right">Rs.{{ $order->shipping->shipping_price }}</span>
                            </p>
                            <p class="grand_total">
                                <span class="">Grand-Total:</span>
                                <span class="pull-right">Rs.{{ $order->final_total }} </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" value="Confirm Order" class="uk-button next submit">
        </div>
        </div>
        <div class="col-md-6" style="padding-top: 50px">
            <div>
                <h3 class="center">Paypal Payment</h3>
                <form action="{{ route('checkout.paypal',$order->id) }}" method="post" class="center">
                @csrf
                <button class="btn btn-primary btn-lg justify-content-center" style="width: 247px">Paypal Payment</button>
                </form>
            </div>

            <div class="" style="margin-top: 40px;">
                <h3 class="center">Stripe Payment</h3>
                <form action="{{ route('test_post',$order->id) }}" method="post" class="require-validation"
                      id="payment-form">
                    @csrf
                    <div class="form-row">
                        <label for="card-stripe-element">
                            Credit or debit card
                        </label>
                        <div id="card-stripe-element" style="width: 100%;">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="col-md-6 offset-md-3" style="margin-top: 10px">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                    </div>
                    <input type="hidden" name="price" value="1000">

                </form>
            </div>
        </div>
    </div>
        <hr>
    </div>

@endsection

@section('script')
    {{--<script src="https://js.stripe.com/v3/"></script>--}}
    <script>
            // Create a Stripe client.
            var stripe = Stripe('pk_test_xecH9PxDrnrHRDP6E4dTgZag00mRTZA4GC');

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
            card.mount('#card-stripe-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                stripe.createToken(card).then(function (result) {
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
@endsection