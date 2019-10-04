@extends('admin.layout.master')
@section('content')

    {{--create ad--}}

    <div class="main-wrapper">
        @if($ad == 4)
            <strong>All Ads are Full</strong>
            <div>
                <a href="{{ route('view_ads') }}" class="btn btn-primary">Go Back</a>
            </div>
        @else
        <div class="card col-md-12" style="background-color: #f4f6f9">
            <div class="card-body">
                @if(session('error'))
                    <span class="alert alert-danger">{{ session('error') }}</span>
                @endif
                <h1 class=" text-dark">Create an Ad</h1>
            </div>
            <form action="{{  route('post_ads') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Add Title</label>

                    <input type="text" class="form-control" name="name"
                           placeholder="Enter the Name of Ad" id="title">
                </div>
                <hr>
                <label for="">Add Image for the Ad</label><br>
                <div class="form-group">
                    <input type="file" class="form-control" name="image">
                </div>
                <hr>
                <div class="form-group">
                    <h3>Area to Display Ad </h3><br>
                    <input type="radio" name="display_area" value="1" checked><label> Home
                        page-top</label> <br>
                    <input type="radio" name="display_area" value="2"><label> Home
                        page-bottom</label><br>
                    <input type="radio" name="display_area" value="3"><label> Categories
                        page-top</label> <br>
                    <input type="radio" name="display_area" value="4"><label> Categories
                        page-bottom</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
    @endif
@endsection