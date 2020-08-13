@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 align="center">Edit Blog</h3>
                    <hr>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="POST" action="{{route('blog-edit')}}"
                              accept-charset="UTF-8" class=""
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$blog->id}}" name="id">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label for="name" class="control-label">Title*</label>
                                                <input class="form-control" name="name" type="text" id="name"
                                                       value="{{$blog->title}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <hr>
                                                <input type="checkbox" name="popular" value="popular"
                                                       @if($blog->popular == 'popular')checked @endif>Popular<br>
                                                <input type="checkbox" name="featured" value="featured"
                                                       @if($blog->featured == 'featured')checked @endif>Featured<br>
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
                                    <label>Current Images</label>
                                        <div class="row">

                                            @foreach($blog->images as $img)
                                                <div class="col-sm-4">
                                                    <div class="container">
                                                        <a onclick="return confirm('Are you sure?')" href="{{route('blog-delete-image',$img->id)}}"><i class="fa fa-times"></i></a>
                                                        <img src="{{asset('images/blogs/blogimages/'.$img->image)}}" height="250px" width="250px">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Tags*</label>
                                                <select class="form-control" id="tags" multiple name="tags[]">
                                                    @foreach($tag as $value)
                                                        <option @foreach($blog->tags as $tag) @if($tag->name==$value->name) selected
                                                                @endif @endforeach value="{{$value->id}}">{{$value->name}}</option>
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
                                                        <option @if($blog->category_id==$value->id)selected
                                                                @endif value="{{$value->id}}">{{$value->name}}</option>
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
                                                        <option @if($blog->authors->id==$value->id)selected
                                                                @endif value="{{$value->id}}">{{$value->name}}</option>
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
                                            <textarea class="form-control" name="seo_key"
                                                      type="text" id="name">{{$blog->seo_keyword}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">SEO Description *</label>
                                            <textarea class="form-control"
                                                      name="seo_description" type="text"
                                                      id="name">{{$blog->seo_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">Blog Description 1st
                                                Paragraph*</label>
                                            <textarea id="desc"
                                                      name="description"
                                                      class="form-control">{{$blog->description}}</textarea></div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="name" class="control-label">Blog Description 2nd
                                                Paragraph</label>
                                            <textarea id="desc-1"
                                                      name="description_2"
                                                      class="form-control">{{$blog->description_2}}</textarea></div>
                                    </div>


                                </div>

                                <div>

                                    <button type="submit" class="btn btn-primary">Update Blog</button>
                                    <a href="{{route('add-blog')}}" class="btn btn-info"><i class="fa fa-backward"></i>
                                    </a>


                                    <!-- /.box-body -->
                                </div>
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
