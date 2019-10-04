@extends('front.master_front')
@section('title','User Dashboard')
@section('content')

    <div id="edit_account_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Edit your account info</h4>
                </div>
                <form action="{{ route('change_pswd') }}" method="post" class="change_password" id="change_password">
                    <div class="modal-body">
                        {{--<div class="form-group">--}}
                        {{--<label for="exampleInputEmail1">Email address</label>--}}
                        {{--<input type="email" class="form-control" id="email" placeholder="Email">--}}
                        {{--<span class="error_message" id="email_error"--}}
                        {{--style="display:none; color: red"></span>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="exampleInputPassword">Old-Password</label>
                            <input type="password" name="old_password" class="form-control" id="old_password"
                                   placeholder="Old Password">
                            <span class="error_message" id="old_password_error"
                                  style="display:none; color: red"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password"
                                   placeholder="New Password">
                            <span class="error_message" id="new_password_error"
                                  style="display:none; color: red"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                   placeholder="Re-enter New Password">
                            <span class="error_message" id="confirm_password_error"
                                  style="display:none; color: red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <div id="edit_personal_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit your personal info</h4>
                </div>
                <form method="post" action="{{ route('user') }}">
                    @csrf

                    @if($admin!=null)
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="firstName">Full Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{ $admin->first_name }}"
                                       name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="last_name" value="{{ $admin->last_name }}"
                                       name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="number" class="form-control" id="mobile" value="{{ $admin->mobile }}"
                                       name="mobile">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="radio">
                                    <label><input type="radio" value="1" name="gender" required>Male</label>

                                    <label><input type="radio" value="0" name="gender" required>Female</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input type="date" id="datepicker" name="dob" value="{{ $admin->dob }}"
                                       class="form-control" placeholder="Choose">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    @else
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="number" class="form-control" id="mobile" name="mobile">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="radio">
                                    <label><input type="radio" value="1" name="gender" required>Male</label>

                                    <label><input type="radio" value="0" name="gender" required>Female</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input type="date" id="datepicker" name="dob" class="form-control" placeholder="Choose">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    @endif

                </form>
            </div>
        </div>

    </div>



    <div id="edit_commnotifysettings" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Notification Settings</h3>
                    <h5>Choose the notifications you want to receive.</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <ul class="liststyle--none">
                            <li class="notify--list">
                                <a href="#" class="accordion-title" data-toggle="collapse"
                                   data-target="#collapseExample" aria-expanded="false" aria-selected="false">
                                    <h4><b>Recommendations</b></h4>
                                    <span>You are special! Get personalized offers, promotions and coupons on your favorite brand and items.</span>
                                    <span class="btn btn-primary pull-right mb-10">options</span>
                                    <span class="clearfix"></span>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <form>
                                        <input type="hidden" name="updateCustomerCPC" value="1">
                                        <ul class="liststyle--none">
                                            <li>
                                                <input type="checkbox" class="channel_settings channel_settings_1"
                                                       checked="">Email
                                            </li>
                                            <li>

                                                <input type="checkbox" class="channel_settings channel_settings_1"
                                                       checked="">Push Notifications

                                            </li>
                                            <li>
                                                <input type="checkbox" class="channel_settings channel_settings_1"
                                                       checked="">SMS
                                            </li>
                                        </ul>
                                        <div class="save-action ">
                                            <input type="submit" class="btn btn-primary btn-sm pull-right" value="Save">
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>


                </form>
            </div>
        </div>
    </div>


    <section class="content-box-row">
        <div class="container " style="margin:10px auto;padding:0;">

            <div class="alert__section">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('success'))
                            <div class="alert alert-info success-msg">
                                <strong>Success!</strong> {{ session('success') }}
                                {{--<button type="button" class="close" data-dismiss="success_msg" aria-label="Close">--}}
                                    {{--<span aria-hidden="true">&times;</span>--}}
                                {{--</button>--}}
                            </div>
                        @endif
                        <div class="alert alert-info error_form form_error" style="display:none;">
                            <button type="button" class="close" data-dismiss="form_error" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="profile__section">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="account--userInfo p-2">
                            
                                <span class="userInfo--name bold">@if($admin!=null){{$admin->first_name." ".$admin->last_name}}@endif</span>
                                <br>
                                <small class="userInfo--email data">{{$user->email}}</small>
                        </div>
                        <div class="grouplist tab d-none d-sm-block">
                            <ul class="liststyle--none">
                                <li><a href="javascript:void(0)" class="tabslinks orders"
                                       onclick="accountsettings(event, 'orders')"><i
                                                class="fas fa-book fa-2x mr-10"></i>My orders</a></li>
                                <li><a href="javascript:void(0)" class="tabslinks address"
                                       onclick="accountsettings(event, 'address')"><i
                                                class="fas fa-address-card fa-2x mr-10"></i>Shipping addresses</a></li>
                                <li><a href="javascript:void(0)" class="tabslinks wishlists"
                                       onclick="accountsettings(event, 'wishlist')"><i
                                                class="fas fa-heart fa-2x mr-10"></i>wish lists</a></li>
                                <li><a href="javascript:void(0)" class="tabslinks info" id="defaultOpen"
                                       onclick="accountsettings(event, 'account')"><i
                                                class="fas fa-edit fa-2x mr-10"></i>account settings</a></li>
                            </ul>
                        </div>


                        <div class="grouplist tab d-block d-sm-none">
                            <ul class="liststyle--none">
                                <li><a href="javascript:void(0)" class="tabslinks orders"
                                       onclick="accountsettings(event, 'orders')" title="orders"><i
                                                class="fas fa-book fa-2x mr-10"></i></a></li>
                                <li><a href="javascript:void(0)" class="tabslinks address"
                                       onclick="accountsettings(event, 'address')" title="address"><i
                                                class="fas fa-address-card fa-2x mr-10"></i></a></li>
                                <li><a href="javascript:void(0)" class="tabslinks wishlists"
                                       onclick="accountsettings(event, 'wishlist')" title="wishlist"><i
                                                class="fas fa-heart fa-2x mr-10"></i></a></li>
                                <li><a href="javascript:void(0)" class="tabslinks info" id="defaultOpen"
                                       onclick="accountsettings(event, 'account')" title="account"><i
                                                class="fas fa-edit fa-2x mr-10"></i></a></li>


                            </ul>
                        </div>


                    </div>

                    <div class="col-md-9 col-sm-12">

                        <div id="account" class="account-settings__container tabcontent">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <strong class="titles">Account Information</strong>
                                                <a class="pull-right link" href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#edit_account_info"><i class="far fa-edit"></i> Edit</a>
                                            </div>
                                            <div class="panel-body">

                                                <ul class="liststyle--none">
                                                    <li><span class="mr-10 bold">Email:</span><span
                                                                class="userInfo--name">{{$user->email}}</span></li>
                                                    <li><span class="mr-10 bold">Password:</span><span
                                                                class="userInfo--password data">********</span></li>
                                                    <li><a class="link" href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#edit_account_info">Change Password</a></li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <strong class="titles">Personal Information</strong>
                                                <a class="pull-right link" href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#edit_personal_info"><i class="far fa-edit"></i>
                                                    Edit</a>

                                            </div>
                                            <span class="para ">
                                                 <ul class="liststyle--none">
                                                    <li><span class="mr-10 bold">Name:</span><span
                                                                class="userInfo--name">@if($admin != null){{ $admin->first_name." ".$admin->last_name }}@endif</span></li>
                                                    <li><span class="mr-10 bold">Mobile Number:</span><span
                                                                class="userInfo--username data">@if($admin!=null){{ $admin->mobile }}@endif</span></li>
                                                    <li><span class="mr-10 bold">Gender:</span><span
                                                                class="userInfo--gender data">
                                                            @if(isset($admin))
                                                                @if($admin->gender=="1")
                                                                    {{ "Male" }}
                                                                @else()
                                                                    {{"Female"}}
                                                                @endif
                                                            @endif
                                                        </span></li>
                                                    <li><span class="mr-10 bold">Date of birth:</span><span
                                                                class="userInfo--dob data">@if($admin!=null){{ $admin->dob }}@endif</span></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="container orders__container tabcontent" id="orders">
                            <h3>My orders</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date Ordered</th>
                                        {{--<th>Shipping Date</th>--}}
                                        <th>Items</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        {{--<th>Paid?</th>--}}
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orders->count()>0)
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->order_track}}</td>
                                                <td>{{ $order->order_date }}</td>
                                                {{--                                                <td>{{ $order->shipping_date }}</td>--}}
                                                <td>{{ $order->order_details->count() }}</td>
                                                <td>Rs. {{ $order->final_total }}</td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $order->status_text }}</span>
                                                </td>
                                                {{--<td>--}}
                                                {{--@if($order->paid == 0)--}}
                                                {{--<a href="{{ route('user_payment',$order->order_track) }}" class="btn btn-sm btn-primary">Pay Now</a>--}}
                                                {{--@else--}}
                                                {{--<span class="badge badge-success">Paid</span>--}}
                                                {{--@endif--}}
                                                {{--</td>--}}
                                                <td>
                                                    <button href="#" class="btn btn-sm btn-outline-primary"
                                                            data-toggle="modal"
                                                            data-target="#order_details{{$order->id}}">View
                                                    </button>
                                                    @if($order->status == 1)
                                                        <button class="btn btn-sm btn-outline-danger" id="cancel_order">
                                                            Cancel
                                                        </button>
                                                    @endif

                                                    <div class="modal fade" style="overflow-y: auto;"
                                                         id="order_details{{$order->id}}" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Ordered Items</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <thead>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td>Product Name</td>
                                                                                <td>Quantity</td>
                                                                                <td>Price</td>
                                                                                <td>Amount</td>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($order->order_details as $orderDetail)
                                                                                <tr>
                                                                                    <td class="align-middle">
                                                                                        @foreach($orderDetail->product->images as $image)
                                                                                            @if($image->is_main==1)
                                                                                                <img class="img-fluid cart_image_size"
                                                                                                     src="{{ asset($image->image) }}"
                                                                                                     alt="product-img"/>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td class="align-middle">{{ $orderDetail->product->title }}</td>
                                                                                    <td class="align-middle">{{ $orderDetail->quantity }}</td>
                                                                                    <td class="align-middle">
                                                                                        ${{ $orderDetail->price }}</td>
                                                                                    <td class="align-middle">
                                                                                        ${{ $orderDetail->total }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="order_summary">
                                                                        <p class="sub_total">
                                                                            <span class="">Sub-Total:</span>
                                                                            <span class="pull-right">Rs.{{ $order->subtotal }}@if($order->discount != 0)
                                                                                    : (Discount -{{$order->discount}}
                                                                                    ) @endif </span>
                                                                        </p>
                                                                        <p class="shipping">
                                                                            <span class="">Shipping-Charges:</span>
                                                                            <span class="pull-right">Rs.{{ $order->shipping->shipping_price }}</span>
                                                                        </p>
                                                                        <p class="grand_total">
                                                                            <span class="">Grand-Total:</span>
                                                                            <span class="pull-right">Rs.{{ $order->final_total }} </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>

                                                                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="container wishlist__container tabcontent " id="wishlist">
                            <h3>My wishlist</h3>
                            <div class="table-responsive d-none d-sm-block">
                                <table class="table table-bordered">
                                    <tbody>
                                    @if($wishlists->count()>0)
                                        @foreach($wishlists as $wishlist)
                                            <tr>
                                                <td style="width:100px;">
                                                    <div class="wishlist-product-img">
                                                        <a href="" class="d-block">

                                                            <img src="{{ asset($wishlist->product->get_main_image($wishlist->product_id)) }}"
                                                                 alt="">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="link">{{ $wishlist->product->title }}</a>
                                                </td>
                                                <td class="price__container">
                                                    <span class="price d-block">Rs.{{ $wishlist->product->price }}</span>
                                                    <button>Add to cart</button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('delete_wishlist',$wishlist->id) }}"
                                                       class="button--cancel" title="delete"><i
                                                                class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>


                            <div class="mobile-responsive-wishlist d-block d-sm-none">
                                <div class="table-row table-content">
                                    @if($wishlists->count()>0)
                                        @foreach($wishlists as $wishlist)
                                            <div class=" wishlist-product-img">
                                                <a class="product-image"
                                                   href="https://www.letstango.com/product/apple-mac-mini-mgen2"
                                                   title="Apple Mac Mini MGEN2">
                                                    <img src="{{ asset($wishlist->product->get_main_image($wishlist->product_id)) }}"
                                                         width="113" height="113" alt="{{ $wishlist->product->title }}">
                                                </a>
                                            </div>
                                            <div class="table-cell">
                                                <a href="https://www.letstango.com/product/apple-mac-mini-mgen2"
                                                   class="link base-xs-large-buffer" title="Apple Mac Mini MGEN2">{{ $wishlist->product->title }}</a>
                                            </div>
                                            <div class="table-cell">
                                                <div class="cart-cell">
                                                    <div class="price-box">
                                                        <p class="special-price">
                                                            <span class="price-label">Price</span>
                                                            <span class="price" id="">
                                                                @if($wishlist->product->valid_special_price()==1)
                                                                    {{ $wishlist->product->sale_price }}
                                                                @else
                                                                    {{ $wishlist->product->price }}
                                                                @endif
                                                            </span>
                                                        </p>

                                                    </div>

                                                    <div class="add-to-cart-alt">
                                                        <a href="{{route('add_cart',$wishlist->product->id)}}" class="btn btn-primary ">Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-cell">
                                                <a href="{{ route('delete_wishlist',$wishlist->id) }}" title="Remove Item">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="container address__container tabcontent" id="address">
                            <h3>Address settings</h3>
                            <form action="{{ route('post_user_address') }}" method="post" class="add-address"
                                  style="padding-top: 10px">
                                @csrf

                                <div class="" style="margin-bottom:10px; background: white">

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="fname">Full Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control"
                                                   placeholder="First name"
                                                   value="@if($address){{ $address->first_name }}@endif" required>
                                        </div>
                                        <!--<div class="col-md-6 form-group">-->
                                        <!--    <label for="lname">Last Name</label>-->
                                        <!--    <input type="text" name="lname" id="lname" class="form-control"-->
                                        <!--           placeholder="Last name"-->
                                        <!--           value="@if($address){{ $address->last_name }}@endif" required>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="inputPhone">Phone</label>
                                            <input type="number" name="phone" class="form-control" id="inputPhone"
                                                   value="@if($address){{ $address->phone }}@endif" required></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="inputLocation">Location</label>
                                            <select name="location" class="form-control shipping" id="inputLocation"
                                                    required>
                                                <option value="" disabled selected>Select a shipping district</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                            @if($address)@if($address->shipping_id == $location->id)selected @endif @endif
                                                    >
                                                        {{ $location->shipping_location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" name="delivery_address" list="previousAddress"
                                                   class="form-control" id="inputAddress"
                                                   placeholder="Enter delivery location"
                                                   value="@if($address){{ $address->address }}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right mb-2">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            var path = location.href;
            var hash = path.split('user/')[1];
            console.log(hash);

            var active_class = hash;

            $('.orders').attr('id', '');
            $('.info').attr('id', '');
            $('.wishlists').attr('id', '');
            $('.address').attr('id', '');

            $('.' + active_class).attr('id', 'defaultOpen');
            document.getElementById("defaultOpen").click();
        });
    </script>

    <script>
        function getQuery(url) {
            var query = {},
                href = url || window.location.href;
            href.replace(/[?&](.+?)=([^&#]*)/g, function (_, key, value) {
                query[key] = decodeURI(value).replace(/\+/g, ' ');
            });
            return query;
        }

        function getParam(name) {
            var obj = getQuery();
            return obj[name];
        }

        $(document).ready(function () {
            var target = getParam('target');
            $('.nav a[href="#' + target + '"]').tab('show');

            $('.orders').attr('id', '');
            $('.info').attr('id', '');
            $('.wishlists').attr('id', '');
            $('.address').attr('id', '');

            $('.' + target).attr('id', 'defaultOpen');
            // var tech = getUrlParameter('technology');
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                // $(".tab").addClass("active"); // instead of this do the below
                $(this).removeClass("btn-default").addClass("btn-primary");
            });
        });
    </script>
    <script>
        $('#cancel_order').on('click', function () {
            alert("Contact Customer Support to Cancel Your Order");
        });
    </script>

    {{--script for form validation with ajax submit--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $("body").on('submit', 'form.change_password', function (e) {

                e.preventDefault();

                let myForm = document.getElementById('change_password');
                let formData = new FormData(myForm);


                $.ajax({
                    type: 'post',
                    url: '{{ route('change_pswd') }}',
                    // data: $('form').serialize(),
                    // dataType: "JSON",
                    data: formData,
                    // data: new FormData($('form')),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        window.location = response.route;
                    },
                    error: function (response) {
                        console.log(response.responseJSON.errors);

                        //remove error form fields
                        $("#title").parent('div.form-group').removeClass('has-error');
                        $("#stock_quantity").parent('div.form-group').removeClass('has-error');

                        $(".error_form").empty();
                        $(".error_form").show();
                        $(".error_message").empty();
                        $(".error_message").show();

                        $(".error_form").append("<p>Password Not Changed</p>");

                        if (response.responseJSON.errors === 'Your Old Password does not Match') {
                            console.log('hello');
                            $("#old_password").parent('div.form-group').addClass('has-error');
                            $('#old_password_error').append('<p>Your Old Password Does Not Match"</p>');
                        } else {
                            $.each(response.responseJSON.errors, function (key, item) {
                                // jquery(".alert-danger").show();
                                // $(".error_package").append("<p>"+item+"</p>");
                                if (item === 'Please Enter Old Password') {
                                    $("#old_password").parent('div.form-group').addClass('has-error');
                                    $('#old_password_error').append('<p>Please enter this field."</p>');
                                }
                                if (item === 'The new password and confirm password must match.') {
                                    $("#confirm_password").parent('div.form-group').addClass('has-error');
                                    $('#confirm_password_error').append('<p>' + item + '</p>');
                                }
                                if (item === 'Please Enter The New Password Again') {
                                    $("#new_password").parent('div.form-group').addClass('has-error');
                                    $('#new_password_error').append('<p>Please enter this field.</p>');
                                }
                                if (item === 'The new password field is required when confirm password is present.') {
                                    $("#new_password").parent('div.form-group').addClass('has-error');
                                    $('#new_password_error').append('<p>' + item + '</p>');
                                }
                            });
                        }
                    }

                });

            });

        });
    </script>


@endsection