<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">

    {{--add_category--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



    <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">

    @yield('styles')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Frontend</a>
            </li>
        </ul>

    {{--<!-- SEARCH FORM -->--}}
    {{--<form class="form-inline ml-3">--}}
    {{--<div class="input-group input-group-sm">--}}
    {{--<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
    {{--<div class="input-group-append">--}}
    {{--<button class="btn btn-navbar" type="submit">--}}
    {{--<i class="fa fa-search"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}

    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            {{--<li class="nav-item dropdown">--}}
                {{--<a class="nav-link" data-toggle="dropdown" href="#">--}}
                    {{--<i class="fa fa-bell fa-2x"></i>--}}
                    {{--<span class="badge badge-warning navbar-badge">10</span>--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
                    {{--<span class="dropdown-item dropdown-header">15 Notifications</span>--}}
                    {{--<div class="dropdown-divider"></div>--}}

                    {{--unread notifications--}}
                    {{--<a href="#" class="dropdown-item">--}}
                        {{--<i class="fa fa-file mr-2"></i> 3 new reports--}}
                        {{--<span class="float-right text-muted text-sm">2 days</span>--}}
                    {{--</a>--}}

                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a href="" class="dropdown-item dropdown-footer">See All--}}
                        {{--Notifications</a>--}}
                {{--</div>--}}
            {{--</li>--}}

            {{--User Dropdown--}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-2x"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa fa-sign-out mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <!--<a href="" class="dropdown-item dropdown-footer">-->
                    <!--    <i class="fa fa-edit mr-2"></i>-->
                    <!--    Edit Account-->
                    <!--</a>-->
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <div class="content-wrapper">

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('admin_lte/dist/img/AdminLTELogo.png') }}" alt="Website Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span>Admin</span>
                <br>
                <span class="brand-text font-weight-light">Website Name</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="padding-bottom: 50px">
                <!-- Sidebar user panel (optional) -->
                {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
                    {{--<div class="image">--}}
                        {{--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                    {{--</div>--}}
                    {{--<div class="info">--}}
                        {{--<a href="#" class="d-block">Alexander Pierce</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Dashboard
                                    {{--<i class="right fa fa-angle-left"></i>--}}
                                </p>
                            </a>
                        </li>

                        {{--<li class="nav-item ">--}}
                            {{--<a href="#" class="nav-link">--}}
                                {{--<i class="nav-icon fa fa-pie-chart"></i>--}}
                                {{--<p>--}}
                                    {{--My profile--}}
                                {{--</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>
                                    Setup
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('add_category') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('add_tag') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Tags</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin_brands') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Brands</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('color_size') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Size</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('manage_setting')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Manage Page Info</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{'/subscriber'}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Subscribers</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>
                                    Products
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('all_products') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>View Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('product_add')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Products</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>
                                    Coupons
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('all_coupons') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>View Coupons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('add_coupon')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Coupons</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('location-view')}}" class="nav-link">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>
                                    Shipping Rates
                                    {{--<i class="fa fa-angle-left right"></i>--}}
                                </p>
                            </a>

                        </li>
                                                <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-plane"></i>
                                <p>
                                    Orders
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('order_pending') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Pending Orders</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('order_delivered')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Delivered Orders</p>
                                    </a>
                                </li>
                                    <li class="nav-item">
                                    <a href="{{route('order_cancel')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Cancelled Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin_orders') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>
                                            All Orders
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('all_users') }}" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all-messages') }}" class="nav-link">
                                <i class="nav-icon fa fa-mail-forward"></i>
                                <p>
                                    Messages
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-sticky-note"></i>
                                <p>
                                    Banner Setup
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('background') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>View banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('add-background')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Banner</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-sticky-note"></i>
                                <p>
                                    Special Section
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('view_special') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>View Special Section</p>
                                    </a>
                                </li>
                                {{--<li class="nav-item">--}}
                                    {{--<a href="{{ route('add_special_price') }}" class="nav-link">--}}
                                        {{--<i class="fa fa-circle-o nav-icon"></i>--}}
                                        {{--<p>Add Special By Price</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                <li class="nav-item">
                                    <a href="{{route('add_special_category')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Add Special by Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                                                <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-sticky-note"></i>
                                <p>
                                    Advertisement
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('advertisement') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Update Advertisement</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{--<li class="nav-item has-treeview">--}}
                            {{--<a href="#" class="nav-link">--}}
                                {{--<i class="nav-icon fa fa-television"></i>--}}
                                {{--<p>--}}
                                    {{--Ads Setup--}}
                                    {{--<i class="fa fa-angle-left right"></i>--}}
                                {{--</p>--}}
                            {{--</a>--}}
                            {{--<ul class="nav nav-treeview">--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="{{ route('view_ads') }}" class="nav-link">--}}
                                        {{--<i class="fa fa-circle-o nav-icon"></i>--}}
                                        {{--<p>View Ads</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="{{route('add_ads')}}" class="nav-link">--}}
                                        {{--<i class="fa fa-circle-o nav-icon"></i>--}}
                                        {{--<p>Manage Ads</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @yield('headers')
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        {{--body section start--}}
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        {{--body section end--}}

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.0-alpha
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- ./wrapper -->
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>


<!-- jQuery -->
<script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('admin_lte/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin_lte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin_lte/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('admin_lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('admin_lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('admin_lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin_lte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_lte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin_lte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_lte/dist/js/demo.js')}}"></script>


{{--SELECT 2--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

@yield('script')

</body>
</html>
