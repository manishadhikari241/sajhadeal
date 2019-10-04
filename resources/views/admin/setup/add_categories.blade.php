@extends('admin.layout.master')


@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="main-wrapper ">
                <form action="{{ route('post_add_category') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="add_brand">Add Categories</label>
                        <input type="text" name="category" class="form-control" placeholder="Enter Category" required>
                    </div>
                    <div class="form-group">
                        <label for="add_brand">Select Parent Categories</label>
                        <select name="parent_id" class="form-control">
                            <option value=""></option>
                            @foreach($values as $value)
                                <option value="{{$value->id}}" class="form-control"> {{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                        <small class="text-muted">Note: Only 200 characters max</small>
                    </div>

                    <div class="form-group">
                        <label for="description">Category Image</label>
                        <input type="file" class="form-control" name="category_image">
                    </div>
                    <div class="form-group">
                        <label for="description">Category Image Link</label>
                        <input type="text" class="form-control" name="image_link">
                        <small class="text-muted">Note: Provide Link if you want to redirect to page on banner click
                        </small>

                    </div>

                    <input type="submit" class="btn btn-success pull-right" value="  Submit  ">
                </form>

            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 card">
            <div class="card-header with-border">
                <h3 class="box-title">Categories</h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($categories as $category)

                        @if($category->children->count()>0)
                            <li>{{$category->title}}</li>
                            <ul>
                                @foreach($category->children as $sub_category)
                                    @if($sub_category->children->count()>0)

                                        <li>{{$sub_category->title}}</li>
                                        <ul>
                                            @foreach($sub_category->children as $grand_category)
                                                <li>{{ $grand_category->title }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <li>{{$sub_category->title}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <li>{{ $category->title }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8 card ">
            <div class="card-header with-border">
                <h3 class="box-title">All Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Image Link</th>
                        <th>Action</th>
                    </tr>
                    @foreach($values as $category)
                        <tr>
                            <td> {{ $category->id }} </td>
                            <td> {{  $category->title}} </td>
                            <td>@if($category->category_image!=null)<img
                                        src="{{asset('images/category/'.$category->category_image)}}" height="50px"
                                        width="50px"></td>
                            @else
                                No Cateogry Image
                            @endif
                            <td>
                                {{$category->image_link ? $category->image_link:'no Image link'}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal"
                                        data-target="#edit{{$category->id}}" style="display: inline-block">
                                    Edit
                                </button>
                                <div class="modal fade" id="edit{{$category->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('edit_category',$category->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="add_brand">Title</label>
                                                        <input type="text" name="category_edit"
                                                               value="{{ $category->title }}" class="form-control"
                                                               placeholder="Enter Category" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" class="form-control"
                                                                  placeholder="Enter Description">{{ $category->description }}</textarea>
                                                        <small class="text-muted">Note: Only 200 characters max</small>
                                                    </div>
                                                    @if($category->category_image != null)
                                                        <div id="replace" class="form-group">
                                                            <label for="description">Current Image</label>
                                                            <div class="container">
                                                                <img id="category_id" data-id="{{$category->id}}"
                                                                     src="{{asset('images/category/'.$category->category_image)}}"
                                                                     height="50px" width="50px">
                                                                <i class="remove_image fa fa-times"></i>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="description">Category Image</label>
                                                        <input type="file" class="form-control" name="category_image">
                                                    </div>
                                                    @if($category->category_image == null | $category->image_link != null)

                                                        <div class="form-group">
                                                            <label for="description">Category Image Link</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$category->image_link != null ? $category->image_link :''}}"
                                                                   name="image_link">
                                                            <small class="text-muted">Note: Provide Link if you want to
                                                                redirect to page on banner click
                                                            </small>

                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-primary btn btn-sm">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn btn-sm" data-toggle="modal"
                                        data-target="#delete{{$category->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$category->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you Sure you want to delete the category ?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a href="{{route('delete_category',$category->id)}}"
                                                   class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.remove_image').on('click', function () {
            if (confirm('Are you sure You want to Remove Category Image?')) {


                let category_id = $(this).parent().find('#category_id').attr('data-id');
                console.log(category_id);
                $.ajax({
                    type: "GET",
                    url: "{{route('delete-category-image')}}",
                    data: {
                        category_id: category_id
                    },
                    success: function (response) {
                        $('#replace').replaceWith($('#replace').html(response));

                    }
                })
            }
        });
    </script>
@endsection