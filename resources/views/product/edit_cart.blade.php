@extends('front.master_front')

@section('content')



    {{--PRODUCT IMAGES--}}
    <div class="container" style="background-color:#f2f2f2;">
        <div class="col-md-6 space-right-20">

            @foreach($product->images as $image)
                @if($image->is_main==1)
                    <img style="min-height:250px;max-width:350px; min-width:320px; " src="{{asset($image->image)}}">
                @endif
            @endforeach


        </div>


        {{--PRODUCT DETAILS--}}
        <div class="container col-md-6 space-left-20" style="background-color:white;">
            <header>
                <span class="rating" data-score="3.5"></span>
                <a href="#reviews">2 reviews</a>
                <a href="#reviews">Write a review</a>
                <br>
                <h1>
                    {{ $product->title }}
                </h1>
                <span class="product-code">Product Code: {{ $product->sku }}</span><br><br>
                <span class="price-old" style="text-decoration: line-through ;">Rs.{{ $product->sale_price }}</span>
                <strong><span class="price">Rs. {{ $product->price }}</span></strong><br><br>
            </header>
            <form role="form" class="shop-form form-horizontal"
                  action="/store_edit_cart/{{$product->id}}" method="post" novalidate>
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-xs-2" for="color">Color</label>

                    <div class="col-xs-5">
                        <select name="color" class="chosen chosen-select-searchless" id="color" data-placeholder=" ">
                            @foreach($product->colors as $color)
                                <option value="{{$color->id}}">{{$color->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2" for="size">Size</label>

                    <div class="col-xs-5">
                        <select name="size" class="chosen chosen-select-searchless" id="size" data-placeholder=" ">
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
                        <input name="quantity" type="number" class="form-control spinner-quantity" id="quantity" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add to cart</button>
                <!--
                                          -->
                <button type="button" class="btn btn-default">Add to wishlist</button>
                <div class="clearfix"></div>
            </form>


            {{--//share product--}}
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
                            <a href="https://twitter.com/share?text=CreateIT&amp;url=http://www.createit.pl"
                               onclick="window.open(this.href, 'twitter-share', 'width=550,height=235'); return false;"
                               rel="nofollow" title=" Share on Twitter" class="tw">
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
                            <a href="https://www.pinterest.com/pin/create/button/?url=http://www.createit.pl/&amp;media=http://www.createit.pl/images/frontend/logo.png&amp;description=CreateIT"
                               onclick="window.open(this.href, 'pinterest-share', 'width=770,height=320'); return false;"
                               rel="nofollow" title="Pinterest" class="pt">
                                <span class="sr-only">Pinterest</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http://developer.linkedin.com&amp;title=LinkedIn%20Developer%20Network&amp;summary=My%20favorite%20developer%20program&amp;source=LinkedIn"
                               onclick="window.open(this.href, 'linkedin-share', 'width=600,height=439'); return false;"
                               rel="nofollow" title="LinkedIn" class="in">
                                <span class="sr-only">LinkedIn</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                    <li><a href="#info" data-toggle="tab">Additional info</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews (2)</a></li>
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
                        <article class="review">
                            <header>
                                <span class="rating" data-score="4"></span><br>
                                <h4 class="author">Richard Doe</h4>
                                <span class="date">Aug 7, 2013</span>
                            </header>
                            <p>
                                Choupette Mulberry dark red lipstick crop button up chunky sole chambray shirt
                                maxi skirt vintage Levi shorts. Loafers 90s collar indigo denim silver collar
                                round sunglasses. Cashmere skirt peach Miu Miu Bag 'N' Noun leather shorts
                                oversized printed clashing patterns. Tulle printed jacket sheer Prada Saffiano
                                white Converse.
                            </p>
                        </article>
                        <article class="review">
                            <header>
                                <span class="rating" data-score="3"></span><br>
                                <h4 class="author">Richard Doe</h4>
                                <span class="date">Aug 3, 2013</span>
                            </header>
                            <p>
                                Leather jacket pastels backpack neutral green white. Strong eyebrows washed out
                                Chanel. leggings skinny jeans Missoni capsule clutch cotton.
                            </p>
                        </article>
                        <form class="review-form">
                            <label class="raty-label">
                                Your rating for this item<br>
                                <span class="rate"></span>
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
    </div>
@endsection