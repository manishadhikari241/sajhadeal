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
                        <h5 class="card-title">Blog Page Advertisement</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('blog-add-advertisement')}}"
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
                                                <label for="link_1" class="control-label">Link</label>
                                                <input class="form-control" name="link" type="text" id="link_1">
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
                                    <button type="submit" class="btn btn-primary">Add Advertisement</button>
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
                        <th>Image</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogadvertisement as $key=> $value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td><img src="{{asset('images/blogs/blogadvertisement/'.$value->image)}}" height="100px"
                                     width="150px"></td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->link}}</td>
                            <td><a href="{{route('delete-blog-advertisement',$value->id)}}"
                                   onclick="return confirm('Confirm Delete?')"
                                   class="btn btn-sm btn btn-danger"><i class="fa fa-trash"></i> </a>
                                <a href="{{route('edit-blog-advertisement',$value->id)}}"
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
