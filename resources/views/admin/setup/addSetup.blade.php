@extends('admin.layout.master')

@section('content')
        <div class="row">
            <div class="container">
                <div class="col-md-offset-1 col-md-10" style="margin-top: 70px;">
                    <ul class="nav nav-tabs nav-justified">
                        <li class=" active nav-item"><a data-toggle="tab" href="#home" class="nav-link">Basic Settings</a></li>
                        <li class=" nav-item"><a data-toggle="tab" href="#menu1" class="nav-link">Social Links</a></li>
                        <li class=" nav-item"><a data-toggle="tab" href="#menu2" class="nav-link">Terms and Policies</a></li>
                        <li class=" nav-item"><a data-toggle="tab" href="#menu3" class="nav-link">About Us</a></li>
                        <li class=" nav-item"><a data-toggle="tab" href="#menu4" class="nav-link">Seos</a></li>
                    </ul>


            <form action="{{route('postSetting')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body" >
                    <div class="tab-content" style="overflow: hidden">
                        <div id="home" class="tab-pane fade in show active">
                            <div class="row">
                                <div class="col-md-3 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>

                                        <input class="form-control" name="company_name" type="text" required/>


                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <div class="inner-addon left-addon">
                                            <i class="fas fa-phone"></i>
                                            <input type="number" name="company_number" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <div class="inner-addon left-addon">
                                            <i class="fas fa-map-marker"></i>
                                            <input type="text" name="address" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Copyright Year</label>
                                        <div class="inner-addon left-addon">

                                            <input type="text" name="copyright_year" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <div class="inner-addon left-addon">

                                            <input type="email" name="email" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>



                            </div>


                            <br>
                            <hr>
                            <br>
                            <label> Add Logo</label>
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
                                                    <input id="logo-id" name="logo" type="file" class="attachment_upload" required>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="help-block">* Upload Logo *</p>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div id="menu1" class="tab-pane fade">
                           <div class="form-group">
                               <label for="facebook">Facebook Link</label>
                               <input type="text" name="facebook_link" class="form-control" required>
                           </div>
                            <div class="form-group">
                                <label for="facebook">Instagram Link</label>
                                <input type="text" name="instagram_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="facebook">Twitter Link</label>
                                <input type="text" name="twitter_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="facebook">YouTube Link</label>
                                <input type="text" name="youtube_link" class="form-control">
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="form-group">
                                <label for="facebook">Terms</label>
                                <textarea name="terms" class="editor form-control">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Policies</label>
                                <textarea name="policies" id="editor1" class="editor form-control">
                                </textarea>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">

                            <div class="form-group">
                                <label for="facebook">Brief</label>
                                <textarea type="text" name="brief_about_us" id="editor2" class="editor form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Detail</label>
                                <textarea class="editor" name="detail_about_us" id="editor3" ></textarea>
                            </div>

                        </div>
                        
                        <div id="menu4" class="tab-pane fade">

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea name="meta_keywords" class="editor form-control" placeholder="Comma separated keywords"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="editor form-control" name="meta_description" placeholder="Brief description about website"></textarea>
                                <small class="text-muted">Max 150 characters</small>
                            </div>


                        </div>


                    </div>


                    </div>


                <div class="modal-footer">

                    <input type="submit" class="btn btn-primary" value="Save">
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

<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#editor1'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#editor2'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#editor3'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>



@endsection



