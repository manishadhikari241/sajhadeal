@extends('front.master_front')
@section('content')

    <section id="Content" role="main">
        <div class="container">

            <!-- SECTION EMPHASIS 1 -->
            <!-- FULL WIDTH -->
        </div><!-- !container -->
        <div class="full-width section-emphasis-1 page-header">
            <div class="container">
                <header class="row">
                    <div class="col-md-12">
                        <h1 class="strong-header pull-left">
                            Order received
                        </h1>
                        <!-- BREADCRUMBS -->
                        <ul class="breadcrumbs list-inline pull-right">
                            <li><a href="index.html">Home</a></li><!--
                          -->
                            <li><a href="03-shop-products.html">Shop</a></li><!--
                          -->
                            <li>Order received</li>
                        </ul>
                        <!-- !BREADCRUMBS -->
                    </div>
                </header>
            </div>
        </div><!-- !full-width -->


        <div class="container">
            <!-- !FULL WIDTH -->
            <!-- !SECTION EMPHASIS 1 -->

            <div class="row">
                <section class="col-sm-6 col-md-5">
                    <h3>
                        Your order has been received, thanks!<br><br>
                    </h3>

                    <p>
                        Order number: <strong>{{$order->id}}</strong><br>
                        Order Date: <strong>{{$order->order_date}}</strong><br>
                        Shipping Date: <strong>{{$order->shipping_date}}</strong><br>
                        Total: Rs. <strong>{{$order->total_price}}</strong><br>
                        Payment method: <strong>Direct bank transfer</strong>
                    </p>
                    <p>
                        Make your payment directly into our bank account. Please use your Order ID as the payment
                        reference.
                        Your order will not be shipped until the funds have cleared in our account.
                    </p>
                    <hr>

                    <h2 class="strong-header element-header pull-left">
                        Billing address
                    </h2>

                    <div class="clearfix"></div>
                    <p>
                        {{ \Sentinel::getUser()->fname}} {{\Sentinel::getUser()->lname}}<br>
                        {{$address->address}}<br>
                        {{$address->country}}<br>
                    </p>
                    <hr>
                    <h4 class="strong-header">
                        Contact information
                    </h4>
                    <p>
                        {{\Sentinel::getUser()->email}} <br>
                        {{$address->mobile}}
                    </p>
                    <hr>
                    <h2 class="strong-header element-header pull-left">
                        2. Shipping address
                    </h2>

                    <div class="clearfix"></div>
                    <p>
                        {{$order->full_name}}<br>
                        {{$address->address}}<br>
                        {{$address->country}}<br>

                    </p>
                </section>
                <div class="clearfix visible-xs space-30"></div>
                <aside class="col-sm-6 col-md-7">
                    <img src="{{asset('shop/images/demo-content/order-received-image.jpg')}}" alt="Other shop items">
                    <div class="space-30"></div>
                    <a href="/product_list" class="btn btn-default">Continue shopping</a>
                </aside>
            </div>

        </div>
    </section>

    <div class="clearfix visible-xs visible-sm"></div> <!-- fixes floating problems when mobile menu is visible -->


@endsection