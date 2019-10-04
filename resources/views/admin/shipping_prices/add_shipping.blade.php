@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
                {{--@if(session('error'))--}}
                    {{--<span class="alert alert-danger">{{ session('error') }}</span>--}}
                {{--@endif--}}
                <h1 class=" text-dark">Add Shipping Location</h1>
            </div>
            <form action="{{  route('post_location') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Add Shipping Location</label>

                    <input type="text" class="form-control" name="name"
                           placeholder="Enter the Shipping Address" id="title" required>
                </div>
                <hr>
                <div class="form-group">
                    <h3>Shipping Rate</h3><br>
                    <input type="number" name="shipping_rate" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>

@endsection