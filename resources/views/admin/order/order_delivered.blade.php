@extends('admin.layout.master')

@section('content')

    <div class="container box">
        <div class="row justify-content-center">
            <h2>Deivered Orders</h2>
            <div class="col-md-12">
                {{--<div>--}}
                {{--Sort BY: Year <select name="year" id="sortbyyear">--}}
                {{--<option value="">....</option>--}}
                {{--<option value="2018">2018</option>--}}
                {{--<option value="2019">2019</option>--}}
                {{--<option value="2020">2020</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                <div class="card">
                    <table id="package_table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Order ID</th>
                            <th>Date Ordered</th>
                            {{--<th>Shipping Date</th>--}}
                            <th>Preview</th>
                            {{--<th>Paid</th>--}}
                            <!--<th>Delivery details:</th>-->
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <!--<button class="btn btn-sm btn-success" data-toggle="modal"-->
                                    <!--        data-target="#user_modal{{ $order->id }}">{{ $order->user->id }}</button>-->
                                    <!--{{--user modal--}}-->
                                    {{ $order->first_name }}
                                    <div class="modal fade" id="user_modal{{ $order->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">User Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="user-profile-list">
                                                        <li><span>ID:&nbsp;</span>{{ $order->user->id }}</li>
                                                        <li><span>Name:&nbsp;</span>{{ $order->first_name }}&nbsp;{{ $order->last_name }}</li>
                                                        <li><span>Country:&nbsp;</span>Nepal</li>
                                                        <li><span>Email:&nbsp;</span>{{ $order->user->email }}</li>
                                                        <li><span>Phone:&nbsp;</span>{{ $order->user->phone }}</li>
                                                        <li><span>Date joined:&nbsp;</span>{{ $order->user->created_at }}</li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$order->order_track}}</td>
                                <td>{{ $order->order_date }}</td>
                                {{--<td>{{ $order->shipping_date }}</td>--}}
                                <td>
                                    <button id="formButton" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#order_details{{$order->id}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <div class="modal fade" style="overflow-y: auto;" id="order_details{{$order->id}}"
                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-responsive" style="max-width: 680px!important;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLongTitle">Order
                                                        Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4>User Details</h4>
                                                            <ul class="user-profile-list">
                                                                <li><strong>ID</strong>:&nbsp;{{ $order->user->id }}</li>
                                                                <li><strong>Name</strong>:&nbsp;{{ $order->first_name }}</li>
                                                             
                                                                <li><strong>Email</strong>:&nbsp;{{ $order->user->email }}</li>
                                                                <li><strong>Phone</strong>:&nbsp;{{ $order->phone }}</li>
                                                                <li><strong>Order ID</strong>:&nbsp;{{ $order->order_track}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4>Delivery Details</h4>
                                                            <div>
                                                                <strong><span>Location : </span></strong>
                                                                <span class="pull-right">{{ $order->shipping->shipping_location }}</span>
                                                            </div>
                                                            <div>
                                                                <strong><span class="">Address : </span></strong>
                                                                <span class="pull-right">{{ $order->address }}</span>
                                                            </div>
                                                            <div>
                                                                <strong><span class="">Phone : </span></strong>
                                                                <span class="pull-right">{{ $order->phone }}</span>
                                                            </div>
                                                            <div>
                                                                <strong><span class="">Note : </span></strong>
                                                                <span class="pull-right">{{ $order->last_name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h4>Order Items</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <td></td>
                                                                <td>Product Name</td>
                                                                <td>SKU</td>
                                                                <td>Size</td>
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
                                                                                     alt="product-img" style="max-height:200px; max-width:auto;">
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="align-middle">{{ $orderDetail->product->title }}</td>
                                                                    <td>{{ $orderDetail->product->sku }}</td>
                                                                    <td>{{ $orderDetail->size }}</td>
                                                                    <td class="align-middle">{{ $orderDetail->quantity }}</td>
                                                                    <td class="align-middle">
                                                                        Rs.{{ $orderDetail->price }}</td>
                                                                    <td class="align-middle">
                                                                        Rs.{{ $orderDetail->total }}</td>
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
                                {{--<td>--}}
                                {{--@if($order->order_payment)--}}
                                {{--<button class="btn btn-sm btn-success" data-toggle="modal"--}}
                                {{--data-target="#payment_modal{{ $order->id }}">--}}
                                {{--Paid--}}
                                {{--</button>--}}
                                {{--<div class="modal fade" id="payment_modal{{$order->id}}" tabindex="-1"--}}
                                {{--role="dialog"--}}
                                {{--aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
                                {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                                {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                {{--<h5 class="modal-title" id="exampleModalLongTitle">Online Payment</h5>--}}
                                {{--<button type="button" class="close" data-dismiss="modal"--}}
                                {{--aria-label="Close">--}}
                                {{--<span aria-hidden="true">&times;</span>--}}
                                {{--</button>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body">--}}
                                {{--<div>--}}
                                {{--<strong><span>Type : </span></strong>--}}
                                {{--<span class="pull-right">{{ $order->order_payment->type }}</span>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                {{--<strong><span class="">Date : </span></strong>--}}
                                {{--<span class="pull-right">{{ $order->payment_date }}</span>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                {{--<strong><span class="">Token : </span></strong>--}}
                                {{--<span class="pull-right">{{ $order->order_payment->token }}</span>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                {{--<button type="submit" class="btn btn-sm btn-primary btn-submit">--}}
                                {{--Confirm--}}
                                {{--</button>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@else--}}
                                {{--@if($order->paid == 1)--}}
                                {{--<span class="badge badge-success">Paid</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">Un-Paid</span>--}}
                                {{--@endif--}}
                                {{--@endif--}}
                                {{--</td>--}}
                                <!--<td>-->
                                <!--    <button class="btn btn-sm btn-success" data-toggle="modal"-->
                                <!--            data-target="#delivery_address_modal{{ $order->id }}">-->
                                <!--        View-->
                                <!--    </button>-->
                                <!--    <div class="modal fade" id="delivery_address_modal{{$order->id}}" tabindex="-1"-->
                                <!--         role="dialog"-->
                                <!--         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
                                <!--        <div class="modal-dialog modal-dialog-centered" role="document">-->
                                <!--            <div class="modal-content">-->
                                <!--                <div class="modal-header">-->
                                <!--                    <h5 class="modal-title" id="exampleModalLongTitle">Delivery-->
                                <!--                        Detials</h5>-->
                                <!--                    <button type="button" class="close" data-dismiss="modal"-->
                                <!--                            aria-label="Close">-->
                                <!--                        <span aria-hidden="true">&times;</span>-->
                                <!--                    </button>-->
                                <!--                </div>-->
                                <!--                <div class="modal-body">-->
                                <!--                    <div>-->
                                <!--                        <strong><span>Location : </span></strong>-->
                                <!--                        <span class="pull-right">{{ $order->shipping->shipping_location }}</span>-->
                                <!--                    </div>-->
                                <!--                    <div>-->
                                <!--                        <strong><span class="">Address : </span></strong>-->
                                <!--                        <span class="pull-right">{{ $order->address }}</span>-->
                                <!--                    </div>-->
                                <!--                    <div>-->
                                <!--                        <strong><span class="">Phone : </span></strong>-->
                                <!--                        <span class="pull-right">{{ $order->phone }}</span>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="modal-footer">-->
                                <!--                    {{--<button type="submit" class="btn btn-sm btn-primary btn-submit">--}}-->
                                <!--                    {{--Confirm--}}-->
                                <!--                    {{--</button>--}}-->
                                <!--                </div>-->
                                <!--                </form>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</td>-->
                                <td>
                                    @if($order->paid==0)
                                        <span>Rs.{{ $order->final_total }}</span>
                                    @else
                                        <span style=" text-decoration: line-through;">Rs.{{ $order->final_total }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td>
                                    <button id="formButton" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#change_status{{$order->id}}">Change Status
                                    </button>
                                    <div class="modal fade" id="change_status{{$order->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form id="" method="post"
                                                      action="{{ route('change_status',$order->id) }}">

                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Change
                                                            Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>Paid</label>
                                                        <input type="radio" name="paid" value="1"
                                                               @if($order->paid == 1) checked="checked" @endif
                                                        > Yes
                                                        <input type="radio" name="paid" value="0"
                                                               @if($order->paid == 0) checked="checked" @endif
                                                        > No
                                                        <br>
                                                        <label>Delivered</label>
                                                        <input type="radio" name="delivered" value="1"
                                                               @if($order->delivered == 1) checked="checked" @endif
                                                        > Yes
                                                        <input type="radio" name="delivered" value="0"
                                                               @if($order->delivered == 0) checked="checked" @endif
                                                        > No
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-sm btn-primary btn-submit">
                                                            Confirm
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if($order->status == 1)
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                data-target="#cancel_order{{$order->id}}">Cancel
                                        </button>
                                        <div class="modal fade" id="cancel_order{{$order->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Cancel Order
                                                            !!</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want to cancel this order?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('cancel_order',$order->id) }}"
                                                           class="btn btn-primary">Yes</a>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ asset('admin/js/tables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/tables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#package_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "aaSorting": [[ 2, "desc" ]],
                "stateSave": true,
            });
        });
    </script>
    <script>
        $("#formButton").on('click', function () {
            $("#status_form").toggle();
        });
    </script>
    <script>
        $(".btn-submit").submit(function () {

        })
    </script>

@endsection