<header class="header" id="header">

    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <span class="mr-2"> <i class="icofont-phone mr-1"></i> Call Us : </span><span>01-<a
                                href="tel:+977{{ isset($setting) ? $setting->company_number : '' }}">{{ isset($setting) ? $setting->company_number : '' }}</a></span>
                </div>
                <div class="col-md-6 ">
                    <div class="">Go far with Lifestyle</div>

                </div>
                <div class="col-md-3">
                    <span class="mr-2"> <i class="icofont-email mr-1"></i> Mail Us : </span><span><a
                                href="mailto:{{ isset($setting) ? $setting->email : '' }}">{{ isset($setting) ? $setting->email : '' }}</a></span>

                </div>

            </div>

        </div>

    </div>
    <div class="mid-header ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3">
                    <div class="d-flex align-items-center justify-content-between mb-view">
                        <div class="d-flex align-items-center">
                            <div class="bars d-none">
                                <a href="#offcanvas-push" uk-toggle><i
                                            class="icofont-navigation-menu icofont-x" style="font-size: 22px;"></i></a>
                            </div>&nbsp;
                            <div class="logo">

                                <a href="{{route('index')}}">
                                    <img src="{{ isset($setting) ? asset($setting->logo) : '' }}"
                                         alt="company logo"></a>
                            </div>
                        </div>

                        <div class=" mb-view--user d-none">
                            <div class="users">

                                <div class="user-cart">
                                    <span><i class="icofont-basket icofont-x"></i></span>
                                    <span class="user-cart-no">
                                    @if(Sentinel::check())
                                            {{\Cart::session(Sentinel::getUser()->id)->getTotalQuantity()}} items:
                                            ${{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}
                                        @else
                                            0
                                        @endif
                                </span>
                                    <div class="user_cart_dd">
                                        @if(Sentinel::check())
                                            @if(\Cart::session(Sentinel::getUser()->id)->getContent()->count()>0)
                                                <ul class="user_cart_ul">
                                                    @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                                                        <li>

                                                            <figure style="float: left; margin-right: 10px; width: 50px;">
                                                                <img src="{{asset($product->attributes['image'])}}"
                                                                     alt="{{$product->name}}">
                                                            </figure>
                                                            <p class="text-left">
                                                                <span> {{$product->name}}</span><br>
                                                                <span>{{$product->quantity}}</span> <span>*</span>
                                                                <span>{{$product->price}}</span>

                                                            </p>
                                                            <div class="clearfix"></div>
                                                            <hr>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="cart_subtotal">
                                                    <div class="float-left">Subtotal</div>
                                                    <div class="float-right"><span class="">
                                                <span class="">Rs.</span>
                                                            @if(Sentinel::check())
                                                                {{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}
                                                            @endif
                                            </span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                </div>
                                                <a href="/view_cart" class="view-cart float-left">View Cart</a>
                                                <a href="/cart_checkout" class=" checkout float-right">Checkout</a>
                                                <div class="clearfix"></div>
                                            @else
                                                <span>No items in the Cart.</span>
                                            @endif
                                        @else
                                            <span>Login To View Cart</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="user-login">
                                    @if(Sentinel::check())
                                        <span><i class="icofont-ui-user icofont-x"></i></span>
                                        <div class="user-login_dd">
                                            <ul class="user-login_dd_ul">
                                                @if($user = Sentinel::getUser()->inRole('admin'))
                                                    <li>
                                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('user_info') }}">Account</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user_wishlists') }}">wishlist</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user_orders') }}">Orders</a>
                                                </li>
                                                <li class="nav-item">
                                                    <form action="/logout" method="post" id="logout">
                                                        {{csrf_field()}}
                                                        <a class="nav-link" href="#"
                                                           onclick="document.getElementById('logout').submit()">
                                                            Logout</a></a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                    @else
                                        <span><i class="icofont-ui-user icofont-x"></i></span>
                                        <div class="user-login_dd">
                                            <ul class="user-login_dd_ul">
                                                <li>
                                                    <a class="nav-link" href="{{route('login')}}">Login</a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="{{route('register')}}">Register</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                @if(Sentinel::check())
                                    <a href="{{ route('user_wishlists') }}" class=" user-wishlist">
                                        <span><i class="icofont-heart icofont-x"></i></span>
                                        <span class="user-cart-no">{{ Sentinel::getUser()->wishlists->count() }}</span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center pb-3 pt-3">
                    <form class=" header-form-search" action="{{route('search')}}" method="get">
                        @csrf
                        <div class="header-form--inner">
                            <div class="header-form-input">
                                <input type="text" name="query" value="{{request()->input('query')}}" class=""
                                       title="Search for products, brands and more" name="q" autocomplete="off"
                                       placeholder="Search for products, brands and more">
                            </div>
                            <button class="" type="submit">
                                <i class="icofont-search-1"></i>
                            </button>
                        </div>

                    </form>
                </div>
                <div class="col-lg-3 col-md-3 right-section">

                    <div class="users">

                        <div class="user-cart">
                            <span><i class="icofont-basket icofont-x"></i></span>
                            <span class="user-cart-no">
                                    @if(Sentinel::check())
                                    {{\Cart::session(Sentinel::getUser()->id)->getTotalQuantity()}} items:
                                    ${{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}
                                @else
                                    0
                                @endif
                                </span>
                            <div class="user_cart_dd">
                                @if(Sentinel::check())
                                    @if(\Cart::session(Sentinel::getUser()->id)->getContent()->count()>0)
                                        <ul class="user_cart_ul">
                                            @foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)
                                                <li>

                                                    <figure style="float: left; margin-right: 10px; width: 50px;"><img
                                                                src="{{asset($product->attributes['image'])}}"
                                                                alt="{{$product->name}}">
                                                    </figure>
                                                    <p class="text-left">
                                                        <span> {{$product->name}}</span><br>
                                                        <span>{{$product->quantity}}</span> <span>*</span>
                                                        <span>{{$product->price}}</span>

                                                    </p>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="cart_subtotal">
                                            <div class="float-left">Subtotal</div>
                                            <div class="float-right"><span class="">
                                                <span class="">Rs.</span>
                                                    @if(Sentinel::check())
                                                        {{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}
                                                    @endif
                                            </span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        <a href="/view_cart" class="view-cart float-left">View Cart</a>
                                        <a href="/cart_checkout" class=" checkout float-right">Checkout</a>
                                        <div class="clearfix"></div>
                                    @else
                                        <span>No items in the Cart.</span>
                                    @endif
                                @else
                                    <span>Login To View Cart</span>
                                @endif
                            </div>
                        </div>
                        <div class="user-login">
                            @if(Sentinel::check())
                                <a href=""><span><i class="icofont-ui-user icofont-x"></i></span></a>
                                <div class="user-login_dd">
                                    <ul class="user-login_dd_ul">
                                        @if($user = Sentinel::getUser()->inRole('admin'))
                                            <li>
                                                <a href="{{ route('dashboard') }}">Dashboard</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('user_info') }}">Account</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user_wishlists') }}">Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user_orders') }}">Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <form action="/logout" method="post" id="logout">
                                                {{csrf_field()}}
                                                <a class="nav-link" href="#"
                                                   onclick="document.getElementById('logout').submit()"> Logout</a></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            @else
                                <a href=""><span><i class="icofont-ui-user icofont-x"></i></span></a>
                                <div class="user-login_dd">
                                    <ul class="user-login_dd_ul">
                                        <li>
                                            <a class="nav-link" href="{{route('login')}}">Login</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="{{route('register')}}">Register</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        @if(Sentinel::check())
                            <a href="{{ route('user_wishlists') }}" class=" user-wishlist">
                                <span><i class="icofont-heart icofont-x"></i></span>
                                <span class="user-cart-no">{{ Sentinel::getUser()->wishlists->count() }}</span>
                            </a>
                        @endif

                    </div>


                </div>
            </div>

        </div>
    </div>
    <div class="bottom-header " uk-sticky>
        <div class="container-fluid">

            <ul class="nav-list-items d-flex justify-content-center position-relative" style="height:45px">
                @foreach($categories as $category)

                    <li><a class="menu-item" href="{{route('filter',$category->slug)}}">{{ $category->title }}</a>
                        <div class="megaBGMenu">
                            <div class="row">
                                @foreach($category->children as $child)
                                    {{--                                    @if($child->parent_id==$category->id)--}}
                                    <div class="col-md-3">
                                        <div class="submenu1">
                                            <a href="{{route('filter',$child->slug)}}" class="submenuhead"
                                               style="color: black">{{ $child->title }}</a>

                                            <ul id="navCategory">
                                                @if($child->children)
                                                    @foreach($child->children as $grandchild)
                                                        <li>
                                                            <a href="{{route('filter',$grandchild->slug)}}">{{$grandchild->title}}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    {{--@endif--}}
                                @endforeach
                            </div>

                        </div>
                    </li>
                @endforeach
                {{--<li><a class="menu-item" href="categories.html">Lehengas</a></li>--}}
                {{--<li><a class="menu-item" href="categories.html">bridal collection</a></li>--}}
                <li><a class="menu-item" href="{{ route('slug_filter','new_arrival') }}"> new arrival</a></li>
                <li><a class="menu-item" href="{{ route('slug_filter',['id' => 'sale']) }}">sale</a></li>
                <li><a class="menu-item" href="{{route('about')}}">About us</a></li>
                <li><a class="menu-item" href="{{route('contact')}}">Contact us</a></li>
                {{--<li><a class="menu-item" href="{{route('blogs')}}">Blogs</a></li>--}}
                <li><a class="menu-item" href="{{route('blogs')}}">Blogs</a>
                    <div class="megaBGMenu">
                        <div class="row">
                            @foreach($blogcategory as $category)
                                <div class="col-md-3">
                                    <div class="submenu1">
                                        <a href="{{route('blog-category',$category->slug)}}" class="submenuhead"
                                           style="color: black">{{$category->name}}</a>

                                        <ul id="navCategory">
                                            @foreach(App\Blogs::where('category_id',$category->id)->get() as $blogs)
                                                <li>
                                                    <a href="{{route('blogs-single',$blogs->slug)}}">{{$blogs->title}}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            {{--@endif--}}
                        </div>

                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>
<div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>

        <section class="mobile-nav">
            <form action="{{route('search')}}" class="uk-search uk-search-default">
                <button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>
                <input name="query" value="{{request()->input('query')}}" class="uk-search-input" type="search"
                       placeholder="Search...">
            </form>
            <ul class="metismenu" id="menu">
                <li class="active">
                    <a href="/" aria-expanded="true">Home</a>
                </li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{route('filter',$category->slug)}}" aria-expanded="false">{{ $category->title }}<span
                                    class="fa arrow"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            @foreach($category->children as $child)

                                @if($child->children->count() > 0)
                                    <li><a href="{{route('filter',$child->slug)}}">{{ $child->title }}<span
                                                    class="fa plus-times"></span></a>
                                        <ul aria-expanded="false" class="list-levels">
                                            @foreach($child->children as $grandchild)
                                                <li>
                                                    <a href="{{route('filter',$grandchild->slug)}}">{{$grandchild->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{route('filter',$child->slug)}}">{{ $child->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('slug_filter','new_arrival')}}">New Arrival</a>
                </li>
                <li>
                    <a href="{{ route('slug_filter','sale')}}">Sale</a>
                </li>
                <li>
                    <a href="/about" aria-expanded="false">About us</a>
                </li>
                <li>
                    <a href="/contact" aria-expanded="false">Contact us</a>
                </li>

                {{--<li>--}}
                {{--<a href="{{route('blogs')}}" aria-expanded="false">Blogs</a>--}}
                {{--</li>--}}
                <li>
                    <a href="{{route('blogs')}}" aria-expanded="false"><span
                                class="fa arrow"></span>Blogs</a>
                    <ul aria-expanded="false" class="list-levels">
                        @foreach($blogcategory as $category)

                            <li><a href="{{route('blog-category',$category->slug)}}">{{$category->name}}<span
                                            class="fa plus-times"></span></a>
                                <ul aria-expanded="false" class="list-levels">

                                    @foreach(App\Blogs::where('category_id',$category->id)->get() as $blogs)
                                        <li>
                                            <a href="{{route('blogs-single',$blogs->slug)}}">{{$blogs->title}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach


                    </ul>
                </li>
            </ul>
        </section>
    </div>
</div>

{{--<div class="uk-offcanvas-content">--}}


{{--<!-- Page Preloder -->--}}


{{--<header class="header" id="header">--}}

{{--<div class="top-header">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-md-3">--}}
{{--<span class="mr-2"> <i class="icofont-phone mr-1"></i> Call Us : </span><span>{{ $setting->company_number }}</span>--}}
{{--</div>--}}
{{--<div class="col-md-6 ">--}}
{{--<div class="">Silk House Agencies Offers - 10% OFF on First Purchase</div>--}}

{{--</div>--}}
{{--<div class="col-md-3">--}}
{{--<span class="mr-2"> <i class="icofont-email mr-1"></i> Mail Us : </span><span>{{ $setting->email }}</span>--}}

{{--</div>--}}

{{--</div>--}}

{{--</div>--}}

{{--</div>--}}
{{--<div class="mid-header">--}}
{{--<div class="container">--}}
{{--<div class="row align-items-center">--}}
{{--<div class="col-lg-3 col-md-4">--}}
{{--<div class="d-flex align-items-center justify-content-between mb-view">--}}
{{--<div class="bars d-none">--}}
{{--<a href="#offcanvas-push" uk-toggle><i--}}
{{--class="icofont-navigation-menu icofont-x" style="font-size: 22px;"></i></a>--}}
{{--</div>--}}
{{--<div class="logo">--}}

{{--<a href="{{'/'}}">--}}
{{--<img src="{{asset('front/images/'.$setting->logo)}}" alt="company logo"></a>--}}
{{--</div>--}}
{{--<div class=" mb-view--user d-none">--}}
{{--<div class="users">--}}
{{--<div class="notification">--}}
{{--<span><i class="icofont-alarm icofont-x"></i></span>--}}
{{--<span>1</span>--}}
{{--</div>--}}
{{--<div class="user-cart">--}}
{{--<span><i class="icofont-basket icofont-x"></i></span>--}}
{{--<span>1</span>--}}
{{--</div>--}}
{{--<div class="user-login">--}}
{{--<span><i class="icofont-ui-user icofont-x"></i></span>--}}
{{--</div>--}}


{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-lg-6 col-md-4">--}}
{{--<div class="d-flex justify-content-center">--}}
{{--<div class="slogan"><h4> DELIVERING CULTURE WORLDWIDE </h4></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-lg-3 col-md-4 right-section">--}}

{{--<div class="users">--}}
{{--<div class="notification">--}}
{{--<span><i class="icofont-alarm icofont-x"></i></span>--}}
{{--<span class="notification-no">1</span>--}}
{{--<div class="notification_dd">--}}
{{--<ul class="notification_dd_ul">--}}
{{--<li>--}}
{{--<figure style="float: left; margin-right: 10px; width: 50px;"><img--}}
{{--src="https://img.looksgud.com/upload/item-image/90/1y3v/1y3v-bollywood-designer-dazzling-red-chiffon-saree-with-black_500x500_0.jpg"--}}
{{--alt="bollywood-designer-dazzling-red-chiffon-saree-with-black">--}}
{{--</figure>--}}
{{--<p class="text-left">--}}
{{--<span> bollywood-designer-dazzling-red-chiffon-saree-with-black</span>--}}

{{--</p>--}}
{{--<div class="clearfix"></div>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="user-cart">--}}
{{--<span><i class="icofont-basket icofont-x"></i></span>--}}
{{--<span class="user-cart-no">--}}
{{--@if(Sentinel::check())--}}
{{--{{\Cart::session(Sentinel::getUser()->id)->getTotalQuantity()}} items: ${{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}--}}
{{--@endif--}}
{{--</span>--}}
{{--<div class="user_cart_dd">--}}
{{--<ul class="user_cart_ul">--}}
{{--@if(Sentinel::check())--}}
{{--@foreach(\Cart::session(Sentinel::getUser()->id)->getContent() as $product)--}}
{{--<li>--}}

{{--<figure style="float: left; margin-right: 10px; width: 50px;"><img src="{{asset($product->attributes['image'])}}">--}}
{{--</figure>--}}
{{--<p class="text-left">--}}
{{--<span> {{$product->name}}</span><br>--}}
{{--<span>{{$product->quantity}}</span> <span>*</span> <span>{{$product->price}}</span>--}}

{{--</p>--}}
{{--<div class="clearfix"></div>--}}
{{--<hr>--}}
{{--</li>--}}
{{--@endforeach--}}
{{--@endif--}}
{{--</ul>--}}
{{--<div class="cart_subtotal">--}}
{{--<div class="float-left">Subtotal</div>--}}
{{--<div class="float-right"><span class="">--}}
{{--<span class="">Rs.</span>--}}
{{--@if(Sentinel::check())--}}
{{--{{\Cart::session(Sentinel::getUser()->id)->getSubTotal()}}--}}
{{--@endif--}}
{{--</span>--}}
{{--</div>--}}
{{--<div class="clearfix"></div>--}}
{{--<hr>--}}
{{--</div>--}}
{{--<a href="/view_cart" class="view-cart float-left">View Cart</a>--}}
{{--<a href="/cart_checkout" class=" checkout float-right">Checkout</a>--}}
{{--<div class="clearfix"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="user-login">--}}

{{--@if(Sentinel::check())--}}
{{--<a href=""><span><i class="icofont-ui-user icofont-x"></i></span></a>--}}
{{--<div class="user-login_dd">--}}
{{--<ul class="user-login_dd_ul">--}}
{{--<li>--}}
{{--<a href="">Account</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="">wishlist</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="{{ route('user_orders') }}">Orders</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<form action="/logout" method="post" id="logout">--}}
{{--{{csrf_field()}}--}}
{{--<a class="nav-link" href="#" onclick="document.getElementById('logout').submit()"> Logout</a></a>--}}
{{--</form>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}

{{--@else--}}
{{--<a href=""><span><i class="icofont-ui-user icofont-x"></i></span></a>--}}
{{--<div class="user-login_dd">--}}
{{--<ul class="user-login_dd_ul">--}}
{{--<li>--}}
{{--<a  class="nav-link" href="{{route('login')}}">Login</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a  class="nav-link" href="{{route('register')}}">Register</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}


{{--</div>--}}


{{--</div>--}}
{{--<div class="search-box">--}}
{{--<input type="text" class="uk-input">--}}
{{--<button><span uk-icon="search"></span></button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--<div class="bottom-header " uk-sticky>--}}
{{--<div class="container">--}}

{{--<ul class="nav-list-items d-flex justify-content-center">--}}
{{--@foreach($categories as $category)--}}

{{--<li><a class="menu-item" href="{{route('filter',$category->id)}}">{{ $category->title }}</a>--}}
{{--<div class="megaBGMenu">--}}
{{--<div class="row">--}}
{{--@foreach($category->children as $child)--}}
{{--                                    @if($child->parent_id==$category->id)--}}
{{--<div class="col-md-3">--}}
{{--<a href="{{route('filter',$child->id)}}" class="submenuhead" style="color: black">{{ $child->title }}</a>--}}
{{--<ul id="navCategory">--}}
{{--@if($child->children)--}}
{{--@foreach($child->children as $grandchild)--}}
{{--<li><a href="{{route('filter',$grandchild->id)}}">{{$grandchild->title}}</a></li>--}}
{{--@endforeach--}}
{{--@endif--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</div>--}}
{{--<table width="100%" cellspacing="0" cellpadding="0" border="0">--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<td style="padding-right: 20px" valign="top">--}}
{{--<div class="submenu1">--}}
{{--@foreach($categories as $category)--}}
{{--<div class="submenuhead" style="color: black">{{ $category->title }}</div>--}}

{{--<ul id="navCategory">--}}
{{--@foreach($child_categories as $child)--}}
{{--@if($child->parent_id==$category->id)--}}
{{--<li><a href="">{{$child->title}}</a></li>--}}
{{--@endif--}}
{{--@endforeach--}}

{{--</ul>--}}
{{--@endforeach--}}
{{--<!------------------------occassion------------------------------------->--}}
{{--<div class="submenuhead" style="margin-top:30px;">By Occasion</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="festive">Festive Wear</a></li>--}}
{{--<li><a href="party">Party Wear</a></li>--}}
{{--<li><a href="regular">Regular Wear</a></li>--}}
{{--<li><a href="wedding">Wedding</a></li>--}}
{{--</ul>--}}


{{--</div>--}}
{{--</td>--}}
{{--<td style="padding-right: 20px" valign="top">--}}
{{--<div class="submenu1">--}}
{{--<div class="submenuhead">By Fabric</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="brocade">Brocade</a></li>--}}
{{--<li><a href="cottonsilk">Cotton Silk</a></li>--}}
{{--<li><a href="crepe">Crepe</a></li>--}}
{{--<li><a href="georgette">Georgette</a></li>--}}
{{--<li><a href="khimkhab">Khimkhab</a></li>--}}
{{--<li><a href="lycra">Lycra</a></li>--}}
{{--<li><a href="net">Net</a></li>--}}
{{--<li><a href="sequence">Sequence</a></li>--}}
{{--<li><a href="silk">Silk</a></li>--}}
{{--<li><a href="tissue">Tissue</a></li>--}}
{{--</ul>--}}


{{--</div>--}}
{{--</td>--}}
{{--<td style="padding-right: 20px" valign="top">--}}
{{--<div class="submenu1">--}}
{{--<div class="submenuhead">By Neckshape</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="boatneckline">Boat Neckline</a></li>--}}
{{--<li><a href="chinesecollar">Chinese Collar</a></li>--}}
{{--<li><a href="Highneckline">High Neckline</a></li>--}}
{{--<li><a href="roundneckline">Round Neckline</a></li>--}}
{{--<li><a href="sweetheartneckline">Sweetheart Neckline</a>--}}
{{--</li>--}}
{{--<li><a href="vneckline">V Neckline</a></li>--}}
{{--</ul>--}}


{{--<!------------------------pattern------------------------------------->--}}
{{--<div class="submenuhead" style="margin-top:30px;">By Pattern</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="backhook">Back Hook</a></li>--}}
{{--<li><a href="backtyeup">Back Tye-up</a></li>--}}
{{--<li><a href="backzip">Back Zip</a></li>--}}
{{--<li><a href="fronthook">Front Hook</a></li>--}}
{{--<li><a href="frontzip">Front Zip</a></li>--}}
{{--<li><a href="sidehook">Side Hook</a></li>--}}
{{--<li><a href="sidezip">Side Zip</a></li>--}}
{{--</ul>--}}

{{--</div>--}}
{{--</td>--}}
{{--<td style="padding-right: 20px" valign="top">--}}
{{--<div class="submenu1">--}}
{{--<div class="submenuhead">By Sleeve Length</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="elbowsleeves">Elbow Sleeves</a></li>--}}
{{--<li><a href="fullsleeves">Full Sleeves</a></li>--}}
{{--<li><a href="halfsleeves">Half Sleeves</a></li>--}}
{{--<li><a href="shortsleeves">Short Sleeves</a></li>--}}
{{--<li><a href="sleeveless">Sleeveless</a></li>--}}
{{--<li><a href="threequartersleeves">Three Quarter Sleeves</a>--}}
{{--</li>--}}
{{--</ul>--}}


{{--<div class="submenuhead" style="margin-top:30px;">By Color</div>--}}

{{--<ul id="navCategory">--}}

{{--<li><a href="black">Black</a></li>--}}
{{--<li><a href="blue">Blue</a></li>--}}
{{--<li><a href="gold">Gold</a></li>--}}
{{--<li><a href="green">Green</a></li>--}}
{{--<li><a href="orangeorrust">Orange/rust</a></li>--}}
{{--<li><a href="pink">Pink</a></li>--}}
{{--<li><a href="purpleormagenta">Purple/magenta</a></li>--}}
{{--<li><a href="redormaroon">Red/maroon</a></li>--}}
{{--<li><a href="white">White</a></li>--}}
{{--</ul>--}}

{{--</div>--}}
{{--</td>--}}
{{--<td style="padding-right: 20px" valign="top">--}}
{{--<div class="submenu1">--}}
{{--<div class="submenuhead">By Sleeve Length</div>--}}

{{--<ul id="navCategory">--}}
{{--<li><a href="elbowsleeves">Elbow Sleeves</a></li>--}}
{{--<li><a href="fullsleeves">Full Sleeves</a></li>--}}
{{--<li><a href="halfsleeves">Half Sleeves</a></li>--}}
{{--<li><a href="shortsleeves">Short Sleeves</a></li>--}}
{{--<li><a href="sleeveless">Sleeveless</a></li>--}}
{{--<li><a href="threequartersleeves">Three Quarter Sleeves</a>--}}
{{--</li>--}}
{{--</ul>--}}


{{--<div class="submenuhead" style="margin-top:30px;">By Color</div>--}}

{{--<ul id="navCategory">--}}

{{--<li><a href="black">Black</a></li>--}}
{{--<li><a href="blue">Blue</a></li>--}}
{{--<li><a href="gold">Gold</a></li>--}}
{{--<li><a href="green">Green</a></li>--}}
{{--<li><a href="orangeorrust">Orange/rust</a></li>--}}
{{--<li><a href="pink">Pink</a></li>--}}
{{--<li><a href="purpleormagenta">Purple/magenta</a></li>--}}
{{--<li><a href="redormaroon">Red/maroon</a></li>--}}
{{--<li><a href="white">White</a></li>--}}
{{--</ul>--}}

{{--</div>--}}
{{--</td>--}}

{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</li>--}}
{{--@endforeach--}}
{{--<li><a class="menu-item" href="categories.html">Lehengas</a></li>--}}
{{--<li><a class="menu-item" href="categories.html">bridal collection</a></li>--}}
{{--<li><a class="menu-item" href="{{ route('new_arrival') }}"> new arrival</a></li>--}}
{{--<li><a class="menu-item" href="{{ route('nav_sale') }}">sale</a></li>--}}
{{--<li><a class="menu-item" href="{{'about'}}">About us</a></li>--}}
{{--<li><a class="menu-item" href="{{'contact'}}">Contact us</a></li>--}}
{{--</ul>--}}

{{--</div>--}}

{{--</div>--}}
{{--</header>--}}

{{--<!-- mobile menu -->--}}


{{--<!-- The whole page content goes here -->--}}
{{--<div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">--}}
{{--<div class="uk-offcanvas-bar">--}}

{{--<button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>--}}

{{--<section class="mobile-nav" >--}}
{{--<form class="uk-search uk-search-default">--}}
{{--<button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>--}}
{{--<input class="uk-search-input" type="search" placeholder="Search...">--}}
{{--</form>--}}
{{--<ul class="metismenu" id="menu">--}}
{{--<li class="active" >--}}
{{--<a  href="#" aria-expanded="true">Home</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a  href="#" aria-expanded="false">Electronics<span class="fa arrow"></span></a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="">Item 1</a></li>--}}
{{--<li><a href="">Item 2</a></li>--}}
{{--<li><a href="">Item 3</a></li>--}}
{{--<li><a href="">Item 4</a></li>--}}
{{--<li><a href="">Item 5</a></li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a  href="category-page.html" aria-expanded="false">--}}
{{--Home Appliance<span class="fa arrow"></span>--}}
{{--</a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="">kitchen<span class="fa plus-times"></span></a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="?">item 1.3.1</a></li>--}}
{{--<li><a href="?">item 1.3.2</a></li>--}}
{{--<li><a href="?">item 1.3.3</a></li>--}}
{{--<li><a href="?">item 1.3.4</a></li>--}}
{{--</ul></li>--}}
{{--<li>--}}
{{--<a href="?" aria-expanded="false">bed room<span class="fa plus-times"></span></a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="?">item 2.3.1</a></li>--}}
{{--<li><a href="?">item 2.3.2</a></li>--}}
{{--<li><a href="?">item 2.3.3</a></li>--}}
{{--<li><a href="?">item 2.3.4</a></li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--<li><a href="">terrance<span class="fa plus-times"></span></a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="?">item 1.3.1</a></li>--}}
{{--<li><a href="?">item 1.3.2</a></li>--}}
{{--<li><a href="?">item 1.3.3</a></li>--}}
{{--<li><a href="?">item 1.3.4</a></li>--}}
{{--</ul></li>--}}
{{--<li>--}}
{{--<a href="?" aria-expanded="false">Item 3<span class="fa plus-times"></span></a>--}}
{{--<ul aria-expanded="false" class="list-levels">--}}
{{--<li><a href="?">item 2.3.1</a></li>--}}
{{--<li><a href="?">item 2.3.2</a></li>--}}
{{--<li><a href="?">item 2.3.3</a></li>--}}
{{--<li><a href="?">item 2.3.4</a></li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a  href="#" aria-expanded="false">About us</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a  href="#" aria-expanded="false">Contact us</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</section>--}}
{{--</div>--}}
{{--</div>--}}