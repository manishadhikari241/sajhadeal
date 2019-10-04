@extends('front.master_front')
@section('title','SajhaDeals| '.$product->title)
@section('content')

    <section id="single_page">
        <div class="container">
            <div class="mt-3">
                <section class="breadcrumbs ">
                    <ul class="uk-breadcrumb">
                        {{--<li><a href="{{ route('index') }}">Home</a></li>--}}
                        {{--@if($product->category->first()->parent->parent)--}}
                        {{--<li>--}}
                        {{--<a href="{{ route('filter',$product->category->first()->parent->parent->slug) }}">{{ $product->first()->parent->parent->title }}</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        {{--@if($product->category->first()->parent)--}}
                        {{--<li>--}}
                        {{--<a href="{{ route('filter',$product->category->first()->parent->slug) }}">{{ $product->category->first()->parent->title }}</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        <li>
                            <a href="{{ route('filter',$product->category->first()->slug) }}">{{ $product->category->first()->title }}</a>
                        </li>
                        <li><h1>{{ $product->title }}</h1></li>
                    </ul>
                </section>
            </div>
            <div class="row">

                <div class="col-lg-6 col-sm-5">
                    <div class="xzoom-container d-flex flex-row-reverse " style="z-index: 980;">
                        <!-- Main image, on which xzoom will be applied -->

                        <div class="default__zoom">
                            <div class="image__zoom">
                                @foreach($product->images as $image)
                                    @if($image->is_main==1)
                                        <img class="xzoom" id="xzoom-fancy" src="{{asset($image->image)}}"
                                             xoriginal="{{asset($image->image)}}" height="350px"
                                             alt="{{$product->title}}">
                                    @endif
                                @endforeach
                            </div>

                        </div>
                        <!-- Thumbnails -->
                        <div class="xzoom-thumbs flex-column justify-content-start">
                            @foreach($product->images as $image)
                                <a href="{{asset($image->image)}}" class="mb-1">
                                    <img class="xzoom-gallery"
                                         src="{{asset($image->image)}} "
                                         xpreview="{{asset($image->image)}} " alt="{{$product->title}}">
                                </a>
                            @endforeach
                            @if($product->video)
                                <a href="#" class="mb-1" id="show_video" class="">
                                    @php
                                        $video_id = explode("?v=", $product->video);
                                        $video_id = $video_id[1];
                                        $thumbnail="http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
                                    @endphp
                                    <img class="" src="{{ $thumbnail }}" alt="{{$product->title}}">
                                    {{--<div id="ytvthumb"></div>--}}
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-sm-7">
                    <div class="product_short_info">
                        <div class="heading">
                            <h3> {{ $product->title }}</h3>
                        </div>
                        <div class="product-sku">
                            <span>SKU: {{ $product->sku }}</span>

                        </div>
                        <div class="product_short_info-price">
                            @if($product->valid_special_price()==1)
                                <span class="discount-price">
        Rs.{{$product->price}}
    </span>
                                <span class="actual-price text-muted">
        Rs.{{ $product->sale_price }}
    </span>
                            @else
                                <span class="actual-price text-muted">
            Rs. {{ $product->price }}
            </span>
                            @endif
                        </div>
                        <hr>

                        @if($product->size_variation == 0 && $product->stock_quantity<=0)
                            Out of stock
                        @elseif($product->size_variation == 1 && $product->stocks->where('stock','>','0')->count() == 0)
                            Out of stock
                        @else
                            <div class="availability"> Availability:
                                <span class="stock-availability">
                                            <span id="demo"></span>
                                     <span class="stock in-stock" style="color: #00a65a">
                                         @if($product->size_variation == 1)
                                             <span id="color_stock"></span>
                                         @else
                                             {{ $product->stock_quantity }}
                                         @endif

                                         In Stock</span>
                                </span>
                            </div>
                            <form role="form" action="/buy_product/{{$product->id}}" method="post">
                                @csrf
                                @if($product->colors->count()>0)
                                    <div class="product_meta meta-color">
                                        <div class="pro-title mb-2">Color</div>
                                        @foreach($product->colors as $color)
                                            <input type="radio" id="radio{{$color->id}}" name="radColor" checked>
                                            <label for="radio{{ $color->id }}" class="custom-radio">
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                                @if($product->sizes->count()>0)
                                    <div class="product_meta meta-size">
                                        <div class="pro-title mb-2">Size</div>
                                        @foreach($product->stocks as $stock)
                                            @if($stock->stock != 0)
                                                <input type="radio" id="radioSize{{$stock->size->id}}" name="radSize"
                                                       value="{{ $stock->size->id }}" checked>
                                                <label for="radioSize{{$stock->size->id}}"
                                                       class="custom-radio">{{ $stock->size->title }}</label>

                                                <input type="hidden"
                                                       id="stock_id{{ $stock->size->id }}"
                                                       value="{{ $stock->stock }}">

                                            @endif
                                        @endforeach
                                        {{--@foreach($product->stocks as $stock)--}}
                                        {{--@if($stock->stock != 0)--}}
                                        {{--<input type="radio" id="radioSize{{$stock->size->id}}" name="radSize"--}}
                                        {{--checked value="{{ $stock->size->id }}">--}}
                                        {{--<label for="radioSize{{$stock->size->id}}"--}}
                                        {{--class="custom-radio">{{ $stock->size->title }}</label>--}}
                                        {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{----}}
                                        {{--<input type="radio" id="radioSize2" name="radSize">--}}
                                        {{--<label for="radioSize2" class="custom-radio">S</label>--}}
                                        {{--<input type="radio" id="radioSize3" name="radSize">--}}
                                        {{--<label for="radioSize3" class="custom-radio">M</label>--}}
                                    </div>
                                @endif

                                <div class="product_short_info-quantity">
                                    <label for="quantity">Quantity</label>
                                    <input id="quantity" type="number" name="quantity" value="1" min="1"
                                           max="{{$product->stock_quantity}}" required>
                                </div>

                                <div class="product_short_info-buttons">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="btn_add-to-cart">
                                            <button id="add_cart" type="submit" name="buy_now" value="0"
                                                    class="uk-button ">Add to Cart
                                            </button>
                                        </div>
                                        <div class=" btn_add-to-wishlist">
                                            <button class=" uk-button" type="submit" name="buy_now" value="1">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <hr>


                    </div>
                </div>

            </div>

            <!--<div class="ads" style="">-->
            <!--    <figure>-->
            <!--        <img src="images/ads1.png" alt="">-->
            <!--    </figure>-->
            <!--</div>-->
            @if(isset($product->video))
                @php
                    $video_id = explode("?v=", $product->video);
                    $video_id = $video_id[1];
                @endphp
                <div style="border: #0c0c0c" class="center">
                    <iframe class="border-info" id="video" style="display: none; padding-bottom: 30px" width="560"
                            height="315"
                            src="https://www.youtube.com/embed/{{$video_id}}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-tour-tabs ">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-description" role="tab" data-toggle="tab"
                                   aria-expanded="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#tab-sizefit" role="tab" data-toggle="tab"
                                   aria-expanded="false">Features and Specifications</a>
                            </li>
                            {{--<li class="nav-item">--}}
                            {{--<a class="nav-link " href="#tab-delivery" role="tab" data-toggle="tab"--}}
                            {{--aria-expanded="false">Delivery</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                            {{--<a class="nav-link " href="#tab-return" role="tab" data-toggle="tab"--}}
                            {{--aria-expanded="false">Return Policy</a>--}}
                            {{--</li>--}}

                            <li class="nav-item">
                                <a class="nav-link  " href="#tab-reviews" role="tab" data-toggle="tab"
                                   aria-expanded="false">Reviews ({{$product->reviews->count()}})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active description " id="tab-description">
                                <h3>Product Description</h3>
                                <p><strong>{!! $product->short_description !!}</strong></p>
                                <br>
                                <p>
                                    {!! $product->long_description !!}
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade itinerary_tab " id="tab-sizefit">
                                <div>
                                    @if($product->features->count()>0)
                                        <h4>Features:</h4>
                                        <ul>
                                            @foreach($product->features as $feature)
                                                <li>{{ $feature->title }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    @if($product->specifications->count()>0)
                                        <h4>Specifications:</h4>
                                        <ul>
                                            @foreach($product->specifications as $spec)
                                                <li>{{ $spec->title }}&nbsp;:&nbsp;{{ $spec->specification }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            {{--<div role="tabpanel" class="tab-pane fade itinerary_tab " id="tab-delivery">--}}
                            {{--<div>--}}

                            {{--<p>Free Delivery On Orders Over Rs.1000</p>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div role="tabpanel" class="tab-pane fade itinerary_tab " id="tab-return">--}}
                            {{--<div>--}}

                            {{--<p>Our Guarantee</p>--}}
                            {{--<p>Return or exchange within 30 days from the delivered date.</p>--}}

                            {{--Request:--}}
                            {{--<ul>--}}
                            {{--<li>1. Items received within 30 days from the delivered date.</li>--}}
                            {{--<li>2. Items received unused, undamaged and in original package.</li>--}}
                            {{--<li>3. Return shipping fee is paid by buyer.</li>--}}
                            {{--</ul>--}}


                            {{--</div>--}}
                            {{--</div>--}}

                            <div role="tabpanel" class="tab-pane fade  reviews " id="tab-reviews">
                                <form action="{{ route('post_add_review') }}" method="post">
                                    @csrf
                                    <div class="">

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group">
                                            <label for="">
                                                Name
                                            </label>
                                            <input type="text" name="name" placeholder="Your Name" class="form-control"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                Email
                                            </label>
                                            <input type="email" name="email" placeholder="Your Name"
                                                   class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <span class="review--heading">Add review</span>
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="rating" value="5"><label
                                                        class="full"
                                                        for="star5"
                                                        title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4"><label
                                                        class="full"
                                                        for="star4"
                                                        title="Pretty good - 4 stars"></label>

                                                <input type="radio" id="star3" name="rating" value="3"><label
                                                        class="full"
                                                        for="star3"
                                                        title="Meh - 3 stars"></label>

                                                <input type="radio" id="star2" name="rating" value="2"><label
                                                        class="full"
                                                        for="star2"
                                                        title="Kinda bad - 2 stars"></label>

                                                <input type="radio" id="star1" name="rating" value="1"><label
                                                        class="full"
                                                        for="star1"
                                                        title="Sucks big time - 1 star"></label>

                                            </fieldset>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <label for="comment">write something</label>
                                    <textarea name="review" type="text" class="form-control" id="comment"
                                              placeholder="write something" rows="3" cols="100">
</textarea>
                                    <button class="uk-button checkout float-right mt-1 " href=""> comment</button>
                                    <div class="clearfix"></div>
                                </form>
                                <div class="clearfix"></div>
                                @php $count=0; foreach($product->reviews as $review){ $count=$count+$review->star; }@endphp
                                <p class="review-user">@if($product->reviews->count() > 0){{ $count/$product->reviews->count() }} @else
                                        0 @endif average based on {{ $product->reviews->count() }} reviews.</p>
                                <hr style="border:3px solid #f1f1f1; width:70%">
                                <div class="row review-rating">
                                    <div class="side">
                                        <div>5 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-5"
                                                 style="width: {{ \App\Review::get_percent('5',$product->id) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{--<div>150</div>--}}
                                    </div>
                                    <div class="side">
                                        <div>4 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-4"
                                                 style="width: {{ \App\Review::get_percent('4',$product->id) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{--<div>63</div>--}}
                                    </div>
                                    <div class="side">
                                        <div>3 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-3"
                                                 style="width: {{ \App\Review::get_percent('3',$product->id) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{--<div>15</div>--}}
                                    </div>
                                    <div class="side">
                                        <div>2 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-2"
                                                 style="width: {{ \App\Review::get_percent('2',$product->id) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{--<div>6</div>--}}
                                    </div>
                                    <div class="side">
                                        <div>1 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-1"
                                                 style="width: {{ \App\Review::get_percent('1',$product->id) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{--<div>20</div>--}}
                                    </div>
                                </div>
                                @if($product->reviews->where('status', 'Approve')->count() > 0)
                                    <div class="review-container">
                                        <h3 class="review-title">Reviews</h3>
                                        @foreach($product->reviews->where('status', 'Approve') as $review)
                                            <article class="reviews" style="display: block;">
                                                <figure class="user-image">
                                                    <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                         alt="{{$review->name}}">
                                                </figure>
                                                <div class="review-right">
                                                    <span class="username">{{$review->name}}</span>&nbsp;<span
                                                            class="published">{{explode(' ', $review->created_at)[0]}}</span>&nbsp;&nbsp;<span>@php for($i=1;$i<=$review->star; $i++){ @endphp
                                                        <span
                                                                class="fa fa-star checked"></span>@php } @endphp</span>
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </article>
                                        @endforeach
                                        {{--<article class="reviews" style="display: block;">--}}
                                        {{--<figure class="user-image">--}}
                                        {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                        {{--alt="">--}}
                                        {{--</figure>--}}
                                        {{--<div class="review-right">--}}
                                        {{--<span class="username"> Jhon Deo</span>&nbsp;<span class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                        {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs designing--}}
                                        {{--to place a dumy text</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                        {{--</article>--}}
                                        {{--<article class="reviews" style="display: block;">--}}
                                        {{--<figure class="user-image">--}}
                                        {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                        {{--alt="">--}}
                                        {{--</figure>--}}
                                        {{--<div class="review-right">--}}
                                        {{--<span class="username"> Jhon Deo</span>&nbsp;<span class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                        {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs designing--}}
                                        {{--to place a dumy text</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                        {{--</article>--}}
                                        {{--<article class="reviews">--}}
                                        {{--<figure class="user-image">--}}
                                        {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                        {{--alt="">--}}
                                        {{--</figure>--}}
                                        {{--<div class="review-right">--}}
                                        {{--<span class="username"> Jhon Deo</span>&nbsp;<span class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                        {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs designing--}}
                                        {{--to place a dumy text</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                        {{--</article>--}}
                                        {{--<article class="reviews">--}}
                                        {{--<figure class="user-image">--}}
                                        {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                        {{--alt="">--}}
                                        {{--</figure>--}}
                                        {{--<div class="review-right">--}}
                                        {{--<span class="username"> Jhon Deo</span>&nbsp;<span class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                        {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs designing--}}
                                        {{--to place a dumy text</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                        {{--</article>--}}


                                        {{--<button class="btn show-more center"> show more</button>--}}
                                        <div class="clearfix"></div>

                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="latest-section mb-5">
                        <div class="container">
                            <div class="grid-section--title">
                                <div class="heading center">
                                    <h2>Related products</h2>
                                </div>
                                <hr>
                            </div>
                            <div class="row mb-3">

                                <div class="latest-slider owl-carousel ">
                                    @php
                                        $related= \App\Product::join('category_product', 'category_product.product_id', '=', 'products.id')
                            ->where('category_product.category_id',$product->category->first()->pivot->category_id)->select('products.*')->distinct()->get();
                                    @endphp
                                    {{$product->category->first()->pivot->category_id}}
                                    @foreach($related as $similar_product)
                                        @if($similar_product->id != $product->id)
                                            <div class="card">
                                                <div class="card-body p-0">
                                                    <figure><a href="{{route('view_details',$similar_product->slug)}}">
                                                            @foreach($similar_product->images as $image)

                                                                @if($image->is_main==1)

                                                                    <img src="{{asset($image->image)}}"
                                                                         alt="{{$similar_product->title}}">
                                                                @endif
                                                            @endforeach
                                                        </a></figure>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="special-product_name">
                                                        <a href="{{route('view_details',$product->slug)}}">
                                                            <span>{{$similar_product->title}}</span></a>
                                                    </div>
                                                    <div class="special-product_price">
                                                        <div class="text-left"><span>Rs.</span><span>
                                @if($similar_product->valid_special_price()==1)
                                                                    {{ $similar_product->sale_price }}
                                                                @else
                                                                    {{ $similar_product->price }}
                                                                @endif
                </span></div>
                                                        <div class="text-right"></div>

                                                    </div>
                                                    <div class="buttons">
                                                        <a href="{{route('add_cart',$similar_product->id)}}"
                                                           class="add_to_cart ">
                                                            <span><i class="icofont-basket"></i></span>

                                                            <span>Add to cart</span> </a>
                                                        <a href="{{route('postWishlist',$similar_product->id)}}"
                                                           class="add-to-wishlist">
            <span><i class="icofont-heart-alt"
                     uk-tooltip="title: Wishlist; pos: left"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


@endsection
@section('script')

    {{--//stock-size display--}}
    <script type="text/javascript">
        $(window).on('load', function () {
            var id = $("input[name='radSize']:checked").val();
            // console.log(id);
            // alert(document.getElementById("stock_id"+id).value);
            document.getElementById('color_stock').innerText = document.getElementById("stock_id" + id).value;
            if (document.getElementById("stock_id" + id).value == 0) {
                $('#add_cart').hide();
            }
            // document.getElementById("max_quantity").value=1;
            $("#quantity").attr({
                "max": document.getElementById("stock_id" + id).value,
                "min": 1,
            });
            document.getElementById("max_quantity").max = document.getElementById("stock_id" + id).value;
            // code here
        });
        $('input[name=radSize]').change(function () {
            var id = $("input[name='radSize']:checked").val();
            // console.log(id);
            // alert(document.getElementById("stock_id"+id).value);
            document.getElementById('color_stock').innerText = document.getElementById("stock_id" + id).value;
            if (document.getElementById("stock_id" + id).value == 0) {
                $('#add_cart').hide();
            }
            // var value = $("#quantity").val();

            // if ((value !== '') && (value.indexOf('.') === -1)) {

            //     $("#quantity").val(Math.max(Math.min(value, 90), -90));
            // }
            $("#quantity").val('1');
            $("#quantity").attr({
                "max": document.getElementById("stock_id" + id).value,
                "min": 1,
            });
            // document.getElementById("max_quantity").value=1;
            document.getElementById("max_quantity").max = document.getElementById("stock_id" + id).value;
        });
    </script>

    {{--video attachment--}}
    <script>
        $('#show_video').on('click', function () {
            $('#video').show();
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#video").offset().top
            }, 1500);
        })
    </script>

    <script>
        autoPlayYouTubeModal();

        //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
        function autoPlayYouTubeModal() {
            var trigger = $("body").find('[data-toggle="modal"]');
            trigger.click(function () {
                var theModal = $(this).data("target"),
                    videoSRC = $(this).attr("data-theVideo"),
                    videoSRCauto = videoSRC + "?autoplay=1";
                $(theModal + ' iframe').attr('src', videoSRCauto);
                $(theModal + ' button.close').click(function () {
                    $(theModal + ' iframe').attr('src', videoSRC);
                });
                $('.modal').click(function () {
                    $(theModal + ' iframe').attr('src', videoSRC);
                });
            });
        }
    </script>
    <script>
        var vidid = "itKE0FulmBA";

        function getYouTubeInfo() {
            $.ajax({
                url: "https://www.googleapis.com/youtube/v3/videos?id=" + vidid + "&key=AIzaSyB9adHBa3d323G8sFeifwISkuOWENfuzik&part=snippet,contentDetails",
                dataType: "jsonp",
                success: function (data) {
                    parseresults(data);
                    console.log(data);
                }
            });
        }

        function parseresults(data) {

            var ytvtitle = data.items[0].snippet.title;
            var ytvdur = data.items[0].contentDetails.duration;
// var ytvurl = 'https://www.youtube.com/watch?v='+vidid;
            var ytvtmb0 = data.items[0].snippet.thumbnails.medium.url;
            console.log(ytvtmb0);
// function youtubeDurationToSeconds(duration) {
//     var hours   = 0;
//     var minutes = 0;
//     var seconds = 0;
//
//     // Remove PT from string ref: https://developers.google.com/youtube/v3/docs/videos#contentDetails.duration
//     duration = duration.replace('PT','');
//
//     // If the string contains hours parse it and remove it from our duration string
//     if (duration.indexOf('H') > -1) {
//         hours_split = duration.split('H');
//         hours       = parseInt(hours_split[0]);
//         duration    = hours_split[1];
//         console.log(hours);
//     }
//
//     // If the string contains minutes parse it and remove it from our duration string
//     if (duration.indexOf('M') > -1) {
//         minutes_split = duration.split('M');
//         minutes       = parseInt(minutes_split[0]);
//         duration      = minutes_split[1];
//     }
//
//     // If the string contains seconds parse it and remove it from our duration string
//     if (duration.indexOf('S') > -1) {
//         seconds_split = duration.split('S');
//         seconds       = parseInt(seconds_split[0]);
//         if(seconds<10){
//             seconds='0'+seconds;
//         }
//     }
//
//     // Math the values to return seconds
//     // return (hours * 60 * 60) + (minutes * 60) + seconds;
//     return hours +':'+ minutes +':' + seconds;
// }
// $('.ytvtitle').html(ytvtitle);
// $('#ytvduration').html(ytvdur + ' Seconds' );
            $('#ytvthumb').html('<img src=\"' + ytvtmb0 + '\"  />');
// $('#ytvurl').html('<a target=\"_blank\" href=\"'+ytvurl+'\">Watch on YouTube</a>');
            $('.mini-newscard img').attr('src', ytvtmb0);
            $('.mini-newscard .cardsvideoduration').html(youtubeDurationToSeconds(ytvdur));
        }


        getYouTubeInfo();


        //banner
        $('.banner--close').click(function () {
            $(this).parent().hide();
        });
    </script>

@endsection
