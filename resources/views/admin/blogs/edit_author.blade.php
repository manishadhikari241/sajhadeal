@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Author</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form method="POST" action="{{route('blog-edit-author')}}"
                      accept-charset="UTF-8" class=""
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$author->id}}">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group ">
                                        <label for="name" class="control-label">Author Name *</label>
                                        <input class="form-control" name="name" type="text" id="name" value="{{$author->name}}">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group ">

                                        <label for="status" class="control-label">Current Image:</label>
                                        <img src="{{asset('images/blogs/author/'.$author->image)}}" width="80px">
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
                                                  class="form-control">{{$author->description}}</textarea></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Author</button>

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
