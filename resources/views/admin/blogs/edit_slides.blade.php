@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Blog Page Sliders</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('edit-blog-slides')}}"
                              accept-charset="UTF-8" class=""
                              enctype="multipart/form-data">
                            @csrf
<input type="hidden" value="{{$blogslide->id}}" name="id">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="title" class="control-label">Title</label>
                                                <input class="form-control" name="title" value="{{$blogslide->title}}"
                                                       type="text" id="title">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="category" class="control-label">Category</label>
                                                <select name="category" class="form-control" id="category">
                                                    <option disabled selected>Select Category</option>
                                                    @foreach($category as $value)
                                                        <option @if($blogslide->category_id==$value->id) selected @endif value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="desc" class="control-label">Description</label>
                                                <textarea class="form-control" name="description" id="desc">{{$blogslide->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="link_1" class="control-label">Link 1(know more)</label>
                                                <input class="form-control" name="link_1" value="{{$blogslide->link_1}}" type="text" id="link_1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="link_2" class="control-label">Link 2(Product Link)</label>
                                                <input class="form-control" name="link_2" value="{{$blogslide->link_2}}" type="text" id="link_2">
                                            </div>
                                        </div>

                                    </div>
                                    <label>Current Images</label>
                                    <div class="row">

                                        <div class="col-sm-4">
                                                <div class="container">
                                                    <img src="{{asset('images/blogs/blogslides/'.$blogslide->image)}}" height="250px" width="550px">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Image</label>
                                                <input class="form-control" name="image" type="file" id="name">
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Sliders</button>
                                    <a href="{{route('blog-add-slides')}}" class="btn btn-info"><i class="fa fa-backward"></i>
                                    </a>                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </form>
                    </div>
                    <!-- ./card-body -->
                    <!-- /.card-footer -->
                </div>
            </div>

            <!-- /.col -->
        </div>
    </div>


@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function () {

            ClassicEditor
                .create(document.querySelector('#desc'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(\Illuminate\Support\Facades\Session::has('success'))
        toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}");
        @endif
        @if(\Illuminate\Support\Facades\Session::has('error'))
        toastr.error("{{\Illuminate\Support\Facades\Session::get('error')}}");
        @endif
        @if(\Illuminate\Support\Facades\Session::has('info'))
        toastr.info("{{\Illuminate\Support\Facades\Session::get('info')}}");
        @endif
        @if ($errors->any())
        @foreach($errors->all() as $error)
        toastr.warning("{{ $error }}");
        @endforeach
        @endif
    </script>
@endsection
