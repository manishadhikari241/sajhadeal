@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
                <h1 class=" text-dark">Create an Special via Price</h1>
            </div>
            <form action="{{  route('save_edited_special_price',$special->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="imgInp">Upload Image</label>
                    <input type='file' name="logo" id="imgInp" class="form-control" value="{{ $special->special_image }}">
                    <div class="style-photo" style="display: block">
                        <img id="blah" src="{{ asset($special->special_image) }}" alt="your image" style="width: auto; height: 200px"/>
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
                    <h3>Price Starting From</h3><br>
                    <input type="number" name="special_price" class="form-control" value="{{  $special->special_price }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Save</button>
                </div>
            </form>
        </div>
    </div>

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