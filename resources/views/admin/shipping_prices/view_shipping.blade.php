@extends('admin.layout.master')
@section('content')
    <section class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
        <div class="card col-md-6 offset-md-3" style="background-color: #f4f6f9">
            <div class="card-body">
                <h1 class=" text-dark">Add Shipping Location</h1>
            </div>
            <form action="{{  route('post_location') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Add Shipping Location</label>

                    <input type="text" class="form-control" name="name"
                           placeholder="Enter the Shipping Address" id="title" required>
                </div>
                <hr>
                <div class="form-group">
                    <h3>Shipping Rate</h3><br>
                    <input type="number" name="shipping_rate" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Add</button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header with-border">
                <h3 class="box-title">All Shipping Locations</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Title Location</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach($shippings as $shipping)
                        <tr>
                            <td> {{ $shipping->id }} </td>
                            <td> {{  $shipping->shipping_location }} </td>
                            <td>{{  $shipping->shipping_price }}</td>
                            <td> @if($shipping->status == 0)
                                    <strong style="background-color: red">Pending</strong>
                                @else
                                    <strong style="background-color: #7878eb">Confirmed</strong>
                                @endif</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$shipping->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$shipping->id}}" tabindex="-1" role="dialog"
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
                                                Are you Sure you want to delete the Shipping Location?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('delete_shipping',$shipping->id)}}" class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirm{{$shipping->id}}" style="display: inline-block">
                                    @if($shipping->status == 0)
                                        Confirm
                                    @else
                                        Make Inactive
                                    @endif
                                </button>
                                <div class="modal fade" id="confirm{{$shipping->id}}" tabindex="-1" role="dialog"
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
                                                @if($shipping->status == 0)
                                                    Are you Sure you want to Confirm this Location ?
                                                @else
                                                    Are you Sure you want to make this Location Inactive?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('confirm_shipping',$shipping->id)}}" class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('edit_shipping',$shipping->id)}}" method="get"
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