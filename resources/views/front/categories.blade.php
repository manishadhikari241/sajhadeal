@extends('front.master_front')
@section('title','E-commerce | ' . $category_title)

@section('content')

    <section id="category-filter" class=" our_product">
        <div class="container-fluid">
            <section class="breadcrumbs ">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="#">{{ isset($category_title) ? $category_title : '' }}</a></li>
                    <!--<li><span>Active</span></li>-->
                </ul>
            </section>
            @if (isset($cat) && $cat->category_image != null)
                <section id="top-banner">
                    <div class="main-slider">
                        <div class="banner owl-carousel">
                            <div class="slider-images relative owl-theme" style="max-height: 450px">
                                <a href="#">
                                    <img src="{{asset('images/category/'.$cat->category_image)}}" alt=""
                                         class="img-responsive"
                                         style="height: 160px;" width="100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <br>
            <div class="row">
                <div class=" col-lg-2 col-md-3 col-sm-12  ">
                    <aside class="left__side mb mt-3">

                        <ul uk-accordion>
                            <li class="">
                                <a class="uk-accordion-title category_page" href="#"><h5>Category</h5></a>
                                <div class="uk-accordion-content">
                                    <div class="scrollbar   mCustomScrollbar">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li class="category-list">
                                                    <a class="link-category" style="color: black; font-weight: bolder"
                                                       href="{{ route('filter',$category->slug) }}">{{$category->title}}</a>
                                                    <ul>
                                                        @foreach($category->children as $child)
                                                            <li><a href="{{route('filter',$child->slug)}}"
                                                                   class="submenuhead"
                                                                   style=" color: black">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp-{{ $child->title }}</a>
                                                                @if($child->children)
                                                                    <ul>
                                                                        @foreach($child->children as $grandchild)
                                                                            <li>
                                                                                <a href="{{route('filter',$grandchild->slug)}}">
                                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-{{$grandchild->title}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif

                                                            </li>
                                                        @endforeach

                                                    </ul>


                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <a class="uk-accordion-title category_page" href="#"><h5> Price</h5></a>
                                <div class="uk-accordion-content">
                                    <div class="price-list ">
                                        {{--<form action="{{ url()->current() }}" method="get">--}}
                                        {{--<p>--}}
                                        {{--<input type="hidden" class="uk-range" id="max" name="max" value="">--}}
                                        {{--<input type="hidden" id="min" name="min" value="">--}}
                                        {{--</p>--}}
                                        {{--<p id="amount" ></p>--}}
                                        {{--<div id="slider-range"></div>--}}
                                        {{--</form>--}}
                                        <form action="{{ url()->current() }}" method="get">
                                            <p>
                                                <input type="hidden" id="max" name="max" value="">
                                                <input type="hidden" id="min" name="min" value="">
                                            </p>
                                            <p id="amount" class="uk-badge mb-2" style="background-color: #d52770;"></p>
                                            {{--<input id="min" type="hidden" value="2" min="100" max="100000" step="1"--}}
                                            {{--oninput="document.getElementById('rangeValue').innerHTML = this.value">--}}
                                            {{--<input type="hidden" id="max" name="max" value="">--}}
                                            <div id="slider-range"></div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            {{--@if(!empty($brands))--}}
                            {{--<li class="uk-open">--}}
                            {{--<a class="uk-accordion-title" href="#"><h5> Brand</h5></a>--}}
                            {{--<div class="uk-accordion-content brand__filter">--}}
                            {{--<form>--}}
                            {{--@foreach($brands as $brand)--}}
                            {{--<label><input type="checkbox" class=" uk-checkbox item_filter brand"--}}
                            {{--value="{{ $brand->slug }}"> {{$brand->title}}</label>--}}
                            {{--@endforeach--}}


                            {{--</form>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--@endif--}}
                            @if(!empty($sizes))
                                <li class="">
                                    <a class="uk-accordion-title category_page" href="#"><h5> Size</h5></a>
                                    <div class="uk-accordion-content brand__filter">
                                        <form>
                                            @foreach($sizes as $size)
                                                <label><input class="uk-checkbox item_filter size" name="sizes"
                                                              type="radio" value="{{$size->id}}"> {{$size->title}}
                                                </label>
                                            @endforeach

                                        </form>
                                    </div>
                                </li>
                            @endif
                        </ul>


                    </aside>

                </div>
                <div class=" col-lg-9 col-md-9 ">

                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="Name__of__category mt-2">
                            <div class="heading d-flex flex-wrap">
                                <h1>{{ isset($category_title) ? $category_title : '' }}</h1><span class="text-muted">@if(isset($products))
                                        (showing 1-@if($products->count() >= '16')
                                            16 @else {{ $products->count() }} @endif
                                        products)@else (No products) @endif</span>
                            </div>

                        </div>
                        <div class="product_sort_by ">
                            <div class="d-flex align-items-center">
                                <div class="heading">
                                    <h3>Sort by:</h3>

                                </div>

                                <div class="dropdown sort-dropdown">
                                    {{--<form action="{{ Request::fullUrl()}}" method="get">--}}
                                    <select name="sort" id="sort" class="item_filter form-control">
                                        <option selected>Sort By</option>
                                        <option class="item_filter" value="popular">Popular Items</option>
                                        <option class="item_filter" value="new">Newest Items</option>
                                        <option class="item_filter" value="old">Oldest Items</option>
                                        <option class="item_filter" value="a-z">Alphabetical: A to Z</option>
                                        <option class="item_filter" value="z-a">Alphabetical: Z to A</option>
                                        <option class="item_filter" value="low-high">Price: Low to High</option>
                                        <option class="item_filter" value="high-low">Price: High to Low</option>
                                    </select>
                                    {{--</form>--}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>

                    <div id="productData">
                        <div class="latest-section flex-wrap justify-content-center mb-5">
                            <div class="row justify-content-between">
                                @if($products->count()==0)
                                    <span class="center">No Products To Show.</span>
                                @endif
                                @foreach($products as $product)
                                        <div class="card resize_card">

                                            <div class="card-body p-0">

                                                @if(isset(request()->route()->parameters['slug'])&& request()->route()->parameters['slug']=='sale')
                                                    <span class="product-label discount">-{{round(($product->price-$product->sale_price)/$product->price*100,2)  }}
                                                        %</span>
                                                @elseif($product->on_sale==1)
                                                    <span class="product-label discount">-{{round(($product->price-$product->sale_price)/$product->price*100,2)  }}
                                                        %</span>
                                                @endif
                                                <figure>

                                                    @foreach($product->images as $image)
                                                        @if($image->is_main==1)
                                                            <a href="{{route('view_details',$product->slug)}}"><img
                                                                        src="{{ asset($image->image) }}"
                                                                        alt="{{ $product->title }}"></a>
                                                        @endif
                                                    @endforeach

                                                </figure>
                                            </div>

                                            <div class="card-footer">
                                                <div class="special-product_name">
                                                    <a href="{{route('view_details',$product->slug)}}">
                                                        <span>{{ $product->title }}</span></a>
                                                </div>
                                                <div class="special-product_price">
                                                    <div class="text-left"><span>Rs.</span><span>
                                                    @if($product->valid_special_price()==1)
                                                                {{ $product->sale_price }}
                                                            @else
                                                                {{ $product->price }}
                                                            @endif</span>
                                                    </div>
                                                    <div class="text-right"></div>

                                                </div>
                                                <div class="buttons">
                                                    <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                                        <span><i class="icofont-basket"></i></span>

                                                        <span>Add to cart</span> </a>
                                                    <a href="{{route('postWishlist',$product->id)}}"
                                                       class="add-to-wishlist">
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


                    <div>
                        {{ $products->setPath(Request::url())->render() }}

                    </div>
                    @if(isset($cat) && $cat->description != null)
                        <hr>
                        <div>
                            <p class="text-muted">About {{ $cat->title }}: {{ $cat->description }}</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </section>


@endsection
@section('script')

    <script>
        {{--$(document).ready(function () {--}}
        {{--@foreach($categories as $category)--}}
        {{--$("#cat{{$category->id}}").click(function () {--}}
        {{--var cat= $("#cat{{$category->id}}").val();--}}
        {{--var price=$("#rangeValue").val();--}}

        {{--$.ajax({--}}
        {{--type: 'get',--}}
        {{--dataType: 'html',--}}
        {{--url: '{{url('/productCat')}}',--}}
        {{--data: {cat_id:cat, price_range:price},--}}
        {{--success:function (response) {--}}
        {{--console.log(response);--}}
        {{--$('#productData').html(response);--}}
        {{--}--}}
        {{--})--}}
        {{--});--}}
        {{--@endforeach--}}
        {{--});--}}

        $(function () {
            $('.item_filter').click(function () {
                // $('#productData').html('<div id="loaderpro" style="" ></div>');
                brand = multiple_values('brand');
                size = multiple_values('size');
                $.ajax({
                    url: document.URL,
                    type: 'get',
                    data: {
                        brand: brand,
                        size: size,
                        sort: $("#sort").val(),
                        maxprice: $("#max").val(),
                        minprice: $("#min").val()
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });

        });

        function multiple_values(inputclass) {
            var val = new Array();
            $("." + inputclass + ":checked").each(function () {
                val.push($(this).val());
            });
            return val;
        }

        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 100,
                max: 50000,
                values: [0, 50000],
                slide: function (event, ui) {
                    $("#amount").html("Rs: " + ui.values[0].toLocaleString() + " - " + "Rs: " + ui.values[1].toLocaleString());
                    $("#min").val(ui.values[0]);
                    $("#max").val(ui.values[1]);

                    // $('.product-data').html('<div id="loaderpro" style="" ></div>');
                    brand = multiple_values('brand');
                    size = multiple_values('size');
                    $.ajax({
                        url: document.URL,
                        type: 'get',
                        data: {
                            brand: brand,
                            size: size,
                            sort: $("#sort").val(),
                            maxprice: $("#max").val(),
                            minprice: $("#min").val()
                        },
                        success: function (result) {
                            $('#productData').replaceWith($('#productData').html(result));
                        }
                    });
                }
            });
            $("#amount").html("Rs: " + $("#slider-range").slider("values", 0).toLocaleString() +
                " - Rs: " + $("#slider-range").slider("values", 1).toLocaleString());
        });


    </script>


@endsection