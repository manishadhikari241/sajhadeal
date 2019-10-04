@extends('front.master_front')
@section('title','Cart')
@section('content')
    <section id="shopping-cart">
        <div class="container box-shadow mt-2 mb">
            <div class="center pt-2">
                <h1>Shopping Cart</h1></div>

      <hr>

            <div class="shopping-cart">

                <div class="column-labels">
                    <label class="product-image text-center">Image</label>
                    <label class="product-details">Product</label>
                    <label class="product-price">Price</label>
                    <label class="product-quantity">Quantity</label>
                    {{--<label class="product-size">Size</label>--}}
                    <label class="product-removal">Remove</label>
                    <label class="product-line-price">Total</label>
                </div>
                <form action="" id="update_cart_form" method="post">
                @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                <div class="product">
                    <div class="product-image">
                        <img  src="{{asset($product->attributes['image'])}}" alt="{{$product->name}}">
                    </div>
                    <div class="product-details">
                        <div class="product-title">{{$product->name}} - ({{ $product->attributes['size'] }})</div>
                        <p class="product-description"> It has a lightweight, breathable mesh upper with forefoot cables for
                            a locked-down fit.</p>
                    </div>
                    <div class="product-price">{{$product->price}}</div>

                        <input type="hidden" name="update[{{$product->id}}]" value="{{$product->id}}">
                    <div class="product-quantity">
                        <input type="number" name="quantity[{{$product->id}}]"  class="form-control quantity" value="{{$product->quantity}}" min="1" max="{{$product->stock_quantity}}">
                    </div>
                    {{--<div class="product-size">--}}
                        {{--{{ $product->size }}--}}
                    {{--</div>--}}

                    <div class="product-removal">
                        <a href="{{ route('delete_cart_item',$product->id)}}" class=" btn btn-danger checkout remove-product ">
                            <i class="icofont-trash"></i>
                        </a>
                    </div>
                    <div class="product-line-price">{{$product->quantity*$product->price}}</div>
                </div>
                @endforeach
                </form>
                <div class="totals">
                    <div class="totals-item">
                        <label>Subtotal</label>
                        <div class="totals-value" id="cart-subtotal">
                            <?php use App\Http\Controllers\CartController;
                            echo CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent()); ?>
                        </div>
                    </div>
                    <div class="totals-item totals-item-total">
                        <label>Grand Total</label>
                        <div class="totals-value" id="cart-total">
                            <?php
                            echo CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent()); ?>
                        </div>
                    </div>
                </div>

                <a class="uk-button view-cart" href="/"> <span uk-icon="icon:chevron-left"></span>Continue Shopping</a>
                <a class="uk-button checkout" id="checkout" href="/cart_checkout" style="display: block">Proceed To Checkout</a>
                <button class="uk-button checkout" id="update_cart"  style="display: none">Update Cart</button>
                <div class="clearfix"></div>




            </div>
        </div>
    </section>


    <section class="mb free-ads">
        <div class="container-fluid">
            <div class="row d-flex flex-nowrap">
                <div class=""><a href=""><img src="images/b1.png" alt=""></a></div>
                <div class=""><a href=""><img src="images/b2.png" alt=""></a></div>
                <div class=""><a href=""><img src="images/b1.png" alt=""></a></div>

            </div>
        </div>
    </section>

    @endsection

@section('script')
    <script>
        $('.quantity').on('input',function () {
            console.log('change');
            $("#checkout").hide();
            $("#update_cart").show();
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $("#update_cart").on('click',function () {
            let myForm = document.getElementById('update_cart_form');
            let formData = new FormData(myForm);

            console.log(formData);
            $.ajax({
                type: 'post',
                url: '{{ route('post_update_cart') }}',
                // data: $('form').serialize(),
                // dataType: "JSON",
                data: formData,
                // data: new FormData($('form')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // $(".shopping-cart").load(" .shopping-cart");
                    // $("#checkout").show();
                    // $("#update_cart").hide();
                    // alert('Cart Updated');
                    window.location = '/view_cart';
                },
                error: function (response) {
                    alert('Update failed');
                }
            });
        });
    </script>
    
    <script>

      fbq('track', 'AddToCart');
    
    </script>
@endsection