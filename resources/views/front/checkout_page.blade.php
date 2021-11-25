@extends('front.master_front')
@section('title','Checkout')

@section('styles')
    <style>
        /*.ajax-loader {*/
        /**/
        /*background-color: rgba(255,255,255,0.7);*/
        /*position: absolute;*/
        /*z-index: +100 !important;*/
        /*width: 100%;*/
        /*height:100%;*/
        /*}*/


        .ajax-loader {
            position: fixed;
            overflow: hidden;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10000;
            display: none;

        }

        .center-screen {
            position: fixed;
            display: block;
            opacity: 0.5;
            z-index: 10001;
            left: 50%;
            top: 50%;
            height: 60px;
            width: 60px;
            transform: translate(-50%);

        }

        .ajax-loader:before {
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background: black;
            z-index: 10;
            opacity: 0.8;
        }

        svg path,
        svg rect {
            fill: #FF6700;
        }

    </style>
@endsection

@section('content')
    <section class="checkoutpage-container">
        <div class="ajax-loader">
            <div class="center-screen">
                {{--<img src="{{ asset('front/loader.gif') }}">--}}
                <div class="loader--style2" title="1">
                    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="60px" height="60px" viewBox="0 0 50 50" style="width:100%;enable-background:new 0 0 50 50;"
                         xml:space="preserve">
  <path fill="#000"
        d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
  </path>
  </svg>
                </div>

            </div>
            {{--<div class="loaderoverlay"></div>--}}
        </div>
        <button style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px"
                type="button" id="payment-button">Pay with Khalti
        </button>
        <div class="container check-out uk-margin-bottom">
            <form action="" id="msform" method="post">
                <ul class="liststyle--none progressbar" id="progressbar">
                    <li class="actively">Address</li>
                    <li>Order</li>
                    <li>Done</li>
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
                <fieldset class="actively">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 ">
                            <div class="box-shadow uk-margin-bottom">

                                <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">Information</h4>

                                <h4 class="emailDisable uk-margin">Email Address</h4>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Input"
                                           Placeholder="Susahantshrestha@gmail.com"
                                           value="{{ Sentinel::getUser()->email }}" disabled>
                                </div>
                                <hr>
                                <h4 style="background: #f1f1f1;
    padding: 15px;
    color: black;
    margin: 0;"> Delivery Address</h4>
                                <h4 style="color:#444 ;margin-top:1rem;padding:0 10px"> Add Address
                                    <span class="pull-right address_error" style="display: none; color: red;">Please Fill all the * Fields.</span>
                                </h4>
                                <div class="uk-form-stacked uk-padding-small">

                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text"><span class="address_error"
                                                                                                   style="display: none; color: red;">*</span>
                                            Full Name</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" name="fname" id="form-stacked-text" type="text"
                                                   placeholder="firstname" required
                                                   @if($preset_address != null) value="{{$preset_address->first_name}}" @endif>
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text"><span class="address_error"
                                                                                                   style="display: none; color: red;">*</span>
                                            Phone</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" id="form-stacked-text" type="text"
                                                   placeholder="Phone Number" name="phone"
                                                   @if($preset_address != null) value="{{ $preset_address->phone }}" @endif>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text"><span class="address_error"
                                                                                                   style="display: none; color: red;">*</span>
                                            Address</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" id="form-stacked-text" type="text"
                                                   placeholder="Address" name="delivery_address"
                                                   @if($preset_address != null) value="{{ $preset_address->address }}" @endif>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text"><span class="address_error"
                                                                                                   style="display: none; color: red;">*</span>
                                            Shipping District</label>
                                        <div class="uk-form-controls">
                                            <select name="location" class="uk-form-label form-control shipping"
                                                    id="shippingBox" required>
                                                <option selected value="none">Select a shipping district</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->shipping_price }}">
                                                        {{ $location->shipping_location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-text">
                                            Note</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" id="form-stacked-text" type="text"
                                                   placeholder="Any Specific Detail For The Order" name="lname">
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <div class="uk-form-controls">
                                            <input type="checkbox" name="save_address" id="save_address_checkbox"
                                                   value="1">Save this address
                                        </div>
                                    </div>
                                    <button type="button" class="uk-button to_orders submit">Continue</button>


                                </div>
                            </div>


                        </div>
                        <div class="col-md-5 col-sm-6">
                            <div class="box-shadow">
                                <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0 0 10px 0;">Your
                                    order
                                    <div class="float-right">
                                        <small><a class="afix-1" href="/view_cart">Edit Cart</a></small>
                                    </div>
                                </h4>
                                @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                                    <a href="" class="mini-cart">
                                        <figure>
                                            <img width="300" height="143"
                                                 src="{{ asset($product->attributes['image']) }}"
                                                 alt="{{ $product->name }}">
                                        </figure>
                                        <div class="newscard-content ">
                                            <span class="item-title">{{ $product->name }} </span>
                                            <div>{{ $product->quantity }} x <span
                                                        class="item-price">{{ $product->price }}</span></div>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="item-checkout">
                                    @if(!session()->get('coupon'))
                                        <hr>
                                        <div style="height: 60px">
                                            <div class="form-group">
                                                <span>Have a coupon?</span>
                                                <input type="text" id="coupon_code" class="pull-right"
                                                       name="coupon_code" placeholder="Apply Coupon Code">
                                            </div>
                                            <div>
                                                <a class="btn btn-sm btn-success pull-right" style="display: inline;"
                                                   id="apply_coupon">Apply</a>
                                                <span id="coupon_error" style="display:none; color: red"></span>
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    <div class="row">
                                        @if(!session()->get('coupon'))
                                            <div class="col-12 ">
                                                <strong>Subtotal</strong>
                                                <div class="float-right"><span>Rs.</span><span
                                                            id="no_dis_subtotal">{{ $subtotal }}</span></div>
                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                                <div class="clearfix"></div>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <strong>Subtotal</strong>
                                                <div class="float-right"><span>Rs.</span><span>{{ $subtotal }}</span>
                                                </div>
                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-12">
                                                <strong>Discount ({{ session()->get('coupon')['discount'] }})</strong>
                                                <a class="btn btn-danger btn-sm" href="{{ route('coupon_destroy') }}"
                                                   id="remove_coupon" style="font-size: 11px; border: none">Remove</a>
                                                <span class="d-inline-block w-100px pull-right">- {{ session()->get('coupon')['discount'] }}</span>
                                                <input type="hidden" name="discount"
                                                       value="{{ session()->get('coupon')['discount'] }}">
                                                <input type="hidden" name="coupon_name"
                                                       value="{{ session()->get('coupon')['name'] }}">
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <strong>New Subtotal</strong>
                                                <div class="float-right"><span>Rs.</span><span
                                                            id="after_dis_subtotal">{{ $subtotal-session()->get('coupon')['discount'] }}</span>
                                                </div>
                                                <input type="hidden" name="subtotal"
                                                       value="{{ $subtotal-session()->get('coupon')['discount'] }}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <hr>
                                        @endif
                                        <div class="col-12">
                                            <small>Shipping</small>
                                            <div class="float-right"><span>Rs.</span><span id="shipping_price">-</span>
                                            </div>
                                            <input type="hidden" id="form_shipping_price" name="shipping_price"
                                                   value="0">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" style="padding: 0 0 10px">
                                        <div class="col-12">
                                            <strong>Order Total</strong>
                                            <div class="float-right"><span>Rs.</span><span id="order_total">
                                            @if(session()->get('coupon')){{ $subtotal-session()->get('coupon')['discount'] }}@else{{ $subtotal }}@endif
                                        </span></div>
                                            <input type="hidden" id="form_order_total" name="order_total" value="0">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="drop_location" id="drop_location" value="">

                                    {{--<div class="item-subtotal">Subtotal: <span class="item-price">Rs.425</span></div>--}}
                                    {{--<div class="item-total">Subtotal: <span class="item-price">Rs.425</span></div>--}}

                                </div>


                            </div>

                        </div>
                    </div>
                </fieldset>
                <fieldset class="">
                    <div class="row paymenting field">

                        <div class="col-md-4">
                        <div class="payment-method__container box-shadow">
                        <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">
                        Payment method
                        </h4>
                        <div id="payment" class="checkout-payment">
                        <ul class=" payment_methods liststyle--none uk-margin-bottom">

                        <li class="payment_method payment_method_ebanks">


                        <div class="payment_box payment_method_banks">


                        <div class="radio d-block">
                        <label class="d-flex align-items-center">
                        <input type="radio" name="optionsRadios" id="optionsRadios1"
                        class="uk-radio input-radio"
                        value="option1" checked>
                        <figure class="payment-method__logo-box">
                        <img src="http://1.bp.blogspot.com/-cOpncwOZ2sM/VdbAtf3pxlI/AAAAAAAAAKE/FX2nWmG1ZWo/s1600/esewa.png"
                        alt="">
                        </figure>

                        </label>
                        </div>
                        <div class="radio d-block">
                        <label class="d-flex align-items-center">
                        <input type="radio" name="optionsRadios" id="optionsRadios2"
                        class="uk-radio input-radio"
                        value="option2">
                        <figure class="payment-method__logo-box">
                        <img src="https://cdn-images-1.medium.com/max/1006/1*xqUNa2hUbiis04Z2XTr4Jw.png"
                        alt="">
                        </figure>

                        </label>
                        </div>
                        </div>
                        </li>

                        <li class="payment_method payment_method_cod">
                        <input id="payment_method_cod" type="radio" class="uk-radio input-radio"
                        name="payment_method" value="cod">

                        <label for="payment_method_cod" style="marign-left:20px">Cash on
                        delivery </label>
                        <div class="payment_box payment_method_cod" style="display:none;">
                        <p>Pay with cash upon delivery.</p>
                        </div>
                        </li>
                        </ul>

                        </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <div class="confirm-order__container box-shadow">
                                    <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">Confirm
                                        order</h4>
                                    <button style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px" type="button" id="payment-button">Pay with Khalti</button>

                                    <div class="panel panel-default no-border-shadow">
                                        <div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr class="warning">
                                                            <td class="text-left">Product Name</td>
                                                            {{--<td class="text-left">Model</td>--}}
                                                            <td class="text-right">Quantity</td>
                                                            <td class="text-right">Unit Price</td>
                                                            <td class="text-right">Total</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                                                            <tr>
                                                                <td class="text-left">{{ $product->name }}</td>
                                                                {{--<td class="text-left">Product 14</td>--}}
                                                                <td class="text-right">{{ $product->quantity }}</td>
                                                                <td class="text-right">Rs.{{ $product->price }}</td>
                                                                <td class="text-right">Rs.{{ $product->price*$product->quantity }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        @if(session()->get('coupon'))
                                                        <tr>
                                                            <td colspan="4" class="text-right">
                                                                <strong>Discount:</strong>
                                                            </td>
                                                            <td class="text-right">Rs.<span id="order_confirm_discount">{{ session()->get('coupon')['discount'] }}</span></td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td colspan="4" class="text-right">
                                                                <strong>Sub-Total:</strong>
                                                            </td>
                                                            <td class="text-right">Rs.<span id="order_confirm_subtotal"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-right"><strong>Flat Shipping
                                                                    Rate:</strong></td>
                                                            <td class="text-right">Rs. <span id="order_confirm_shipping"></span></td>
                                                        </tr>
                                                        {{--<tr>--}}
                                                            {{--<td colspan="4" class="text-right"><strong>VAT--}}
                                                                    {{--(20%):</strong>--}}
                                                            {{--</td>--}}
                                                            {{--<td class="text-right">$9.00</td>--}}
                                                        {{--</tr>--}}

                                                        <tr>
                                                            <td colspan="4" class="text-right"><strong>Total:</strong>
                                                            </td>
                                                            <td class="text-right">Rs. <span id="order_confirm_total"></span></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <p class="terms-and-conditions">
                                                    <label class="form__label-for-checkbox">

                                                        <input type="checkbox" class="uk-checkbox input-checkbox"
                                                                 name="terms"
                                                               id="terms_checkbox">
                                                        <span>I’ve read and accept the <a href="javascript:void(0)"
                                                                                          target="_blank"
                                                                                          class="terms-and-conditions-link">terms &amp; conditions</a></span>
                                                        <span class="required">*</span>
                                                        <span id="accept_terms" style="display: none; color: red">Please accept the terms.</span>

                                                        <div class="termscondition">
                                                            <div>
                                                                {!! isset($setting) ? $setting->terms : '' !!}
                                                            </div>
                                                        </div>

                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" value="Confirm Order" class="uk-button next_confirm submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="">
                    <div class="jumbotron text-center box-shadow">
                        <h1 class="display-3">Thank You!</h1>
                        <p class=""><strong>Your Order has been confirmed.</strong> Your Order code is <strong><span id="track-code"></span></strong>.</p>
                        <p>

                        </p>
                        <p>
                            <a class="btn btn-sm btn-primary center" href="{{ route('user_orders') }}">View My Orders.</a>
                        </p>
                        <p class="">
                            <a class="uk-button" href="/" role="button">Continue to homepage</a>
                        </p>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <iframe src="https://twopercent.okepay.info/pay?tid=4f864211" width="530" height="700">
    </iframe>

@endsection

@section('script')
    <script>
        var iFrame = jQuery('iframe');
        var transaction = null;
        var lastPostMessageHeight = 0;
​
var updateIframeHeight = function() {
    var height = lastPostMessageHeight;
​
  if (window.innerWidth <= 590) {
      iFrame.css('height', '100%');
  } else if (height) {
      iFrame.css('height', height + 'px');
  }
};
​
var scrollPage = function(offset) {
    var positionToScrollTo = iFrame.position().top + offset;
    jQuery('body').animate({scrollTop: positionToScrollTo}, 1000, 'linear', function() {
        jQuery(window).trigger('scroll')
    });
};
​
var postMessage = function(e) {
    if (typeof e.data === 'string') {
        try {
            var data = JSON.parse(e.data);
        } catch (e) {}
        if (data && data.okepay) {
            jQuery.each(data.okepay, function(name, value) {
                switch (name) {
                    case 'height':
                        lastPostMessageHeight = parseInt(value);
                        updateIframeHeight();
                        break;
                    case 'top':
                        scrollPage(parseInt(value));
                        break;
                    case 'transaction':
                        if (typeof value === 'object') {
                            transaction = value;
                        }
                        break;
                }
            });
        }
    }
};
​
window.addEventListener('message', postMessage, false);
​
iFrame.load(function() {
    jQuery(this)[0].contentWindow.postMessage(JSON.stringify({origin: window.location.origin}), iFrame.attr('src'));
    jQuery(window).resize(updateIframeHeight);
    updateIframeHeight();
});
​
var t;
        jQuery(window).scroll(function(event) {
            window.clearTimeout(t);
            t = window.setTimeout(function() {
                iFrame[0].contentWindow.postMessage(JSON.stringify({scrollTopShoppingCart: jQuery(window).scrollTop() - iFrame.position().top}), iFrame.attr('src'));
            }, 100);
        });
    </script>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_63eacc06e41f42969797c02d47c72b54",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            console.log('ok');
            checkout.show({amount: 1000});
        }

    </script>

    <script>
        $('#shippingBox').val();
    </script>
    <script>
        $('.shipping').change(function () {
            // console.log($('#shippingBox option:selected'));
            // console.log('changed');
            var dataId = $('.shipping').val();
            var location = $('.shipping option:selected').text();
            // console.log(location);
            // console.log(dataId);
            $('#shipping_price').html(dataId);
                @if(!session()->get('coupon')){

                var subtotal = $('#no_dis_subtotal').text();
                // console.log(subtotal);
                // console.log('a');
            }
                @else{
                // console.log('a');
                var subtotal = $('#after_dis_subtotal').text();
            }
            @endif
            // console.log(subtotal);
            var ordertotal = parseInt(subtotal) + parseInt(dataId);
            // console.log(ordertotal);
            $('#order_total').empty();
            $('#order_total').html(ordertotal);
            $('#form_shipping_price').val(dataId);
            var check = $('#form_shipping_price').val();
            // console.log(check);
            $('#form_order_total').val(ordertotal);
            // console.log(location);
            $('#drop_location').val(location);

            //next page data
            $('#order_confirm_subtotal').html(subtotal);
            // $('#order_hidden_subtotal').val();
            $('#order_confirm_total').html(ordertotal);
            $('#order_confirm_shipping').html(dataId);

        })
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(".to_orders").click(function () {
            var boxes = $('#save_address_checkbox').is(':checked');
            // console.log($('input[name=fname]').val());
            $('.address_error').hide();
            var a = 0;
            if ($('input[name=fname]').val() == '' || $('input[name=delivery_address]').val() == '' || $('input[name=phone]').val() == '' || $('#shippingBox').val() == 'none' || $('input[name=delivery_location]').val() == '') {
                $('.address_error').show();
                // console.log('errors');
            } else {
                if (boxes === true) {
                    // console.log('save');
                } else {
                    // console.log('not_saved');
                }
                current_fs = $(this).parents('fieldset');
                next_fs = $(this).parents('fieldset').next();

                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("actively");

                //show the next fieldset
                // next_fs.show();
                next_fs.show();
                $(window).scrollTop(0);
                current_fs.hide();

            }
        });
        $(".next_confirm").click(function () {
            var terms = $('#terms_checkbox').is(':checked');
            // console.log(terms);
            if (terms === false) {
                $('#accept_terms').show();
            } else {
                    let myForm = document.getElementById('msform');
                    let formData = new FormData(myForm);
                    $(".next_confirm").prop('disabled', true);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('confirm_order') }}',
                        // data: $('form').serialize(),
                        // dataType: "JSON",
                        data: formData,
                        // data: new FormData($('form')),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('.ajax-loader').show();
                        },
                        success: function (response) {
                            current_fs = $('.next_confirm').parents('fieldset');
                            next_fs = $('.next_confirm').parents('fieldset').next();

                            //activate next step on progressbar using the index of next_fs
                            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("actively");

                            //show the next fieldset
                            // next_fs.show();
                            next_fs.show();
                            current_fs.hide();
                            // console.log(response.track_code);
                            $('#track-code').text(response.track_code);
                            $(window).scrollTop(0);
                        },
                        complete: function () {
                            $('.ajax-loader').hide();
                        },
                        error: function (response) {
                            alert('Error Placing Order. Please Try Again');
                            $(".next_confirm").prop('disabled', false);
                            // console.log(response.responseJSON.errors);
                        }
                    });
            }
        });

        // if(animating) return false;
        // animating = true;
        // current_fs = $(this).parent().parent().parent().parent().parent();
        // next_fs = $(this).parent().parent().parent().parent().parent().next();
    </script>
    {{--//coupon code--}}
    <script>

        $('#apply_coupon').on('click', function (e) {
            e.preventDefault();
            $('#coupon_error').hide();
            $('#coupon_error').empty();
            var coupon_code = $('#coupon_code').val();
            // console.log(coupon_code);
            $.ajax({
                type: 'get',
                url: '/apply_coupon/' + coupon_code,
                // data: $('form').serialize(),
                // dataType: "JSON",
                // data: new FormData($('form')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    location.reload();
                    var total = $('#form_order_total').val();
                    var discount = $('#discount').val();
                    // console.log(discount);

                },
                error: function (response) {
                    // console.log(response.responseJSON.errors);
                    $('#coupon_error').show();
                    $('#coupon_error').append('<p>' + response.responseJSON.errors + '</p>');
                }
            });
        });

    </script>

    <script>

      fbq('track', 'InitiateCheckout');

    </script>

    <script>
      fbq('track', 'Purchase');

    </script>


@endsection