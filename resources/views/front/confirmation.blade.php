@extends('front.master_front')
@section('title', 'Order Confirmation')
@section('content')


<section class="section">
    <div class="container" style="padding-bottom: 80px">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="block text-center">
                    <h3 class="text-center mb-3">Thank you! For Shopping With Us</h3>
                    @if(session('success'))
                        <span class="alert alert-success">{{ session('success') }}</span>
                    @endif
                    <p class="text-color">Your order has been placed and will be processed as soon as possible. Make
                        sure you make note of your order number, which is <span
                                class="text-primary">{{ session('track_code') }}</span>
                </div>
                <div class="block text-center" style="padding-top: 20px">
                    <a href="/" class="btn btn-primary mt-3 mx-2">Go To Shopping</a>
                    <a href="/track_order" class="btn btn-dark mt-3 mx-2">Track order</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.page-warpper -->

@endsection