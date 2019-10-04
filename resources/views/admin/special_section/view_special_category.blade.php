@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="card">
            @if(session('edited'))
                <span class="success alert-success">{{ session('edited') }}</span>
            @endif
            <div class="card-header with-border">
                <h3 class="box-title">Specials by Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Title Blog</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    @foreach($special_categories as $special_category)
                        <tr>
                            <td> {{ $special_category->id }} </td>
                            <td> {{  $special_category->category_name }} </td>
                            <td> @if($special_category->status == 0)
                                    <strong style="background-color: red">Pending</strong>
                                @else
                                    <strong style="background-color: #7878eb">Confirmed</strong>
                                @endif</td>
                            <td><img src="{{asset($special_category->image)}}" alt=""
                                     style="width: 200px; height: 100px;"></td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$special_category->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$special_category->id}}" tabindex="-1" role="dialog"
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
                                                Are you Sure you want to delete the order ?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a href="{{route('delete_special_category',$special_category->id)}}"
                                                   class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirm{{$special_category->id}}" style="display: inline-block">
                                    @if($special_category->status == 0)
                                        Confirm
                                    @else
                                        Make Inactive
                                    @endif
                                </button>
                                <div class="modal fade" id="confirm{{$special_category->id}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($special_category->status == 0)
                                                    Confirm Activation of this special ?
                                                @else
                                                    Confirm Deactivation of this special ?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a href="{{route('confirm_special_category',$special_category->id)}}"
                                                   class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('edit_special_category',$special_category->id)}}" method="get"
                                      style="display: inline-block">
                                    <button class="btn btn-secondary" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </section>


@endsection