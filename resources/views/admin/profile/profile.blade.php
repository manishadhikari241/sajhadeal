
@extends('admin.layout.master')
@section('content')

        <div class="row">

            <div class="col-md-offset-1 col-md-10">
                <div class="Profile-content-wrapper">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>

                        <li><a data-toggle="tab" href="#change">Change pswd</a></li>
                        <li><a data-toggle="tab" href="#edit">Edit Profile</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">

                            <div class="col-md-8">
                            <ul class="data">
                                <li>Email</li>
                                <li>{{$admin->email}}</li>
                            </ul>
                            <ul class="data">
                                <li>Mobile</li>
                                <li>{{$admin->mobile}}</li>
                            </ul>
                            <ul class="data">
                                <li>Date of Birth</li>
                                <li>{{$admin->dob}}</li>
                            </ul>

                            <h4 >Address</h4>
                            <ul class="data">
                                <li>District</li>
                                <li>{{$admin->district}}</li>
                            </ul>
                            <ul class="data">
                                <li>Town</li>
                                <li>{{$admin->town}}</li>
                            </ul>
                            <ul class="data">
                                <li>Ward Number</li>
                                <li>{{$admin->ward_no}}</li>
                            </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="sidebar-wrapper">
                                    <div class="img-container">

                                        <img src="{{asset($admin->image)}}" class="img-responsive img-circle" alt="">
                                    </div>
                                    <div class="instructor-name" align="center">
                                        {{$admin->first_name." ".$admin->last_name}}

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="change" class="tab-pane fade">

                            <form action="{{route('changeAdminPswd')}}" method="post">
                                @csrf


                                    <div class=" myform form-horizontal">
                                        <div class="control-group">
                                            <label for="current_password" class="control-label">Current Password</label>
                                            <div class="controls">
                                                <input type="password" name="current_password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="new_password" class="control-label">New Password</label>
                                            <div class="controls">
                                                <input type="password" name="new_password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="confirm_password" class="control-label">Confirm Password</label>
                                            <div class="controls">
                                                <input type="password" name="confirm_password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <input type="submit" class="btn btn-primary" value="Save">

                                        </div>
                                    </div>


                            </form>
                        </div>
                        <div id="edit" class="tab-pane fade">
                            <form action="{{route('editAdminProfile',$admin->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <div class="inner-addon left-addon">
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" name="last_name" value="{{$admin->last_name}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <div class="inner-addon left-addon">
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" name="first_name" value="{{$admin->first_name}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Date Of Birth</label>

                                                <input class="form-control" value="{{$admin->dob}}" name="dob" type="text" />


                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Mobile Number</label>
                                                <div class="inner-addon left-addon">
                                                    <i class="fas fa-phone"></i>
                                                    <input type="text" name="mobile" value="{{$admin->mobile}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-8">
                                            <div class="form-group-inline">
                                                <label class="control-label">Gender</label>
                                                <div class="row">
                                                    <div class="input-form col-md-4">
                                                        <label for="male" class="control-label">Male</label>
                                                        <input type="radio" name="gender" value="male" id="male" @if($admin->gender == "male") checked @endif>
                                                    </div>
                                                    <div class="input-form col-md-4">
                                                        <label for="Female" class="control-label">Female</label>
                                                        <input type="radio" name="gender" value="female" id="Female" @if($admin->gender == "female") checked @endif>
                                                    </div>
                                                    <div class="input-form col-md-4">
                                                        <label for="other" class="control-label">Other</label>
                                                        <input type="radio" name="gender" value="other" id="other" @if($admin->gender == "other") checked @endif>
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
                                                    <input type="text" name="district" value="{{$admin->district}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Town</label>
                                                <div class="inner-addon left-addon">
                                                    <i class="fa fa-map-marker fas"></i>
                                                    <input type="text" name="town"  value="{{$admin->town}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Ward Number</label>
                                                <div class="inner-addon left-addon">
                                                    <i class="fas fa fa-map-marker"></i>
                                                    <input type="text" name="ward_no" value="{{$admin->ward_no}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                        <div class="row">
                                            <hr>
                                            <div class="col-md-6">

                                                    <div class="main-img-preview">
                                                        <img class="thumbnail img-preview" src="{{asset($admin->image)}}" title="Uploaded Photo will be displayed Here" alt="image">
                                                    </div>

                                            </div>

                                            <div class="col-md-6">



                                                        <div class="input-group">
                                                            <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                                                            <div class="input-group-btn">
                                                                <div class="fileUpload btn btn-danger fake-shadow">
                                                                    <span><i class="glyphicon glyphicon-upload"></i> Upload Photo</span>
                                                                    <input id="logo-id" name="image" type="file" class="attachment_upload">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="help-block">* Upload Applicants Photo *</p>


                                            </div>

                                        </div>
                                    <input type="submit" class="btn btn-primary pull-right" value="save">


                                </div>

                                <div class="modal-footer">


                                </div>
                            </form>

                        </div>
                    </div>
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



