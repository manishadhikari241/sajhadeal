@extends('front.master_front')

@section('content')

    <section id="Content" role="main">

        <div class="container">

            <!-- SECTION EMPHASIS 1 -->
            <!-- FULL WIDTH -->
        </div>
        <!-- !container -->
        <div class="full-width section-emphasis-1 page-header page-header-short">
            <div class="container">
                <header class="row">
                    <div class="col-md-12">
                        <!-- BREADCRUMBS -->
                        <ul class="breadcrumbs list-inline pull-right">
                            <li><a href="{{'/index'}}">Home</a></li>
                            <!--
                                                          -->
                            <li><a href="{{'/product_list'}}">Shop</a></li>
                            <!--
                                                          -->

                            <li>Individual Product</li>
                        </ul>
                        <!-- !BREADCRUMBS -->
                    </div>
                </header>
            </div>
        </div>
        <div class="container">
            <!-- !FULL WIDTH -->
            <!-- !SECTION EMPHASIS 1 -->

            <article class="row shop-product-single">
                <div class="col-md-6 space-right-20">

                    <!-- thumbnailSlider -->
                    <div class="thumbnailSlider">
                        <div class="flexslider flexslider-thumbnails">
                            <ul class="slides">
                                @foreach($product->images as $image)
                                    <li>
                                        <a href="{{asset($image->image)}}" data-rel="prettyPhotoGallery[product]">
                                            <img src="{{asset($image->image)}}" alt=" ">
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        <ul class="smallThumbnails clearfix">
                            @php
                            $count=0;
                            foreach($product->images as $image){
                            @endphp
                            <li data-target="{{$count}}" class="active">
                                <img src="{{asset($image->image)}}" alt=" ">
                            </li>
                           @php
                           $count=$count+1;
                           }
                            @endphp

                        </ul>
                    </div>
                    <!-- / thumbnailSlider -->

                </div>


                <div class="clearfix visible-sm visible-xs space-30"></div>
                <div class="col-md-6 space-left-20">

                    <header>
                        <div id="hearts" class="starrr" style="font-size: 20px; display: inline-block" data-rating='{{$star}}'>

                        </div>

                        <a href="#reviews">{{$counts}} reviews</a>

                        <a href="#reviews">Write a review</a>

                        <h1>
                            {{ $product->title }}
                        </h1>
                        <span class="product-code">Product Code: <strong style="font-size: 18px">{{ $product->sku }}</strong></span><br><br>
                        <span class="price-old">Rs.{{ $product->price }}</span>&nbsp;&nbsp;<span class="price">Rs.{{ $product->sale_price }}</span>
                    </header>
                    <form role="form" class="shop-form form-horizontal" action="/buy_product/{{$product->id}}" method="post" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="col-xs-2" for="color">Color</label>

                            <div class="col-xs-5">
                                <select class="chosen chosen-select-searchless" id="color" name="color" data-placeholder=" ">
                                    @foreach($product->colors as $color)
                                        <option value="{{$color->id}}">{{$color->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2" for="size">Size</label>

                            <div class="col-xs-5">
                                <select class="chosen chosen-select-searchless" name="size" id="size" data-placeholder=" ">
                                    @foreach($product->sizes as $size)
                                        <option value="{{$size->id}}">{{$size->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <a href="#SizeGuide" class="size-guide-toggle">Size guide</a>
                            </div>
                            <div class="clearfix visible-xs visible-sm"></div>
                        </div>
                        <div class="size-guide-wrapper form-group visible-xs visible-sm">
                            <div class="col-xs-12">
                                <div id="SizeGuide">
                                    <div class="table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <td></td>
                                                <td>XXS</td>
                                                <td>XS</td>
                                                <td>S</td>
                                                <td>M</td>
                                                <td>L</td>
                                                <td>XL</td>
                                                <td>XXL</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Bust</th>
                                                <td>78</td>
                                                <td>82</td>
                                                <td>86</td>
                                                <td>90</td>
                                                <td>96</td>
                                                <td>103</td>
                                                <td>110</td>
                                            </tr>
                                            <tr>
                                                <th>Waist</th>
                                                <td>60</td>
                                                <td>64</td>
                                                <td>68</td>
                                                <td>72</td>
                                                <td>78</td>
                                                <td>85</td>
                                                <td>92</td>
                                            </tr>
                                            <tr>
                                                <th>Hips</th>
                                                <td>86</td>
                                                <td>90</td>
                                                <td>94</td>
                                                <td>98</td>
                                                <td>104</td>
                                                <td>111</td>
                                                <td>118</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2" for="quantity">Qty</label>

                            <div class="col-xs-2">
                                <input class="form-control spinner-quantity" name="quantity" id="quantity" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                        <!--
                                                  -->
                        <button type="button" class="btn btn-default"><a href="{{route('postWishlist',$product->id)}}" style="text-decoration: none;"> Add to wishlist</a></button>
                        <div class="clearfix"></div>
                    </form>
                    <div class="shop-product-single-social">
                        <span class="social-label pull-left">Share this product</span>

                        <div class="social-widget social-widget-mini social-widget-dark">
                            <ul class="list-inline">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.createit.pl"
                                       onclick="window.open(this.href, 'facebook-share','width=580,height=296'); return false;"
                                       rel="nofollow"
                                       title="Facebook"
                                       class="fb">
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/share?text=CreateIT&amp;url=http://www.createit.pl" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235'); return false;" rel="nofollow" title=" Share on Twitter" class="tw">
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://plus.google.com/share?url=http://www.createit.pl"
                                       onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530'); return false;"
                                       rel="nofollow"
                                       title="Google+"
                                       class="gp">
                                        <span class="sr-only">Google+</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.pinterest.com/pin/create/button/?url=http://www.createit.pl/&amp;media=http://www.createit.pl/images/frontend/logo.png&amp;description=CreateIT" onclick="window.open(this.href, 'pinterest-share', 'width=770,height=320'); return false;" rel="nofollow" title="Pinterest" class="pt">
                                        <span class="sr-only">Pinterest</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http://developer.linkedin.com&amp;title=LinkedIn%20Developer%20Network&amp;summary=My%20favorite%20developer%20program&amp;source=LinkedIn" onclick="window.open(this.href, 'linkedin-share', 'width=600,height=439'); return false;" rel="nofollow" title="LinkedIn" class="in">
                                        <span class="sr-only">LinkedIn</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#info" data-toggle="tab">Additional info</a></li>
                            <li><a href="#reviews" data-toggle="tab">Reviews ({{$counts}})</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="description">
                                <p>
                                    {{ $product->short_description }}
                                </p>
                                <p>
                                    {{$product->long_description}}
                                </p>
                                <ul>
                                    @foreach($product->features as $feature)

                                        <li>{{ $feature->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="info">
                                <div class="table table-condensed">
                                    <table>
                                        <tbody>
                                        @foreach($product->specifications as $specification)
                                            <tr>
                                                <th class="weak width25">{{ $specification->title }}</th>
                                                <td>{{$specification->specification}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <section class="tab-pane fade" id="reviews">
@foreach($reviews as $review)
                                <article class="review">
                                    <header>
                                        <div id="hearts" class="starrr" data-rating='{{$review->star}}'></div>
                                        <h4 class="author">{{$review->user->first_name.' '.$review->user->last_name}}</h4>
                                        <span class="date">{{$review->created_date}}</span>
                                    </header>
                                    <p>
                                        {{$review->review}}
                                    </p>
                                </article>
                                @endforeach

                                <form class="review-form" method="post" action="{{route('review')}}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <label class="raty-label">
                                        Your rating for this item<br>

                                    <div class="lead">
                                        <div id="hearts-existing" class="starrr" data-rating='4'></div>
                                        You gave a rating of <span id="count-existing">4</span> hearts.
                                        <input type="hidden" name="star" value="4">
                                    </div>
                                    </label>

                                    <div class="form-group">
                                        <label for="review">Your review</label>
                                        <textarea class="form-control" id="review" name="review" rows="6"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit review</button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>




@endsection
@section('script')
    <script>
        // Starrr plugin (https://github.com/dobtco/starrr)
        var __slice = [].slice;

        (function($, window) {
            var Starrr;

            Starrr = (function() {
                Starrr.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function(e, value) {}
                };

                function Starrr($el, options) {
                    var i, _, _ref,
                        _this = this;

                    this.options = $.extend({}, this.defaults, options);
                    this.$el = $el;
                    _ref = this.defaults;
                    for (i in _ref) {
                        _ = _ref[i];
                        if (this.$el.data(i) != null) {
                            this.options[i] = this.$el.data(i);
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on('mouseover.starrr', 'i', function(e) {
                        return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                    });
                    this.$el.on('mouseout.starrr', function() {
                        return _this.syncRating();
                    });
                    this.$el.on('click.starrr', 'i', function(e) {
                        return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                    });
                    this.$el.on('starrr:change', this.options.change);
                }

                Starrr.prototype.createStars = function() {
                    var _i, _ref, _results;

                    _results = [];
                    for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                        _results.push(this.$el.append("<i class='fas fa-heart-broken'></i>"));
                    }
                    return _results;
                };

                Starrr.prototype.setRating = function(rating) {
                    if (this.options.rating === rating) {
                        rating = void 0;
                    }
                    this.options.rating = rating;
                    this.syncRating();
                    return this.$el.trigger('starrr:change', rating);
                };

                Starrr.prototype.syncRating = function(rating) {
                    var i, _i, _j, _ref;

                    rating || (rating = this.options.rating);
                    if (rating) {
                        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                            this.$el.find('i').eq(i).removeClass('fa-heart-broken').addClass('fa-heart');
                        }
                    }
                    if (rating && rating < 5) {
                        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                            this.$el.find('i').eq(i).removeClass('fa-heart').addClass('fa-heart-broken');
                        }
                    }
                    if (!rating) {
                        return this.$el.find('i').removeClass('fa-heart').addClass('fa-heart-broken');
                    }
                };

                return Starrr;

            })();
            return $.fn.extend({
                starrr: function() {
                    var args, option;

                    option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function() {
                        var data;

                        data = $(this).data('star-rating');
                        if (!data) {
                            $(this).data('star-rating', (data = new Starrr($(this), option)));
                        }
                        if (typeof option === 'string') {
                            return data[option].apply(data, args);
                        }
                    });
                }
            });
        })(window.jQuery, window);

        $(function() {
            return $(".starrr").starrr();
        });

        $( document ).ready(function() {

            $('#hearts-existing').on('starrr:change', function(e, value){
                $('#count-existing').html(value);
                $('input[name="star"]').val(value);
            });
        });
    </script>
    @endsection