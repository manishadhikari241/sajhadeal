@extends('admin.layout.master')
@section('content')
    <div class="container-fluid main-wrapper">
        @if(\App\Background::all()->count() >= 5)
            <strong>All Banners are Full</strong>
            <div>
                <a href="{{ route('background') }}" class="btn btn-primary">Go Back</a>
            </div>
        @else
        <div class="row">
            <!-- left column -->
            <div class="col-md-6 offset-md-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Background Images</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{  route('save-background') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       placeholder="Enter Title" name="title">
                            </div>
                            <div class="form-group">

                                <div class="input-group">
                                    <input id="fakeUploadLogo" class="form-control fake-shadow"
                                           placeholder="Choose File" disabled="disabled">
                                    <div class="input-group-btn">
                                        <div class="fileUpload btn btn-danger fake-shadow">
                                            <span><i class="glyphicon glyphicon-upload"></i> Upload Photo</span>
                                            <input id="logo-id" name="logo" type="file" class="attachment_upload"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <p class="help-block">* Upload Logo *</p>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="slideshow">
                                    <option value="1"  @if($slide>=3) disabled="disabled" @endif >SlideShow</option>
                                    <option value="2" @if($arrival >=2) disabled="disabled" @endif>New Arrival</option>
                                    {{--<option value="3" @if($special >=5) disabled="disabled" @endif>Specials</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection