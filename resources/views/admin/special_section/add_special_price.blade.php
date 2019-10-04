@extends('admin.layout.master')
@section('content')
    @if($special == 3)
        <div class="main-wrapper">
            <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
                <div class="card-body">
                    <strong> All The Specials are added. You can edit it in the view special page. </strong>
                </div>
                <div class="card-footer">
                    <a href="{{ route('view_special') }}" class="btn btn-primary pull-right">View Specials</a>
                </div>
            </div>
        </div>
        @else
        <div class="main-wrapper">
            @if(session('success'))
                <span class="alert alert-success">{{ session('success') }}</span>
            @endif
            <div class="card col-md-8 offset-md-2 style="background-color: #f4f6f9">
                <div class="card-body">
                    <h1 class=" text-dark">Special Section By Price</h1>
                </div>
                <form action="{{  route('post_special_price') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <hr>
                    <div class="form-group">
                        <label for="imgInp">Upload Image</label>
                        <input type='file' name="logo" id="imgInp" class="form-control">
                        <div class="style-photo" style="display: none">
                            <img id="blah" src="#" alt="your image" style="width: auto; height: 200px"/>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<div class="input-group">--}}
                            {{--<input id="fakeUploadLogo" class="form-control fake-shadow"--}}
                                   {{--placeholder="Choose File" disabled="disabled">--}}
                            {{--<div class="input-group-btn">--}}
                                {{--<div class="fileUpload btn btn-danger fake-shadow">--}}
                                    {{--<span><i class="glyphicon glyphicon-upload"></i> Upload Photo</span>--}}
                                    {{--<input id="logo-id" name="logo" type="file" class="attachment_upload"--}}
                                           {{--required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<p class="help-block">* Upload Logo *</p>--}}
                    {{--</div>--}}
                    <hr>
                    <div class="form-group">
                        <h3>Price Below :</h3><br>
                        <input type="number" name="special_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> Add</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    $('.style-photo').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>

@endsection