@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
                {{--@if(session('error'))--}}
                    {{--<span class="alert alert-danger">{{ session('error') }}</span>--}}
                {{--@endif--}}
                {{--<h1 class=" text-dark">Create an Ad</h1>--}}
            </div>
            <form action="{{  route('post_edit_ads',$ad->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Add Title</label>
                    <input type="text" class="form-control" name="name"
                           placeholder="Enter the Name of Ad" value="{{ $ad->name }}" id="title">
                </div>
                <hr>
                <label for="">Add Image for the Ad</label><br>
                <div class="form-group">
                    <input type="file" class="form-control" name="image">
                </div>
                <hr>
                <div class="form-group">
                    <label for="link">Add Link</label><br>
                    <input type="text" class="form-control" name="link"
                           placeholder="Enter the link for the Ad" id="link">
                </div>
                <div class="form-group">
                    <h3>Area to Display Ad </h3><br>
                    @if($ad->display_area == 1)
                        <input type="radio" name="display_area" value="{{  $ad->display_area }}" checked><label> Home
                            page-top</label> <br>
                    @elseif($ad->display_area == 2)
                        <input type="radio" name="display_area" value="{{  $ad->display_area }}" checked><label> Home
                            page-bottom</label><br>
                    @elseif($ad->display_area == 3)
                        <input type="radio" name="display_area" value="{{ $ad->display_area  }}" checked><label>
                            Categories
                            page-top</label> <br>
                    @else
                        <input type="radio" name="display_area" value="{{  $ad->display_area }}" checked><label>
                            Categories
                            page-bottom</label>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection