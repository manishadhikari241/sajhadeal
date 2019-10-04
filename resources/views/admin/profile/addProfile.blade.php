
@extends('admin.layout.master')
@section('content')

        <div class="row">
            <div class="container">
                <div class="col-md-offset-1 col-md-10">
            <form action="{{route('postAdminProfile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="margin-top: 70px;">

                    <div class="row">
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Date Of Birth</label>

                                <input class="form-control" name="dob" type="text" required/>


                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <div class="inner-addon left-addon">
                                    <i class="fas fa-phone"></i>
                                    <input type="text" name="mobile" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-inline">
                                <label class="control-label">Gender</label>
                                <div class="row">
                                    <div class="input-form col-md-4">
                                        <label for="male" class="control-label">Male</label>
                                        <input type="radio" name="gender" value="male" id="male" required>
                                    </div>
                                    <div class="input-form col-md-4">
                                        <label for="Female" class="control-label">Female</label>
                                        <input type="radio" name="gender" value="female" id="Female" required>
                                    </div>
                                    <div class="input-form col-md-4">
                                        <label for="other" class="control-label">Other</label>
                                        <input type="radio" name="gender" value="other" id="other" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">District</label>
                                <div class="inner-addon left-addon">
                                    <i class="fas fa fa-map-marker"></i>
                                    <input type="text" name="district" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Town</label>
                                <div class="inner-addon left-addon">
                                    <i class="fa fa-map-marker fas"></i>
                                    <input type="text" name="town" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Ward Number</label>
                                <div class="inner-addon left-addon">
                                    <i class="fas fa fa-map-marker"></i>
                                    <input type="text" name="ward_no" class="form-control" />
                                </div>
                            </div>
                        </div>


                    </div>


                        <br>
                        <hr>
                        <br>
                        <label> Add Profile picture</label>
                        <br>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="main-img-preview">
                                    <img class="thumbnail img-preview" src="" title="Uploaded Photo will be displayed Here">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="input-group">
                                        <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                                        <div class="input-group-btn">
                                            <div class="fileUpload btn btn-danger fake-shadow">
                                                <span><i class="glyphicon glyphicon-upload"></i> Upload Photo</span>
                                                <input id="logo-id" name="image" type="file" class="attachment_upload" required>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="help-block">* Upload Applicants Photo *</p>

                                </div>
                            </div>
                        </div>
                    <br>

                    </div>


                <div class="modal-footer">

                    <input type="submit" class="btn btn-primary" value="save">
                </div>
            </form>
                </div>
            </div>
        </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        var brand = document.getElementById('logo-id');
        brand.className = 'attachment_upload';
        brand.onchange = function() {
            document.getElementById('fakeUploadLogo').value = this.value.substring(12);
        };

        // Source: http://stackoverflow.com/a/4459419/6396981
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#logo-id").change(function() {
            readURL(this);
        });
    });


</script>

@endsection



