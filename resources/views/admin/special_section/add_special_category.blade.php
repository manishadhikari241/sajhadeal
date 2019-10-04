@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-8 offset-md-2" style="background-color: #f4f6f9">
            <div class="card-body">
                @if(session('success'))
                    <span class="success alert-success">{{ session('success') }}</span>
                @endif
                <h1 class=" text-dark">Add Specials by Category</h1><br>
            </div>
            <form action="{{ route('post_special_category') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <h3>Enter Category</h3><br>
                    <select id="category" name="special_category" class="form-control">
                                        <option value="">Select a category ...</option>
                                        @foreach($categories as $category)
                            @if($category->children->count()>0)
                                <option value="{{$category->id}}" disabled style="color: red">{{$category->title}}</option>
                                @foreach($category->children as $sub_category)
                                    @if($sub_category->children->count()>0)
                                        <option value="{{$sub_category->id}}" disabled style="color: blue">&nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                        @foreach($sub_category->children as $grand_category)
                                            <option value="{{ $grand_category->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $grand_category->title }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{$sub_category->id}}" style="color: blue">
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endif
                        @endforeach
                                    </select>
                    <!--<select class="form-control" name="special_category">-->
                    <!--    @foreach($categories as $category)-->
                    <!--        @if($category->children->count()>0)-->
                    <!--            <optgroup label="{{$category->title}}">{{$category->title}}-->
                    <!--                @foreach($category->children as $sub_category)-->
                    <!--                    <option value="{{$sub_category->id}}">-{{$sub_category->title}}</option>-->
                    <!--                @endforeach-->
                    <!--            </optgroup>-->
                    <!--        @else-->
                    <!--            <option value="{{ $category->id }}">{{ $category->title }}</option>-->
                    <!--        @endif-->
                    <!--    @endforeach-->
                    <!--</select>-->
                </div>

                <div class="form-group">
                    <label for="imgInp">Upload Image</label>
                    <input type='file' name="special_saree" id="imgInp" class="form-control">
                    <div class="style-photo" style="display: none">
                        <img id="blah" src="#" alt="your image" style="width: auto; height: 200px"/>
                    </div>
                </div>
                <hr>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>

@endsection

