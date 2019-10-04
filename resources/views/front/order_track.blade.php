@extends('front.master_front')
@section('title', 'Track Your Order')

@section('content')

    <section id="tabs" class="project-tab">
        @if(session('error'))
            <div class="alert alert-danger success-msg center">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="success_msg" aria-label="Close">
                    {{--<span aria-hidden="true">&times;</span>--}}
                </button>
            </div>
        @endif
        <div class="container" style="padding: 20px 20px">
            <h2 class="text-center">Track Your Order</h2>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-10 center">
                    <form id="track_code" class="product_data" action="{{ route('post_track_code') }}" method="post">
                        @csrf
                        {{--<div class="form-group">--}}
                            {{--<label for="email">Email:</label>--}}
                            {{--<input type="email" id="email" name="email" class="form-control" placeholder="Confirm Your Email" required>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="code">Track Code:</label>
                            <input type="text" id="code" name="code" class="form-control" placeholder="Enter Order Code" required>
                            <span id="error_code" style="display:none; color: red"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="center">
                    <div class="order_details" style="margin-top: 20px">

                        @if(session()->has('order'))
                            @php $order= \Session::get('order')  @endphp
                            <div class="center" style="padding-bottom: 20px">
                                <h3>Status : <span class="alert alert-{{$order->status_color}}">{{ $order->status_text }}</span></h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-responsive table-bordered">
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
                                                        <img class="cart_image_size" style="height: 100px; width: auto"
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    {{--<script>--}}
        {{--$(function () {--}}

            {{--$("body").on('submit', 'form.product_data', function (e) {--}}

                {{--e.preventDefault();--}}
                {{--let myForm = document.getElementById('track_code');--}}
                {{--let formData = new FormData(myForm);--}}
                {{--$('#error_code').empty();--}}
                {{--$('#error_code').hide();--}}
                {{--$.ajax({--}}
                    {{--type: 'post',--}}
                    {{--url: '{{ route('post_track_code') }}',--}}
                    {{--// data: $('form').serialize(),--}}
                    {{--// dataType: "JSON",--}}
                    {{--data: formData,--}}
                    {{--// data: new FormData($('form')),--}}
                    {{--contentType: false,--}}
                    {{--cache: false,--}}
                    {{--processData: false,--}}
                    {{--success: function (response) {--}}
                        {{--// window.location = response.route;--}}
                        {{--console.log('found');--}}
                        {{--$(".order_details").load(" .order_details");--}}
                    {{--},--}}
                    {{--error: function (response) {--}}
                        {{--console.log(response.responseJSON.error);--}}
                        {{--$('#error_code').show();--}}
                        {{--$('#error_code').append('<p>'+response.responseJSON.error+'</p>');--}}

                    {{--}--}}

                {{--});--}}

            {{--});--}}

        {{--});--}}
    {{--</script>--}}

@endsection