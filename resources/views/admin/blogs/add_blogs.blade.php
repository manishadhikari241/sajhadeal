@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 align="center">Add Blog</h3>
                    <hr>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('add-blog')}}"
                              accept-charset="UTF-8" class=""
                              enctype="multipart/form-data">
                            @csrf

                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Title*</label>
                                                <input class="form-control" name="name" type="text" id="name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <hr>
                                                <input type="checkbox" name="popular" value="popular">Popular<br>
                                                <input type="checkbox" name="featured" value="featured">Featured<br>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">

                                            <div class="form-group ">
                                                <label for="caption" class="control-label">Image*</label>
                                                <input class="form-control" name="image_upload[]" type="file" multiple
                                                       id="caption">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Tags*</label>
                                                <select class="form-control" id="tags" multiple name="tags[]">
                                                    @foreach($tag as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Category *</label>
                                                <select class="form-control" name="category">
                                                    <option selected>Select category</option>
                                                    @foreach($cat as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Author</label>
                                                <select class="form-control" name="author">
                                                    <option disabled selected>Select author</option>
                                                    @foreach($auth as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">SEO Keywords *</label>
                                            <textarea class="form-control"  name="seo_key"
                                                      type="text" id="name"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">SEO Description *</label>
                                            <textarea class="form-control"
                                                      name="seo_description" type="text"
                                                      id="name"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">Blog Description 1st Paragraph*</label>
                                            <textarea id="desc"
                                                      name="description"
                                                      class="form-control"></textarea></div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">Blog Description 2nd Paragraph</label>
                                            <textarea id="desc-1"
                                                      name="description_2"
                                                      class="form-control"></textarea></div>
                                    </div>



                                </div>

                                <div>

                                    <button type="submit" class="btn btn-primary">Add Blog</button>


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
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($blog as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->title}}</td>
                                    <td>{!! $value->description !!}</td>
                                    <td>{{$value->authors->name}}</td>
                                    <td>
                                        <a href="{{route('blog-delete',$value->id)}}"
                                           onclick="return confirm('Confirm Delete?')"
                                           class="btn btn-sm btn btn-danger"><i class="fa fa-trash"></i> </a>
                                        <a href="{{route('blog-edit',$value->id)}}"
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
        $(document).ready(function () {
            $('#tags').select2();

            ClassicEditor
                .create(document.querySelector('#desc'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#desc-1'))
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
