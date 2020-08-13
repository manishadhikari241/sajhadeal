@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Category</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{route('blog-add-category')}}"
                          accept-charset="UTF-8" class=""
                          enctype="multipart/form-data">
                        @csrf

                        <div class="box box-default">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">Category*</label>
                                            <input class="form-control" name="category" type="text" id="name">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
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
                    <h5 class="card-title">Category Lists</h5>

                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <!-- /.row -->
                    <table id="user" class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($category as $key => $value)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <a href="{{route('blog-delete-category',$value->id)}}"
                                       onclick="return confirm('Confirm Delete?')"
                                       class="btn btn-sm btn btn-danger"><i class="fa fa-trash"></i> </a>
                                    <a data-toggle="modal"
                                       data-target="#myEditModal{{ $value->id }}"
                                       class="btn btn-sm btn btn-primary"><i
                                                class="fa fa-edit"></i> </a>
                                </td>
                            </tr>
                            <div class="container">
                                <div class="row">

                                    <div id="myEditModal{{ $value->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" align="center"><b>Edit Category</b></h4>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="card-body">

                                                    <form method="POST" action="{{route('blog-edit-category')}}"
                                                          accept-charset="UTF-8" class=""
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$value->id}}">


                                                        <div class="box box-default">
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group ">
                                                                            <label for="name" class="control-label">Category
                                                                                *</label>
                                                                            <input class="form-control" name="category"
                                                                                   type="text"
                                                                                   id="name" value="{{$value->name}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Category
                                                                </button>
                                                            </div>


                                                        </div>


                                                    </form>
                                                    <!-- /.box-body -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

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
