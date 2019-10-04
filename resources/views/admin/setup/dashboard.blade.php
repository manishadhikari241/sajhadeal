@extends('admin.layout.master')
@section('content')

    <div class="container box">
        {{--<div class="row justify-content-center">--}}
        <div class="col-md-12">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row" style="padding-bottom: 30px">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> {{ App\Order::all()->count() }}</h3>

                                    <p>Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/admin/orders/" class="small-box-footer">More info <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $products->count() }}</h3>

                                    <p>Products</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ route('all_products') }}" class="small-box-footer">More info <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $users->count() }}</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/admin/all-users" class="small-box-footer">More info <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $message_count }}</h3>

                                    <p>Messages</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-chatboxes"></i>
                                </div>
                                <a href="{{ route('all-messages') }}" class="small-box-footer">More info <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div id="columnchart_material" style="height: 500px"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="columnchart_user" style="height: 500px"></div>
                        </div>
                    </div>

                    <!-- Main row -->

                    {{--<div class="row">--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="au-card recent-report">--}}
                                {{--<div class="au-card-inner">--}}
                                    {{--<h3 class="title-2">recent reports</h3>--}}
                                    {{--<div class="chart-info">--}}
                                        {{--<div class="chart-info__left">--}}
                                            {{--<div class="chart-note">--}}
                                                {{--<span class="dot dot--blue"></span>--}}
                                                {{--<span>products</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="chart-note mr-0">--}}
                                                {{--<span class="dot dot--green"></span>--}}
                                                {{--<span>services</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chart-info__right">--}}
                                            {{--<div class="chart-statis">--}}
                                                    {{--<span class="index incre">--}}
                                                        {{--<i class="zmdi zmdi-long-arrow-up"></i>25%</span>--}}
                                                {{--<span class="label">products</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="chart-statis mr-0">--}}
                                                    {{--<span class="index decre">--}}
                                                        {{--<i class="zmdi zmdi-long-arrow-down"></i>10%</span>--}}
                                                {{--<span class="label">services</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="recent-report__chart">--}}
                                        {{--<canvas id="recent-rep-chart"></canvas>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-6">--}}
                            {{--<div class="au-card chart-percent-card">--}}
                                {{--<div class="au-card-inner">--}}
                                    {{--<h3 class="title-2 tm-b-5">char by %</h3>--}}
                                    {{--<div class="row no-gutters">--}}
                                        {{--<div class="col-xl-6">--}}
                                            {{--<div class="chart-note-wrap">--}}
                                                {{--<div class="chart-note mr-0 d-block">--}}
                                                    {{--<span class="dot dot--blue"></span>--}}
                                                    {{--<span>products</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="chart-note mr-0 d-block">--}}
                                                    {{--<span class="dot dot--red"></span>--}}
                                                    {{--<span>services</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xl-6">--}}
                                            {{--<div class="percent-chart">--}}
                                                {{--<canvas id="percent-chart"></canvas>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="title-1 m-b-25">Latest Orders</h4>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-bordered table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        {{--<th>Order ID</th>--}}
                                        <th>Name</th>
                                        {{--<th class="text-right">Price</th>--}}
                                        {{--<th class="text-right">quantity</th>--}}
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order_item)
                                        <tr>
                                            <td>{{ $order_item->created_at }}</td>
                                            <td>{{ $order_item->order_track }}</td>
                                            {{--<td>{{ $order_item->product->title }}</td>--}}
{{--                                            <td class="text-right">Rs.{{ $order_item->price }}</td>--}}
{{--                                            <td class="text-right">{{ $order_item->quantity }}</td>--}}
                                            <td class="text-right">Rs.{{ $order_item->final_total }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 ">
                            <h4 class="title-1 m-b-25">Latest Reviews</h4>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-bordered table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th>date</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th class="text-right"><i class="fa fa-star"></i>Stars</th>
                                        <th class="text-right">Description</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{ $review->created_at }}</td>
                                            <td>{{ $review->user->first_name }}</td>
                                            <td>{{ $review->product->title }}</td>
                                            <td class="text-right">{{ $review->star }} Stars</td>
                                            <td class="text-right">{{ substr($review->description,0,7) }}....</td>
                                            <td class="text-right">
                                                <button href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#review_details{{$review->id}}">View
                                                </button>
                                                {{--@if($order->status == 1)--}}
                                                {{--<button class="btn btn-sm btn-outline-danger" id="cancel_order">Cancel</button>--}}
                                                {{--@endif--}}
                                                <div class="modal fade" id="review_details{{$review->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Reviewed by {{$review->user->first_name}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <td>Product Name</td>
                                                                            <td>Stars</td>
                                                                            <td>Title</td>
                                                                            <td>Description</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                {{ $review->product->title }}
                                                                                @foreach($review->product->images as $image)
                                                                                    @if($image->is_main==1)
                                                                                        <img class="img-fluid cart_image_size"
                                                                                             src="{{ asset($image->image) }}"
                                                                                             alt="product-img"
                                                                                             style="max-height: 50px; max-width: 100%">
                                                                                    @endif
                                                                                @endforeach
                                                                            </td>
                                                                            <td class="align-middle">{{ $review->star }}</td>
                                                                            <td class="align-middle">{{ $review->title }}</td>
                                                                            <td class="align-middle">{{ $review->description }}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="button" class="btn btn-danger">Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--./Main row -->

                </div><!-- /.container-fluid -->

            </section>
        </div>
        {{--</div>--}}
    </div>
    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-3 col-6">--}}
                {{--<!-- small box -->--}}
                {{--<div class="small-box bg-warning">--}}
                    {{--<div class="inner">--}}
                        {{--<h3>--}}
                            {{--{{  $count }}--}}
                        {{--</h3>--}}

                        {{--<p>Messages</p>--}}
                    {{--</div>--}}
                    {{--<div class="icon">--}}
                        {{--<i class="ion ion-chatboxes"></i>--}}
                    {{--</div>--}}
                    {{--<a href="{{  route('all-messages') }}" class="small-box-footer">All Messages<i class="fa fa-arrow-circle-right"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-6">--}}
                {{--<!-- small box -->--}}
                {{--<div class="small-box bg-warning">--}}
                    {{--<div class="inner">--}}
                        {{--<h3>--}}
                            {{--{{  $users->count() }}--}}
                        {{--</h3>--}}

                        {{--<p>Users</p>--}}
                    {{--</div>--}}
                    {{--<div class="icon">--}}
                        {{--<i class="ion ion-person-add"></i>--}}
                    {{--</div>--}}
                    {{--<a href="#" class="small-box-footer">All Users <i class="fa fa-arrow-circle-right"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-6">--}}
                {{--<!-- small box -->--}}
                {{--<div class="small-box bg-warning">--}}
                    {{--<div class="inner">--}}
                        {{--<h3>--}}
                            {{--{{  $orders->count() }}--}}{{--1--}}
                        {{--</h3>--}}

                        {{--<p>Orders</p>--}}
                    {{--</div>--}}
                    {{--<div class="icon">--}}
                        {{--<i class="ion ion-bookmark"></i>--}}
                    {{--</div>--}}
                    {{--<a href="{{  route('all-messages') }}" class="small-box-footer">Orders <i class="fa fa-arrow-circle-right"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-6">--}}
                {{--<!-- small box -->--}}
                {{--<div class="small-box bg-warning">--}}
                    {{--<div class="inner">--}}
                        {{--<h3>--}}
                            {{--{{  $products->count() }}--}}{{--1--}}
                        {{--</h3>--}}

                        {{--<p>Products</p>--}}
                    {{--</div>--}}
                    {{--<div class="icon">--}}
                        {{--<i class="ion ion-briefcase"></i>--}}
                    {{--</div>--}}
                    {{--<a href="#" class="small-box-footer">Total Producs <i class="fa fa-arrow-circle-right"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}


@endsection
@section('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Sales'],
                    @if(isset($graphs))
                    @foreach($graphs as $graph)
                        ['{{$graph['mon']}}',{{$graph['tot']}}],
                    @endforeach
                    @endif
            ]);





            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales Report( in Nrs. and as per months)',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Users'],

                    @foreach($user_graphs as $user_graph)
                ['{{$user_graph['mon']}}',{{$user_graph['tot']}}],
                @endforeach
            ]);





            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'User Report( in Number. and as per months)',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_user'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection