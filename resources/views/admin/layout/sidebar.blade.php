<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

                {{--<img src="{{asset(session('user')->image)}}" class="img-circle" alt="User Image">--}}

            </div>


        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            {{--<li class="header" style="text-transform: uppercase; color: white; font-size: 18px;">{{session('user')->first_name." ".session('user')->last_name}}</li>--}}
            <li  class="active ">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>
            {{--<li class="treeview">--}}
                {{--<a href="{{route('all-messages')}}">--}}
                    {{--<i class="fa fa-envelope"></i>--}}
                    {{--<span>Message</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<span class="label label-primary pull-right"></span>--}}
            {{--</span>--}}
                {{--</a>--}}

            {{--</li>--}}
            <li  class="active ">
                <a href="{{'/admin/addProfile'}}">
                    <i class="fa fa-user"></i>
                    <span>My Profile</span>
                </a>

            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Product</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{'/add_products'}}"><i class="fa fa-circle-o"></i> Add Product</a></li>
                    <li><a href="{{route('all_products')}}"><i class="fa fa-circle-o"></i> View Product</a></li>




                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Setup</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{'/add_categories'}}"><i class="fa fa-circle-o"></i> Add Category</a></li>
                    <li><a href="{{route('manage_setting')}}"><i class="fa fa-circle-o"></i> Manage Page Info</a></li>
                    <li><a href="{{'/subscriber'}}"><i class="fa fa-circle-o"></i> Subscribers</a></li>



                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Banner Setup</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="{{'/background'}}"><i class="fa fa-circle-o"></i> View Banner</a></li>
                    <li><a href="{{'/add-background'}}"><i class="fa fa-circle-o"></i> Add Banner</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Ads Setup</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="{{route('view_ads')}}"><i class="fa fa-circle-o"></i> View Ads</a></li>
                    <li><a href="{{route('add_ads')}}"><i class="fa fa-circle-o"></i> Add Ads</a></li>

                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>