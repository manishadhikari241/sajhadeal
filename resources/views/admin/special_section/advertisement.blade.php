@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-8 offset-md-2" style="background-color: #f4f6f9">
            <div class="card-body">
                @if(session('success'))
                    <span class="success alert-success">{{ session('success') }}</span>
                @endif
                <h1 class=" text-dark">Update Advertisement</h1><br>
            </div>
            <form action="{{ route('advertisement') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="imgInp">Upload Image</label>
                    <input type=file name="advertisement_image" id="imgInp" class="form-control">
                    <div class="style-photo" style="display: none">
                        <img id="blah" src="#" alt="your image" style="width: auto; height: 200px"/>
                    </div>
                </div>
                @if(\App\Advertisement::where('image_name','=','advertisement_image')->first())
                    <div class="form-group">
                        <label for="description">Current Advertisement Image</label>
                        <div class="container">
                            <img id="category_id" data-id=""
                                 src="{{asset('images/advertisement/'.\App\Advertisement::where('image_name','=','advertisement_image')->first()->image)}}"
                                 height="50px" width="50px">
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="imgInp">Advertisement Link</label>
                    <input type=text name="advertisement_link" id="imgInp"
                           value="{{\App\Advertisement::where('image_name','=','advertisement_image')->first()?\App\Advertisement::where('image_name','=','advertisement_image')->first()->link:''}}"
                           class="form-control">
                    <div class="style-photo" style="display: none">
                        <img id="blah" src="#" alt="your image" style="width: auto; height: 200px"/>
                    </div>
                </div>
                <hr>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

