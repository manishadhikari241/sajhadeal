@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">

        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
                <h1 class=" text-dark">Add Special by Category</h1><br>
            </div>
            <form action="{{route('post_edit_special_category',$special_category->id)}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h3>Enter Category</h3><br>
                    <select class="form-control" name="special_category">
@foreach($categories as $category)
                            @if($category->children->count()>0)
                                <option value="{{$category->id}}" disabled
                                        style="color: red">{{$category->title}}</option>
                                @foreach($category->children as $sub_category)
                                    @if($sub_category->children->count()>0)
                                        <option value="{{$sub_category->id}}" disabled
                                                style="color: blue">
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                        @foreach($sub_category->children as $grand_category)
                                            <option value="{{ $grand_category->id }}" @if($grand_category->id == $special_category->category_name) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $grand_category->title }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{$sub_category->id}}"
                                                style="color: blue" @if($sub_category->id == $special_category->category_name) selected @endif>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="{{ $category->id }}" @if($category->id == $special_category->category_name) selected @endif>{{ $category->title }}</option>
                            @endif
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input id="fakeUploadLogo" class="form-control fake-shadow"
                               placeholder="Choose File" disabled="disabled">
                        <div class="input-group-btn">
                            <div class="fileUpload btn btn-danger fake-shadow">
                                <span><i class="glyphicon glyphicon-upload"></i> Upload Photo</span>
                                <input id="logo-id" name="special_saree" type="file" class="attachment_upload"
                                       required>
                            </div>
                        </div>
                    </div>
                    <p class="help-block">* Upload Logo *</p>
                </div>
                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

