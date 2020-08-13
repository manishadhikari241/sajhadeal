@extends('front.master_front')
@section('title','Contact Us')
@section('styles')

    <link rel="stylesheet" href="{{asset('front/css/blogs/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection
@section('content')
    <section class="site-section pt-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="banner owl-carousel">
                        @foreach($blogslides as $value)
                            <div>
                                <div class="a-block d-flex align-items-center height-lg"
                                     style="background-image: url('{{url('images/blogs/blogslides/'.$value->image)}}'); ">
                                    <div class="text half-to-full">
                                        <span class="category mb-5">{{$value->categories->name}}</span>

                                        <h3>{{$value->title}}</h3>
                                        <p>{!! $value->description !!}</p>
                                        <a href="{{$value->link_1}}" class="btn btn-success"
                                           style="background-color: #FE671E">Click to Buy
                                            Now
                                        </a>
                                        <a href="{{$value->link_2}}" class="btn btn-success"
                                           style="background-color: #FE671E">Click to Buy
                                            Now
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>


    </section>

    <section class="site-section py-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if(isset($blogfromcategory))
                        <h2 class="mb-4">{{$categoryname}}</h2>
                    @else
                        <h2 class="mb-4">Latest Posts</h2>

                    @endif
                </div>
            </div>
            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="row">
                        @if(isset($blogs))
                            @foreach($blogs as $value)
                                <div class="col-md-6">
                                    <a href="{{route('blogs-single',$value->slug)}}" class="blog-entry"
                                       data-animate-effect="fadeIn">
                                        <img src="{{asset('images/blogs/blogimages/'.$value->images->first()->image)}}"
                                             alt="Image placeholder" style="height: 300px;">
                                        <div class="blog-content-body">
                                            <div class="post-meta">
                                                <span class="mr-2">{{\Illuminate\Support\Carbon::make($value->created_at)->format('M-d-Y')}} </span>
                                                &bullet;
                                                {{--<span class="ml-2"><span class="fa fa-comments"></span> 3</span>--}}
                                            </div>
                                            <h2>{{$value->title}}</h2>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                        @if(isset($blogfromcategory))
                            @foreach($blogfromcategory as $value)
                                <div class="col-md-6">
                                    <a href="{{route('blogs-single',$value->slug)}}" class="blog-entry"
                                       data-animate-effect="fadeIn">
                                        <img src="{{asset('images/blogs/blogimages/'.$value->images->first()->image)}}"
                                             alt="Image placeholder" style="height: 300px;">
                                        <div class="blog-content-body">
                                            <div class="post-meta">
                                                <span class="mr-2">{{\Illuminate\Support\Carbon::make($value->created_at)->format('M-d-Y')}} </span>
                                                &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                            </div>
                                            <h2>{{$value->title}}</h2>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        @endif
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    @if(isset($blogs))

                                        {{$blogs->render()}}
                                    @endif
                                    {{--@if(isset($blogcategory))--}}

                                    {{--{{$blogcategory->render()}}--}}
                                    {{--@endif--}}


                                </ul>
                            </nav>
                        </div>
                    </div>


                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                {{--<div class="sidebar-box search-form-wrap">--}}
                {{--<form action="#" class="search-form">--}}
                {{--<div class="form-group">--}}
                {{--<span class="icon fa fa-search"></span>--}}
                {{--<input type="text" class="form-control" id="s"--}}
                {{--placeholder="Type a keyword and hit enter">--}}
                {{--</div>--}}
                {{--</form>--}}
                {{--</div>--}}
                <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="container-fluid">
                            <div class="row ">
                                @foreach($advertisement as $adv)
                                    <div class=""><a href="{{$adv->link}}"><img
                                                    src="{{asset('images/blogs/blogadvertisement/'.$adv->image)}}" width="100%"
                                                    height="150px"
                                                    alt=""></a></div>
                                @endforeach
                            </div>
                            <br>

                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach($popular as $blog)
                                    <li>
                                        <a href="">
                                            <img src="{{asset('images/blogs/blogimages/'.$blog->images->first()->image)}}"
                                                 alt="Image placeholder"
                                                 class="mr-4">
                                            <div class="text">
                                                <h4>{{$blog->title}}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">{{\Illuminate\Support\Carbon::make($blog->created_at)->format('M-d-Y')}} </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            @foreach($all_category as $category)
                                <li><a href="{{route('blog-category',$category->slug)}}">{{$category->name}}
                                        <span>({{count(\App\Blogs::where('category_id',$category->id)->get())}})</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            @foreach($tags as $tag)
                                <li><a href="javascript:void(0)">{{$tag->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>

@endsection
@section('script')

    <script src="{{asset('front/blog/main.js')}}"></script>


@endsection