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
                            Shopping cart
                        </h1>
                        <!-- BREADCRUMBS -->
                        <ul class="breadcrumbs list-inline pull-right">
                            <li><a href="index-2.html">Home</a></li><!--
                        -->
                            <li><a href="03-shop-products.html">Shop</a></li><!--
                        -->
                            <li>Shopping cart</li>
                        </ul>
                        <!-- !BREADCRUMBS -->
                    </div>
                </header>
            </div>
        </div><!-- !full-width -->
        <div class="container">
            <!-- !FULL WIDTH -->
            <!-- !SECTION EMPHASIS 1 -->

            <section class="row">
                <div class="col-xs-12">
                    <div class="table table-responsive cart-summary">
                        <table>
                            <thead>
                            <tr>
                                <td colspan="2">Product</td>
                                <td class="width16">Options</td>
                                <td class="width16">Quantity</td>
                                <td class="text-right">Subtotal</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)

                                <tr>
                                    <td>
                                        <a href="#">
                                            <img style="max-height: 300px; max-width: 300px; display:inline-block;"
                                                 src="{{asset($product->attributes['image'])}}" alt="Shop item">
                                        </a>
                                    </td>
                                    <td>
                                        <h4><a href="#">{{$product->name}}</a></h4>
                                        <br>
                                        <span class="price">Rs. {{$product->price}}</span>
                                        <br><br>
                                        <a href="#">Add to wishlist</a>
                                        <br>
                                        <a href="/remove_from_cart/{{$product->id}}">Remove</a>
                                    </td>
                                    <td>
                                        <p class="features">
                                            Color: <strong>{{$product->attributes['color']}}</strong><br>
                                            Size: <strong>{{$product->attributes['size']}}</strong>
                                        </p>
                                        <a href="/edit_cart/{{$product->id}}">Edit</a>
                                    </td>
                                    <td>
                                        {{$product->quantity}}
                                    </td>

                                    <td>
                                        <strong>Rs. {{$product->sub_total}}</strong>
                                    </td>


                                </tr>

                            </tbody>
                            @endforeach
                            @if(\Cart::session(Sentinel::getUser()->id)->getContent()->first())

                                @if(!(session()->has('coupon')))
                                    <form action="/verify_coupon" method="post" novalidate>
                                        {{csrf_field()}}
                                        <div class="col-sm-6 col-md-4 form-inline">
                                            <div class="form-group">
                                                <label>If you have a Discount Coupon, Enter here</label>
                                                <input type="text" name="coupon_code" class="form-control"
                                                       id="promo-code"
                                                       required
                                                       placeholder="Enter Coupon code">
                                            </div><!--
-->
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-small">Apply</button>
                                        </div>
                                    </form>
                                @endif


                                <br>

                                <form action="/checkout" method="post">
                                    {{csrf_field()}}
                                    <div class="col-sm-6 col-md-4 col-md-offset-4 ">
                                        <div class="table">
                                            <table class="price-calc">

                                                <tbody>


                                                <section class="order-summary element-emphasis-weak"
                                                         style="background-color: white;">
                                                    <h3 class="strong-header element-header pull-left">
                                                        Total Amount(without Shipping Cost)
                                                    </h3>
                                                    <dl class="order-summary-price">
                                                        <dt><br></dt>
                                                        <dd><br></dd>
                                                        <dt>Subtotal</dt>
                                                        <dd>
                                                            <strong>Rs. {{ \Cart::session(Sentinel::getUser()->id)->getSubTotal() }}</strong>
                                                        </dd>

                                                        @if(session()->has('coupon'))
                                                            <dt>
                                                                <hr>
                                                            </dt>

                                                            <dd>
                                                                <hr>
                                                            </dd>
                                                            <dt><strong><label for="">Applying Discount
                                                                        Coupon</label></strong></dt>

                                                            <dd><br></dd>
                                                            <dd><br></dd>
                                                            <dt>
                                                                Discount ({{session()->get('coupon')['name']}})

                                                                <a href="/remove_coupon" type="submit"
                                                                   class="btn btn-primary btn-small"
                                                                   style="display:inline;font-size:9px; ">Remove</a>
                                                            </dt>





                                                            <dd>
                                                                - Rs. {{$discount}}
                                                            </dd>
                                                            <dt>New SubTotal</dt>
                                                            <dd>Rs. {{$newsubtotal}}</dd>

                                                        @endif

                                                        <dt class="total-price">Total Sum</dt>
                                                        <dd class="total-price"><strong>Rs. {{$newtotal}}</strong></dd>
                                                    </dl>
                                                </section>


                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-xs-12">
                                        <a href="/product_list" type="button" class="btn btn-default pull-left">Continue
                                            shopping</a>

                                        <input type="hidden" name="newtotal" value="{{$newtotal}}">
                                        <input type="hidden" name="newsubtotal" value="{{$newsubtotal}}">


                                        <button type="submit" class="btn btn-primary pull-right">Proceed to
                                            checkout
                                        </button>
                                    </div>
                                </form>
                            @endif

                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>

@endsection
