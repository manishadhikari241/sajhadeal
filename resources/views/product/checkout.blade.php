@extends('front.master_front')
@section('content')
    <div style="background-color: white;">
        <div class="clearfix space-30" style="background-color: white;"></div>
        <div class="col-sm-5 col-sm-push-7 space-left-30" style="background-color: white;">

            <section class="order-summary element-emphasis-weak" style="background-color: white;">
                <h3 class="strong-header element-header pull-left">
                    Order summary
                </h3>
                <a href="/view_cart" class="pull-right">
                    Edit cart
                </a>
                <div class="clearfix" style="background-color: white;"></div>
                <!-- SHOP SUMMARY ITEM -->
                @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                    <article class="shop-summary-item">
                        <img style="max-height: 100px;max-width: 100px;display: block;"
                             src="{{asset($product->attributes['image'])}}" alt="Shop item in cart">
                        <header class="item-info-name-features-price">
                            <h4><a href="#">{{$product->name}}</a></h4>
                            <span class="features">{{$product->attributes['color']}}, {{$product->attributes['size']}}</span><br>
                            <span class="quantity">{{$product->quantity}}</span><b>&times; Rs. </b><span
                                    class="price">{{$product->price}}</span>
                            <label for="" style="display: inline;">= Rs. {{$product->sub_total}}</label>
                        </header>
                    </article>
                @endforeach

                <dl class="order-summary-price">
                    @if(session()->has('coupon'))
                        <dt>Subtotal(with Coupon {{session()->get('coupon')['name']}})</dt>
                        <dd><strong>Rs. {{ $newsubtotal }}</strong></dd>
                    @else(session()->has('coupon')=="")
                        <dt>Subtotal(without Coupon)</dt>
                        <dd><strong>Rs. {{ $newsubtotal }}</strong></dd>
                    @endif

                    {{--<dt>Shipping ({{ $delivery_method }} delivery)</dt>--}}
                    {{--                    <dd>Rs. {{$shipping_cost}}</dd>--}}
                    <dt class="total-price">Order total</dt>
                    <dd class="total-price"><strong>Rs. {{ $newtotal }}</strong></dd>
                </dl>
            </section>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="clearfix visible-xs space-30"></div>
        <div class="col-sm-7 col-sm-pull-5" style="background-color: white;">


            <form action="/place_order" method="post">
                {{csrf_field()}}
                <div class="col-sm-6 col-md-4 col-md-offset-4 ">

                </div>

                <section
                        class="checkout checkout-step-3 checkout-step-current element-emphasis-strong clearfix">
                    <h2 class="strong-header element-header">
                        Delivery methods
                    </h2>

                    <div class="form-group">
                        <input type="radio" name="delivery_method"
                               value="economy">
                       Economy Delivery
                    </div>
                    <span class="help-block">
                                        Delivered within 3 days of order placed.
                                        Rs. 50 Delivery Charge.
                                     </span>

                    <div class="form-group">
                        <input type="radio" name="delivery_method"
                               value="premium">
                        Premium Delivery
                    </div>
                    <span class="help-block">
                                        Delivered within 1 day of order placed.
                                        Rs. 100 Delivery Charge.
                    </span>




                    <div class="clearfix"></div>
                </section>
                <section class="checkout checkout-step-3 checkout-step-current element-emphasis-strong clearfix">
                    <h2 class="strong-header element-header">
                        Shipping Info
                    </h2>
                    <div class="table">
                        <table class="price-calc">

                            <tbody>

                            <td class="text-right">
                                <button type="button" class="btn btn-link shipment-calc-toggle">
                                    Calculate
                                </button>
                            </td>


                            <tr class="shipment-calc">
                                <td colspan="2">
                                    <div class="form-group">
                                        <label for="" class="sr-only">Enter your Full Name</label>
                                        <input type="text" class="form-control" name="full_name"
                                               id="postal-code" required
                                               placeholder="Enter your Full Name">


                                        <label for="" class="sr-only">Enter your Address</label>
                                        <input type="text" class="form-control" name="address"
                                               id="postal-code" required
                                               placeholder="Enter your Address">


                                        <label for="postal-code" class="sr-only">Mobile Number</label>
                                        <input type="text" name="mobile" class="form-control"
                                               id="postal-code" required
                                               placeholder="Mobile Number eg: 98********">


                                    </div>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                </section>

                <section class="checkout checkout-step-3 checkout-step-current element-emphasis-strong clearfix">
                    <h2 class="strong-header element-header">
                        3. Payment methods
                    </h2>

                    <div class="form-group">
                        <input type="radio" name="payment-methods" class="large sr-only" id="direct-bank-transfer"
                               value="esewa">
                        <label for="direct-bank-transfer">Esewa</label>
                    </div>
                    <span class="help-block">
                                  Make your payment directly into our esewa account. Please use your Order ID as the payment
                                  reference. Your order will not be shipped until the funds have cleared in our esewa account.
                              </span>
                    <div class="form-group">
                        <input type="radio" name="payment-methods" class="large sr-only" id="cheque-payment"
                               value="Cash On Delivery" checked>
                        <label for="cheque-payment">Cash On Delivery</label>
                    </div>

                    @if(session()->has('coupon'))
                        <input type="hidden" name="newtotal" value="{{$newtotal}}">
                        <input type="hidden" name="newsubtotal" value="{{$newsubtotal}}">

                    @endif
                    @if(session()->has('coupon')=="")
                        <input type="hidden" name="newtotal" value="{{$newtotal}}">
                        <input type="hidden" name="newsubtotal"
                               value="{{ \Cart::session(Sentinel::getUser()->id)->getSubTotal() }}">

                    @endif
                    <button type="submit" class="btn btn-primary pull-right">Place order</button>
                    <div class="clearfix"></div>
                </section>
            </form>


        </div>

    </div>
@endsection
