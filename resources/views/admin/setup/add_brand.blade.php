@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>ADD NEW BRAND</h2>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-info success-msg">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="post" action="{{route('post_add_brand')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Brand Name</label>
                            <input type="text" id="title" name="title" placeholder="Enter name of Brand" class="form-control" required>
                    </div>
                    <div class="input-group">
                    {{--<label for="logo">Upload Image</label>--}}
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="brand_logo" required>
                                </span>
                            </span>
                            <input type="text" id="logo" class="form-control" readonly>
                    </div>
                    <div>
                        <img id='img-upload' style="max-width: 400px; max-height: auto">
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="saveBtn"></label>

                        <div class="col-md-8">
                            <button id="saveBtn" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div style="padding-bottom: 20px; padding-top: 20px">
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Current Brands</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered css-serial">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">ID</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Logo</th>
                        <th scope="col"> Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td><h1> {{$brand->title}}</h1></td>
                            <td><h1><img src="{{ asset($brand->brand_logo) }}" style="max-height: 80px; max-width:auto"></h1>
                            </td>
                            <td><a href='{{ route('delete_brand', ['id'=>$brand->id]) }}'>
                                    <button class="btn btn-warning"> Delete</button>
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function (event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });
        });
    </script>

@endsection