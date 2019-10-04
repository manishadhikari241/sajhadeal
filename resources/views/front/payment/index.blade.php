@extends('front.master_front')
@section('title','SajhaDeals')

@section('content')

    <section id="top-banner">
        <div class="main-slider">
            <div class="banner owl-carousel ">
                @foreach($backgrounds as $back)
                    @if($back->status ==1 && $back->background==1)
                            <div class="slider-images relative owl-theme" style="max-height: 450px">
                                <a href="{{$back->link}}">
                                    <img src="{{  asset($back->logo) }}" alt="gadgets" class="img-responsive" width="100%">
                                </a>
                            </div>
                    @endif
                @endforeach
            </div>

        </div>

    </section>


    <section class="grid-section">
        <!-- special section -->
        <div class="container mb-5">
            <!-- title of special section -->
            <div class="grid-section--title">
                <div class="heading center">
                    <h2>Wardrobe</h2>
                </div>
                <hr>
            </div>
            <!-- body of the special section -->
            <div class="row">
                @foreach($special_by_category as $special)
                <div class="col">
                    <div class="">
                        <a href="/filter/{{ $special->category_name }}" class="col-card" >
                            <figure class="position-relative">
                                <img
                                        alt="" class=" lazyloaded"
                                        src="{{ asset($special->image) }}"
                                        title=""
                                        data-src="{{asset($special->image)}}">
                                <div class="overlay"></div>
                            </figure>

                            <div class="d-flex align-items-center flex-column mt-2 pb-2">
                                <h3  style="border-bottom:1px solid rgba(0,0,0,0.2)">{{ $special->category->title }}</h3>

                                <span>View more</span>
                            </div>

                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end of the special section -->

        <!-- ads -->
        <section class="mb free-ads">
            <div class="container-fluid">
                <div class="row ">
                    <div class=""><a href=""><img src="https://img.ltwebstatic.com/images2_pi/2019/01/28/1548653280948203773.jpg" alt=""></a></div>
                </div>
            </div>
        </section>






















        <!-- /ADS -->

        <!-- new arrival section -->
        <div class="container mt-3">
            <!-- title of the New Arrivals -->
            <div class="grid-section--title">
                <div class="heading center">
                    <h2>New Arrivals</h2>
                </div>
                <hr>
            </div>
            <!-- body of the New arrival section -->
            <div class="row">
                @foreach($backgrounds as $back)
                    @if($back->status ==1)
                        @if($back->background == 2)
                            <div class="col-md-6">
                                <div class="new_arrival-img">
                                    <a href="{{ route('filter','new_arrival') }}"><img src="{{  asset($back->logo) }}" alt=""></a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="center pt-4">
                <a href="{{route('slug_filter','new_arrival')}}" class="view-more">
                    View more <i class="fas fa-chevron-right"></i>
                </a>
            </div>

        </div>


        <!-- end of the new arrival section -->
    </section>


    @if($item!=NULL)
    <div class="latest-section mb-5">
        <div class="container">
            <div class="grid-section--title">
                <div class="heading center">
                    <h2>Latest</h2>
                </div>
                <hr>
            </div>
            <div class="row mb-3">

                <div class="latest-slider owl-carousel ">
                    @foreach($latests as $product)
                    <div class="card">
                        <div class="card-body p-0">
                            <figure><a href="{{route('view_details',$product->id)}}">
                                    @foreach($product->images as $image)

                                        @if($image->is_main==1)

                                            <img src="{{asset($image->image)}}" alt="Shop item">
                                        @endif
                                    @endforeach
                                </a></figure>
                        </div>
                        <div class="card-footer">
                            <div class="special-product_name">
                                <a href="{{route('view_details',$product->id)}}">
                                    <span>{{$product->title}}</span></a>
                            </div>
                            <div class="special-product_price">
                                <div class="text-left"><span>Rs.</span><span>
                                         @if($product->valid_special_price()==1)
                                            {{ $product->sale_price }}
                                        @else
                                            {{ $product->price }}
                                        @endif
                                    </span></div>
                                <div class="text-right"></div>

                            </div>
                            <div class="buttons">
                                <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                    <span><i class="icofont-basket"></i></span>

                                    <span>Add to cart</span> </a>
                                <a href="{{route('postWishlist',$product->id)}}" class="add-to-wishlist">
                                <span><i class="icofont-heart-alt"
                                         uk-tooltip="title: Wishlist; pos: left"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    @endif
    <!-- our product -->
    <section class="our_product">
        <div class="container">
            <ul class="nav nav-tabs " id="our_tab" role="tablist">
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link active" id="latest-tab" data-toggle="tab" href="#Latest" role="tab"--}}
                       {{--aria-controls="home" aria-selected="true">Latest</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link active" id="featured-tab" data-toggle="tab" href="#Featured" role="tab"
                       aria-controls="profile" aria-selected="false">Featured</a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" id="best_seller-tab" data-toggle="tab" href="#Best_Seller" role="tab"--}}
                       {{--aria-controls="contact" aria-selected="false">Best Seller</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" id="special-tab" data-toggle="tab" href="#Special" role="tab"
                       aria-controls="contact" aria-selected="false">Special</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="most_viewed-tab" data-toggle="tab" href="#Most_Viewed" role="tab"
                       aria-controls="contact" aria-selected="false">Most Viewed</a>
                </li>
            </ul>
            <div class="tab-content" id="our_tab_Content">
                <div class="tab-pane fade active show in " id="Featured" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="rows">
                        <div class="latest-section our_product--tabs slick-slide owl-carousel">
                            {{--latest products--}}
                            @foreach($products as $product)
                                @if($product->featured == 1)
                                    <div class="card">
                                    <div class="card-body p-0">
                                        <figure><a href="{{route('view_details',$product->id)}}">
                                                <img src="{{asset($product->get_main_image($product->id))}}" alt="Shop item">
                                            </a></figure>
                                    </div>
                                    <div class="card-footer">
                                        <div class="special-product_name">
                                            <a href="{{route('view_details',$product->id)}}">
                                                <span>{{$product->title}}</span></a>
                                        </div>
                                        <div class="special-product_price">
                                            <div class="text-left"><span>Rs.</span><span>
                                                    @if($product->valid_special_price()==1)
                                                        {{ $product->sale_price }}
                                                    @else
                                                        {{ $product->price }}
                                                    @endif
                                    </span></div>
                                            <div class="text-right"></div>

                                        </div>
                                        <div class="buttons">
                                            <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                                <span><i class="icofont-basket"></i></span>

                                                <span>Add to cart</span> </a>
                                            <a href="{{route('postWishlist',$product->id)}}" class="add-to-wishlist">
                                <span><i class="icofont-heart-alt"
                                         uk-tooltip="title: Wishlist; pos: left"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="center pt-5">
                            <a href="{{ route('slug_filter','featured') }}" class="view-more">
                                view more...
                            </a>
                        </div>
                    </div>
                </div>
                {{--<div class="tab-pane fade " id="Best_Seller" role="tabpanel" aria-labelledby="contact-tab">--}}
                    {{--<div class="rows">--}}
                        {{--<div class="latest-section our_product--tabs slick-slide owl-carousel">--}}
                            {{--best seller--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body p-0">--}}
                                    {{--<figure><a href="singlepage.html"><img src="https://img.ltwebstatic.com/images/pi/201803/42/15202432289509135704_thumbnail_405x552.webp" alt=""></a></figure>--}}
                                {{--</div>--}}
                                {{--<div class="card-footer">--}}
                                    {{--<div class="special-product_name">--}}
                                        {{--<a href="">--}}
                                            {{--<span>Corduroy Double Breasted Skirt</span></a>--}}
                                    {{--</div>--}}
                                    {{--<div class="special-product_price">--}}
                                        {{--<div class="text-left"><span>$</span><span>9.5</span></div>--}}
                                        {{--<div class="text-right"></div>--}}

                                    {{--</div>--}}
                                    {{--<div class="buttons">--}}
                                        {{--<a href="" class="add_to_cart ">--}}
                                            {{--<span><i class="icofont-basket"></i></span>--}}

                                            {{--<span>Add to cart</span> </a>--}}
                                        {{--<a href="" class="add-to-wishlist">--}}
                            {{--<span><i class="icofont-heart-alt"--}}
                                     {{--uk-tooltip="title: Wishlist; pos: left"></i></span>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="center pt-5">--}}
                            {{--<a href="{{ route('filter','best_seller') }}" class="view-more">--}}
                                {{--view more...--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="tab-pane fade " id="Special" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="rows">
                        <div class="latest-section our_product--tabs slick-slide owl-carousel">
                            {{--sale products--}}
                            @foreach($specials as $product)
                                <div class="card">
                                    <div class="card-body p-0">
                                        <figure><a href="{{route('view_details',$product->id)}}">
                                                @foreach($product->images as $image)

                                                    @if($image->is_main==1)

                                                        <img src="{{asset($image->image)}}" alt="Shop item">
                                                    @endif
                                                @endforeach
                                            </a></figure>
                                    </div>
                                    <div class="card-footer">
                                        <div class="special-product_name">
                                            <a href="{{route('view_details',$product->id)}}">
                                                <span>{{$product->title}}</span></a>
                                        </div>
                                        <div class="special-product_price">
                                            <div class="text-left"><span>Rs.</span><span>
                                                    @if($product->valid_special_price()==1)
                                                        {{ $product->sale_price }}
                                                    @else
                                                        {{ $product->price }}
                                                    @endif
                                    </span></div>
                                            <div class="text-right"></div>

                                        </div>
                                        <div class="buttons">
                                            <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                                <span><i class="icofont-basket"></i></span>

                                                <span>Add to cart</span> </a>
                                            <a href="{{route('postWishlist',$product->id)}}" class="add-to-wishlist">
                                <span><i class="icofont-heart-alt"
                                         uk-tooltip="title: Wishlist; pos: left"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="center pt-5">
                            <a href="{{ route('slug_filter','sale') }}" class="view-more">
                                view more...
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="Most_Viewed" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="rows">
                        <div class="latest-section our_product--tabs slick-slide owl-carousel">
                            {{--most viewed--}}
                            @foreach($most_viewed as $product)
                                <div class="card">
                                    <div class="card-body p-0">
                                        <figure><a href="{{route('view_details',$product->id)}}">
                                                @foreach($product->images as $image)

                                                    @if($image->is_main==1)

                                                        <img src="{{asset($image->image)}}" alt="Shop item">
                                                    @endif
                                                @endforeach
                                            </a></figure>
                                    </div>
                                    <div class="card-footer">
                                        <div class="special-product_name">
                                            <a href="{{route('view_details',$product->id)}}">
                                                <span>{{$product->title}}</span></a>
                                        </div>
                                        <div class="special-product_price">
                                            <div class="text-left"><span>Rs.</span><span>
                                                    @if($product->valid_special_price()==1)
                                                        {{ $product->sale_price }}
                                                    @else
                                                        {{ $product->price }}
                                                    @endif
                                    </span></div>
                                            <div class="text-right"></div>

                                        </div>
                                        <div class="buttons">
                                            <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                                <span><i class="icofont-basket"></i></span>

                                                <span>Add to cart</span> </a>
                                            <a href="{{route('postWishlist',$product->id)}}" class="add-to-wishlist">
                                <span><i class="icofont-heart-alt"
                                         uk-tooltip="title: Wishlist; pos: left"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="center pt-5">
                            <a href="{{ route('slug_filter',['id' => 'most_viewed']) }}" class="view-more">
                                view more...
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>


    @endsection
