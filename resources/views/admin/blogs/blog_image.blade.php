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
                        <h5 class="card-title">Blog Images</h5>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- /.row -->
                        <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Blog Title</th>
                                <th>Images</th>
                                <th>Alt Tags</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($blogimage as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->blogs != null? $value->blogs->title : ''}}</td>
                                    <td><img src="{{asset('images/blogs/blogimages/'.$value->image)}}" height="50px">
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('update-blog-image')}}">
                                            @csrf
                                            <input type="hidden" value="{{$value->id}}" name="id">
                                            <div class="form-group">

                                                <textarea class="form-control"
                                                          name="tag">{{$value->blogimageseos != null ? $value->blogimageseos->alt_tag:''  }}</textarea>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>


                                            </div>

                                        </form>
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
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
