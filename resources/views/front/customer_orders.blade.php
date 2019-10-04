@extends('front.master_front')
@section('title', 'My Orders | Address')

@section('content')

    <section id="tabs" class="project-tab">
        <div class="container" style="padding: 20px 20px">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            {{--<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>--}}
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Orders</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Address</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">

                        {{--<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">--}}
                            {{--<div class="dashboard-wrapper dashboard-user-profile">--}}
                                {{--<div class="media">--}}
                                    {{--<div class="text-center">--}}
                                        {{--<img class="media-object user-img" src="httrack_files/images/avater.jpg" alt="Image">--}}
                                        {{--<a href="#" class="btn btn-sm mt-3 d-block">Change Image</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<ul class="user-profile-list">--}}
                                            {{--<li><span>Full Name:</span>{{ $user->first_name }} {{ $user->last_name }}</li>--}}
                                            {{--<li><span>Country:</span>Nepal</li>--}}
                                            {{--<li><span>Email:</span>{{ $user->email }}</li>--}}
                                            {{--<li><span>Phone:</span>{{ $user->phone }}</li>--}}
                                            {{--<li><span>Date joined:</span>{{ $user->created_at }}</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="dashboard-wrapper user-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date Ordered</th>
                                            {{--<th>Shipping Date</th>--}}
                                            <th>Items</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
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
                                                <td>$ {{ $order->final_total }}</td>
                                                <td>
{{--                                                    <span class="badge badge-primary">{{ $order->status_text }}</span>--}}
                                                </td>
                                                <td>
                                                    <button href="#" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#order_details{{$order->id}}">View</button>
                                                    @if($order->status == 1)
                                                        <button class="btn btn-sm btn-outline-danger" id="cancel_order">Cancel</button>
                                                    @endif

                                                    <div class="modal fade"  style="overflow-y: auto;" id="order_details{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Ordered Items</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                                                     alt="{{ $orderDetail->product->title }}"/>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td class="align-middle">{{ $orderDetail->product->title }}</td>
                                                                                    <td class="align-middle">{{ $orderDetail->quantity }}</td>
                                                                                    <td class="align-middle">${{ $orderDetail->price }}</td>
                                                                                    <td class="align-middle">${{ $orderDetail->total }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="order_summary">
                                                                        <p class="sub_total">
                                                                            <span class="">Sub-Total:</span>
                                                                            <span class="pull-right">Rs.{{ $order->subtotal }}</span>
                                                                        </p>
                                                                        <p class="shipping">
                                                                            <span class="">Shipping-Charges:</span>
                                                                            <span class="pull-right">Rs.{{ $order->shipping->shipping_price }}</span>
                                                                        </p>
                                                                        <p class="grand_total">
                                                                            <span class="">Grand-Total:</span>
                                                                            <span class="pull-right">Rs.{{ $order->total_price }} </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="dashboard-wrapper user-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->addresses as $address)
                                            <tr>
                                                <td>#</td>
                                                <td>{{ $address->address }}</td>
                                                <td>{{ $address->city }}</td>
                                                <td>{{ $address->user->phone }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"><i class="ti-pencil" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-primary"><i class="ti-close" aria-hidden="true"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('shop_scripts')
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
        $('#cancel_order').on('click',function () {
            alert("Contact Customer Support to Cancel Your Order");
        });
    </script>
@endpush