@extends('front.master_front')
@section('content')


    <!-- SHOP FEATURED ITEM -->





    <section id="Content" role="main">
        <div class="container">

            <!-- SECTION EMPHASIS 1 -->
            <!-- FULL WIDTH -->
        </div>
        <!-- !container -->
        <div class="full-width section-emphasis-1 page-header">
            <div class="container">
                <header class="row">
                    <div class="col-md-12">
                        <h1 class="strong-header pull-left">Shop</h1>

                        <!-- BREADCRUMBS -->
                        <ul class="breadcrumbs list-inline pull-right">
                            <li><a href="/index">Home</a></li>
                            <!--
                                           -->
                            <li>Shop</li>
                        </ul>
                        <!-- !BREADCRUMBS -->
                    </div>
                </header>
            </div>
        </div>
        <!-- !full-width -->
        <div class="container">
            <!-- !FULL WIDTH -->
            <!-- !SECTION EMPHASIS 1 -->

            <div class="row">
                <form>
                    <div class="shop-list-filters col-sm-4 col-md-3">

                        <div class="filters-active element-emphasis-strong" style="display:none;">
                            <h3 class="strong-header element-header" style="display:none;">
                                You've selected
                            </h3>
                            <!-- dynamic added selected filters -->
                            <ul class="filters-list list-unstyled">
                                <li></li>
                            </ul>
                            <button type="button" class="filters-clear btn btn-primary btn-small btn-block">
                                Clear all
                            </button>
                        </div>

                        <button type="button" class="btn btn-default btn-small visible-xs"
                                data-texthidden="Hide Filters" data-textvisible="Show Filters"
                                id="toggleListFilters"></button>

                        <div id="listFilters">

                            <div class="filters-details element-emphasis-weak">
                                <!-- ACCORDION -->
                                <div class="accordion">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="strong-header panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                       href="#collapse-001">
                                                        Price range
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-001" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="filters-range" data-min="10" data-max="60000"
                                                         data-step="5">
                                                        <div class="filter-widget"></div>
                                                        <div class="filter-value">
                                                            <input type="text" class="min">
                                                            <input type="text" class="max">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="strong-header panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                       href="#collapse-002">
                                                        Categories
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-002" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="filters-checkboxes myFilters"
                                                         data-option-group="category" data-option-type="filter">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-categories-all">
                                                            <label for="filters-categories-all" data-option-value=""
                                                                   class="selected isotopeFilter">All</label>
                                                        </div>
                                                        @foreach($categories as $category)
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-categories-accessories">
                                                            <label for="filters-categories-accessories"
                                                                   data-option-value=".{{$category->title}}" class="isotopeFilter">{{$category->title}}</label>
                                                        </div>
                                                        @endforeach
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-categories-bags_and_purses">
                                                            <label for="filters-categories-bags_and_purses"
                                                                   data-option-value=".cat2" class="isotopeFilter">Bagsdd
                                                                & Purses</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-categories-dresses">
                                                            <label for="filters-categories-dresses"
                                                                   data-option-value=".cat3" class="isotopeFilter">Dresses</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-categories-hoodies_and_sweatshirts">
                                                            <label for="filters-categories-hoodies_and_sweatshirts"
                                                                   data-option-value=".cat4" class="isotopeFilter">Hoodies
                                                                & Sweatshirts</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="strong-header panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                       href="#collapse-003">
                                                        Size
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-003" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="filters-size myFilters" data-option-group="size"
                                                         data-option-type="filter">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-size-all">
                                                            <label for="filters-size-all" data-option-value=""
                                                                   class="selected isotopeFilter"><abbr
                                                                        title="All">All</abbr></label>
                                                        </div>
                                                        @foreach($sizes as $size)
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only" id="filters-size-s">
                                                            <label for="filters-size-s" data-option-value=".{{$size->title}}"
                                                                   class="isotopeFilter"><abbr
                                                                        title="Small">{{$size->title}}</abbr></label>
                                                        </div>
                                                        @endforeach
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only" id="filters-size-m">
                                                            <label for="filters-size-m" data-option-value=".size2"
                                                                   class="isotopeFilter"><abbr
                                                                        title="Medium">M</abbr></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only" id="filters-size-l">
                                                            <label for="filters-size-l" data-option-value=".size3"
                                                                   class="isotopeFilter"><abbr
                                                                        title="Large">L</abbr></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only" id="filters-size-xl">
                                                            <label for="filters-size-xl" data-option-value=".size4"
                                                                   class="isotopeFilter"><abbr
                                                                        title="Extra Large">XL</abbr></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="strong-header panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                       href="#collapse-004">
                                                        Color
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-004" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="filters-color myFilters" data-option-group="color"
                                                         data-option-type="filter">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-color-all">
                                                            <label for="filters-color-all" data-option-value=""
                                                                   class="selected isotopeFilter"><span
                                                                        class="filters-color-swatch"
                                                                        style="background: transparent">All</span></label>
                                                        </div>
                                                        @foreach($colors as $color)
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="{{$color->title}}">
                                                            <input type="checkbox" class="sr-only" id="filters-color-1">
                                                            <label for="filters-color-1" data-option-value=".{{$color->title}}"
                                                                   class="isotopeFilter">{{$color->title}}<span
                                                                        class="filters-color-swatch"
                                                                        style="background: {{$color->title}}"></span></label>
                                                        </div>
                                                        @endforeach
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Grey">
                                                            <input type="checkbox" class="sr-only" id="filters-color-2">
                                                            <label for="filters-color-2" data-option-value=".color2"
                                                                   class="isotopeFilter">Grey<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #999999"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="White">
                                                            <input type="checkbox" class="sr-only" id="filters-color-3">
                                                            <label for="filters-color-3" data-option-value=".color3"
                                                                   class="isotopeFilter">White<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #ffffff"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Orange">
                                                            <input type="checkbox" class="sr-only" id="filters-color-4">
                                                            <label for="filters-color-4" data-option-value=".color4"
                                                                   class="isotopeFilter">Orange<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #e47139"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Red">
                                                            <input type="checkbox" class="sr-only" id="filters-color-5">
                                                            <label for="filters-color-5" data-option-value=".color5"
                                                                   class="isotopeFilter">Red<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #d93d3d"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Pink">
                                                            <input type="checkbox" class="sr-only" id="filters-color-6">
                                                            <label for="filters-color-6" data-option-value=".color6"
                                                                   class="isotopeFilter">Pink<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #f26d7d"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Purple">
                                                            <input type="checkbox" class="sr-only" id="filters-color-7">
                                                            <label for="filters-color-7" data-option-value=".color7"
                                                                   class="isotopeFilter">Purple<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #8d67b2"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Blue">
                                                            <input type="checkbox" class="sr-only" id="filters-color-8">
                                                            <label for="filters-color-8" data-option-value=".color8"
                                                                   class="isotopeFilter">Blue<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #476cb0"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Green">
                                                            <input type="checkbox" class="sr-only" id="filters-color-9">
                                                            <label for="filters-color-9" data-option-value=".color9"
                                                                   class="isotopeFilter">Green<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #599961"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Brown">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-color-10">
                                                            <label for="filters-color-10" data-option-value=".color10"
                                                                   class="isotopeFilter">Brown<span
                                                                        class="filters-color-swatch"
                                                                        style="background: #816345"></span></label>
                                                        </div>
                                                        <div class="form-group" data-toggle="tooltip"
                                                             data-placement="bottom" title="Multi">
                                                            <input type="checkbox" class="sr-only"
                                                                   id="filters-color-11">
                                                            <label for="filters-color-11" data-option-value=".color11"
                                                                   class="isotopeFilter">Multi<span
                                                                        class="filters-color-swatch"
                                                                        style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAIAAAD9b0jDAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAE9JREFUeNpiXNy2/9XDzwyoIJyrnQEDlGpoYAq+u+yPJqIux8uEaSKF4Oajz0wMNACjho4aOmroqKGjho4aOmroCDJUVI6HuiaqSPMABBgA6/gO4zv9nkgAAAAASUVORK5CYII=)"></span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- !ACCORDION -->
                            </div>
                        </div>
                        <!-- / #listFilters -->
                    </div>


                    <div class="clearfix visible-xs"></div>
                    <div class="col-sm-8 col-md-9">
                        <div class="row">
                            <div class="shop-list-filters col-sm-6 col-md-8">
                                <span> {{ $products->count() }} Results</span>
                            </div>
                            {{--sort by--}}

                            <div class="shop-list-filters col-sm-6 col-md-4">
                                <div class="filters-sort">
                                    <div class="btn-group myFilters" data-option-group="sortby"
                                         data-option-type="sortBy">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            Original order <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" class="selected isotopeFilter"
                                                   data-option-value="original-order" data-option-asc="true">Original
                                                    order</a></li>
                                            <li><a href="#" class="isotopeFilter" data-option-value="date"
                                                   data-option-asc="false">Sort by newest</a></li>
                                            <li><a href="#" class="isotopeFilter" data-option-value="popular"
                                                   data-option-asc="false">Sort by popularity</a></li>
                                            <li><a href="#" class="isotopeFilter" data-option-value="rating"
                                                   data-option-asc="false">Sort by rating</a></li>
                                            <li><a href="#" class="isotopeFilter" data-option-value="random"
                                                   data-option-asc="false">Sort by random</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-12">


                                <!-- ISOTOPE GALLERY -->
                                <div id="isotopeContainer" class="shop-product-list isotope">

                                    <div class="isotope-item color3 size1 size2 cat3" data-date="January 1, 2012"
                                         data-popular="40" data-rating="4.0">
                                        <!-- SHOP FEATURED ITEM -->
                                        <div class="shop-item shop-item-featured overlay-element">
                                            <div class="overlay-wrapper">
                                                <a href="#"><img src="{{asset('shop/images/demo-content/prod-001.jpg')}}" alt=" "></a>
                                                <div class="overlay-contents">
                                                    <div class="shop-item-actions">

                                                        <button class="btn btn-default btn-block">View details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-name-price">
                                                <h4><a href="#">'90s Sundress</a></h4>
                                                <span class="price">$45.00</span>
                                            </div>
                                        </div>
                                        <!-- !SHOP FEATURED ITEM -->
                                    </div>
                                    <div class="isotope-item color6 size2 cat3" data-date="January 1, 2013"
                                         data-popular="10" data-rating="3.5">
                                        <!-- SHOP FEATURED ITEM -->
                                        <div class="shop-item shop-item-featured overlay-element">
                                            <div class="overlay-wrapper">
                                                <a href="#"><img src="{{asset('shop/images/demo-content/prod-002.jpg')}}" alt=" "></a>
                                                <div class="overlay-contents">
                                                    <div class="shop-item-actions">

                                                        <button class="btn btn-default btn-block">View details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-name-price">
                                                <h4><a href="#">Cupped Structured Dress In Lace</a></h4>
                                                <span class="price">$320.00</span>
                                            </div>
                                        </div>
                                        <!-- !SHOP FEATURED ITEM -->
                                    </div>
                                    <div class="isotope-item color7 size3 cat3" data-date="January 4, 2012"
                                         data-popular="20" data-rating="3.5">
                                        <!-- SHOP FEATURED ITEM -->
                                        <div class="shop-item shop-item-featured overlay-element">
                                            <div class="overlay-wrapper">
                                                <a href="#"><img src="{{asset('shop/images/demo-content/prod-003.jpg')}}" alt=" "></a>
                                                <div class="overlay-contents">
                                                    <div class="shop-item-actions">

                                                        <button class="btn btn-default btn-block">View details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-name-price">
                                                <h4><a href="#">Fluffy Jumper Dress</a></h4>
                                                <span class="price">$70.00</span>
                                            </div>
                                        </div>
                                        <!-- !SHOP FEATURED ITEM -->
                                    </div>
                                    @foreach($products as $product)

                                    <div class="isotope-item color7 size3 cat3" data-date="January 4, 2012"
                                         data-popular="20" data-rating="3.5">
                                        <!-- SHOP FEATURED ITEM -->
                                        <div class="shop-item shop-item-featured overlay-element">
                                            <div class="overlay-wrapper">
                                                @foreach($product->images as $image)
                                                    @if($image->is_main==1)
                                                <a href="#"><img src="{{ asset($image->image) }}" alt=" "></a>
                                                    @endif
                                                    @endforeach
                                                <div class="overlay-contents">
                                                    <div class="shop-item-actions">

                                                        <button class="btn btn-default btn-block"><a href="{{route('view_details',$product->id)}}" class="mybtn" style="text-decoration: none; ">View details</a></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item-info-name-price">
                                                <h4><a href="{{route('view_details',$product->id)}}">{{ $product->title }}</a></h4>
                                                <span><strong>Rs.</strong> </span><span class="price">{{ $product->sale_price }}</span>
                                            </div>
                                        </div>
                                        <!-- !SHOP FEATURED ITEM -->
                                    </div>
                                        @endforeach
                                </div>





                        </div>
                    </div>


                </form>
            </div>
            <!-- / row -->

        </div>
    </section>

    <div class="clearfix visible-xs visible-sm"></div>
    <!-- fixes floating problems when mobile menu is visible -->


    <!-- end frame -->


    <!-- !SHOP FEATURED ITEM -->


    </div>
@endsection