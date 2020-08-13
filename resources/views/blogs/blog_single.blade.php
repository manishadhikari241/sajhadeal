@extends('front.master_front')
@section('title','Contact Us')
@section('styles')

    <link rel="stylesheet" href="{{asset('front/css/blogs/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')



    <section class="site-section py-lg">
        <div class="container">

            <div class="row blog-entries">

                <div class="col-md-12 col-lg-8 main-content">
                    <img src="{{asset('images/blogs/blogimages/'.$blog->images->first()->image)}}" style="height: 300px"
                         alt="{{$blog->images()->first()->blogimageseos != null ? $blog->images()->first()->blogimageseos->alt_tag:'' }}"
                         class="img-fluid mb-5">
                    <div class="post-meta">

                        <span class="mr-2">{{\Illuminate\Support\Carbon::make($blog->created_at)->format('M-d-Y')}}</span>
                        &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                    </div>
                    <h1 class="mb-4">{{$blog->title}}</h1>
                    @foreach($blog->tags as $tag)
                        <a class="category mb-5" href="#">{{$tag->name}}</a>
                    @endforeach

                    <div class="post-content-body">
                        <p>{!! $blog->description !!}</p>
                        <br>
                        <div class="row mb-5">
                            {{--@foreach($blog->images as $image)--}}
                            @foreach($blog->images->slice(0,1) as $img)
                                <div class="col-md-12 mb-4">
                                    <img src="{{asset('images/blogs/blogimages/'.$img->image)}}" style="height: 300px"
                                         alt="{{$img->blogimageseos != null ? $img->blogimageseos->alt_tag:'' }}"
                                         class="img-fluid">
                                </div>
                            @endforeach
                            @foreach($blog->images->slice(1,2) as $small)
                                <div class="col-md-6 mb-4">
                                    <img src="{{asset('images/blogs/blogimages/'.$small->image)}}" style="height: 300px"
                                         alt="{{$small->blogimageseos != null ? $small->blogimageseos->alt_tag:'' }}"
                                         class="img-fluid">
                                </div>
                            @endforeach
                            {{--@endforeach--}}

                        </div>
                        <p>{!! $blog->description_2 !!}</p>
                    </div>


                    <div class="pt-5">
                        <p>Categories:
                            <a href="#">Food</a>,
                            <a href="#">Travel</a>
                            Tags: <a href="#">#manila</a>,
                            <a href="#">#asia</a></p>
                    </div>


                    <div class="pt-5">
                        <section class="gallery-block cards-gallery">
                            <div class="container">
                                <div class="heading">
                                    <h2>Check Our Gallery</h2>
                                </div>
                                <div class="row">
                                    @foreach($blog->images as $image)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card border-0 transform-on-hover">
                                                <a class="lightbox"
                                                   href="{{asset('images/blogs/blogimages/'.$image->image)}}">
                                                    <img src="{{asset('images/blogs/blogimages/'.$image->image)}}"
                                                         alt="{{$image->blogimageseos != null ? $image->blogimageseos->alt_tag:'' }}"
                                                         class="card-img-top">
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>


                        <!-- END comment-list --></div>

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
                        <div class="bio text-center">
                            <img src="{{asset('images/blogs/abc.jpg')}}" alt="Image Placeholder" class="img-fluid">
                            <div class="bio-body">
                                <h2>{{$blog->authors->name}}</h2>
                                <p>{!! $blog->authors->description !!}</p>
                                {{--<p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>--}}
                                {{--<p class="social">--}}
                                {{--<a href="#" class="p-2"><span class="fa fa-facebook"></span></a>--}}
                                {{--<a href="#" class="p-2"><span class="fa fa-twitter"></span></a>--}}
                                {{--<a href="#" class="p-2"><span class="fa fa-instagram"></span></a>--}}
                                {{--<a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach($popular as $blog)
                                    <li>
                                        <a href="{{route('blogs-single',$blog->slug)}}">
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

    <div class="row-mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-3 ">Related Post</h2>
                </div>
            </div>
            <div class="row">
                @foreach($related as $value)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{route('blogs-single',$value->slug)}}"
                           class="a-block sm d-flex align-items-center height-md"
                           style="background-image: url({{url('images/blogs/blogimages/'.$value->images->first()->image)}}); ">
                            <div class="text">
                                <div class="post-meta">
                                    <span class="category">{{$value->categories->name}}</span>
                                    <span class="mr-2">{{\Illuminate\Support\Carbon::make($value->created_at)->format('M-d-Y')}}  </span>
                                    &bullet;
                                    {{--<span class="ml-2"><span class="fa fa-comments"></span> 3</span>--}}
                                </div>
                                <h3>{{$value->title}}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
    <!-- END section -->


    <!-- loader -->
    <div id="loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                    stroke="#f4b214"/>
        </svg>
    </div>

@endsection
@section('script')

    <script src="{{asset('front/blog/main.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.cards-gallery', {animation: 'slideIn'});
    </script>
@endsection