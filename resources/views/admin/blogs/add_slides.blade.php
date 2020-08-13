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
                        <h5 class="card-title">Blog Page Sliders</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('blog-add-slides')}}"
                              accept-charset="UTF-8" class=""
                              enctype="multipart/form-data">
                            @csrf

                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="title" class="control-label">Title</label>
                                                <input class="form-control" name="title" type="text" id="title">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="category" class="control-label">Category</label>
                                                <select name="category" class="form-control" id="category">
                                                    <option disabled selected>Select Category</option>
                                                    @foreach($category as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="desc" class="control-label">Description</label>
                                                <textarea class="form-control" name="description" id="desc"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="link_1" class="control-label">Link 1(know more)</label>
                                                <input class="form-control" name="link_1" type="text" id="link_1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="link_2" class="control-label">Link 2(Product Link)</label>
                                                <input class="form-control" name="link_2" type="text" id="link_2">
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
                                    <button type="submit" class="btn btn-primary">Add Sliders</button>
                                </div>
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
    <div class="col-md-12">


        <div class="card">
            <div class="card-header">
                <h5 class="card-title">All Blogs</h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <!-- /.row -->
                <table id="example1" class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Link 1</th>
                        <th>Link 2</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogslides as $key=> $value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->title}}</td>
                            <td>{!! $value->description!!}</td>
                            <td><img src="{{asset('images/blogs/blogslides/'.$value->image)}}" height="100px"
                                     width="150px"></td>
                            <td>{{$value->categories->name}}</td>
                            <td>{{$value->link_1}}</td>
                            <td>{{$value->link_2}}</td>
                            <td><a href="{{route('delete-blog-slides',$value->id)}}"
                                   onclick="return confirm('Confirm Delete?')"
                                   class="btn btn-sm btn btn-danger"><i class="fa fa-trash"></i> </a>
                                <a href="{{route('edit-blog-slides',$value->id)}}"
                                   class="btn btn-sm btn btn-primary"><i
                                            class="fa fa-edit"></i> </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ./card-body -->

            <!-- /.card-footer -->
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
