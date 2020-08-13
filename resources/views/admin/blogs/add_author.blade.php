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
                        <h5 class="card-title">Add Author</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('blog-author')}}"
                              accept-charset="UTF-8" class=""
                              enctype="multipart/form-data">
                            @csrf

                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Author Name *</label>
                                                <input class="form-control" name="name" type="text" id="name">
                                            </div>
                                        </div>


                                        <div class="col-sm-5">
                                            <div class="form-group ">
                                                <label for="status" class="control-label">Image</label>
                                                <input class="form-control" name="image" type="file"
                                                       id="caption">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Author Description *</label>
                                                <textarea id="desc"
                                                          name="description"
                                                          class="form-control"></textarea></div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Author</button>

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

            <div class="col-md-12">


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">All Authors</h5>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- /.row -->
                        <table id="user" class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($Authors as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <img src="{{asset('images/blogs/author/'.$value->image)}}" width="80px">
                                    </td>
                                    <td>{!! $value->description !!}</td>
                                    <td>
                                        <a href="{{route('blog-delete-author',$value->id)}}"
                                           onclick="return confirm('Confirm Delete?')"
                                           class="btn btn-sm btn btn-danger"><i class="fa fa-trash"></i> </a>
                                        <a href="{{route('blog-edit-author',$value->id)}}"
                                           class="btn btn-sm btn btn-primary"><i
                                                    class="fa fa-edit"></i> </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
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
        ClassicEditor
            .create(document.querySelector('#desc'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
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
