@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="box-title">All Subscribers</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Subscriber Mail</th>
                        <th>Action</th>
                    </tr>
                    @foreach($subscribers as $subscriber)
                        <tr>
                            <td> {{ $subscriber->id }} </td>
                            <td> {{  $subscriber->subscriber }} </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$subscriber->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$subscriber->id}}" tabindex="-1" role="dialog"
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
                                                Are you Sure you want to delete the subscriber ?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('delete_subscriber',$subscriber->id)}}" class="btn btn-primary">Delete</a>
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
    </section>

@endsection