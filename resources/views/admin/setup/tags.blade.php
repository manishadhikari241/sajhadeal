@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
            </div>
            <form action="{{  route('post_tag') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Add Tags</label>

                    <input type="text" class="form-control" name="tags"
                           placeholder="Enter the Name of Ad" id="title" required>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="card ol-md-8 offset-md-2" style="margin-top: 40px; background-color: #f4f6f9;margin-left: 200px; margin-right: 200px">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">All Tags</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Activity</th>
                    </tr>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{  $tag->id }}</td>
                            <td><strong style="font-weight: bold">{{ $tag->title }} </strong></td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$tag->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$tag->id}}" tabindex="-1" role="dialog"
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
                                                Are you Sure you want to delete the Tag?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('delete_tag',$tag->id)}}" class="btn btn-primary">Delete</a>
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