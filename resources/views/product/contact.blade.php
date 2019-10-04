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
                        <h1 class="strong-header pull-left">Contact</h1>

                        <!-- BREADCRUMBS -->
                        <ul class="breadcrumbs list-inline pull-right">
                            <li><a href="/index">Home</a></li>
                            <!--
                                           -->
                            <li>Contact</li>
                        </ul>
                        <!-- !BREADCRUMBS -->
                    </div>
                </header>
            </div>
        </div>
        <!-- !full-width -->
        <div class="container">
            <!-- !FULL WIDTH -->

            <section class="row">
                <div class="col-md-8">
                    <div class="section-header col-xs-12">
                        <hr>
                        <h2 class="strong-header">
                            Get in touch
                        </h2>
                    </div>
                    <div class="col-xs-12">
                        <p>
                            Whether you have any questions, comments or you would like to keep in touch, just drop us a line using
                            the form below. We'd love to connect with you.
                        </p>

                        <div class="simpleForm">
                            {{--<div class="successMessage alert alert-success alert-dismissable" style="display: none">--}}
                                {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
                                {{--Thank You! We will contact you shortly.--}}
                            {{--</div>--}}
                            {{--<div class="errorMessage alert alert-danger alert-dismissable" style="display: none">--}}
                                {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
                                {{--Ups! An error occured. Please try again later.--}}
                            {{--</div>--}}
                            <form  action="{{route('message')}}" method="post" >
                                @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field1">Your name</label>
                                                <input type="text" required name="name" class="form-control" id="field1" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field2">Your email</label>
                                                <input type="email" required name="email" class="form-control" id="field2" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field3">Your message</label>
                                        <textarea name="message" class="form-control" id="field3" rows="10" required></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Send message">

                            </form>
                        </div>
                        <!-- / simpleForm -->

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="space-30"></div>
                    <div class="section-emphasis-3 page-info">
                        <h3 class="strong-header">
                            Contact
                        </h3>

                        <div class="text-widget">
                            <address>
                                9841587656 <br>
                                info@roozeko.com
                            </address>
                        </div>
                        <br>
                        <h3 class="strong-header">
                            Location
                        </h3>

                        <div class="text-widget">
                            <address>
                                Sorhakhutte,Kathmandu<br>
                                Nepal
                            </address>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <div class="clearfix visible-xs visible-sm"></div>
    <!-- fixes floating problems when mobile menu is visible -->


    <!-- end frame -->


    <!-- !SHOP FEATURED ITEM -->


    </div>
@endsection