@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Message Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-responsive table-condensed" width="100%">
                    <tr class="mybg">
                        <th style="width: 10px">SN.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th style="">Activity</th>
                    </tr>
                    @foreach($contacts as $contact)

                        <tr>
                            <td>{{  $contact->id }}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                            <td> @if($contact->status == 1)
                                    <strong style="background-color: red">Read</strong>
                                @else
                                    <strong style="background-color: #7878eb">Not Read</strong>
                                @endif</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$contact->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$contact->id}}" tabindex="-1" role="dialog"
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
                                                    Close
                                                </button>
                                                <a href="{{route('delete_contact',$contact->id)}}"
                                                   class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirm{{$contact->id}}" style="display: inline-block">
                                    @if($contact->status == 0)
                                        Mark as Read
                                    @else
                                        Mark as Unread
                                    @endif
                                </button>
                                <div class="modal fade" id="confirm{{$contact->id}}" tabindex="-1" role="dialog"
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
                                                @if($contact->status == 0)
                                                    Are you Sure you want to Confirm this Blog ?
                                                @else
                                                    Are you Sure you want to make this item Inactive?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('confirm_contact',$contact->id)}}"
                                                   class="btn btn-primary">Confirm</a>
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
    </div>
@endsection