@extends('admin.layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold">All Ads
                <a href="{{ route('add_ads') }}" class="btn btn-primary btn-sm pull-right">Add New</a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th style="width: 10px">SN.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Activity</th>
                </tr>
                @foreach($ads as $ad)
                    <tr>
                        <td>{{  $ad->id }}</td>
                        <td><strong style="font-weight: bold">{{ $ad->name }} </strong></td>
                        <td><img src="{{  asset($ad->image) }}" alt="" style="width: 100px">
                        </td>
                        <td>{{  $ad->link }}</td>
                        <td> @if($ad->display_area == 1)
                                <strong style="background-color: red">Home Page Top</strong>
                            @elseif($ad->display_area==2)
                                <strong style="background-color: red">Home Page Bottom</strong>
                            @elseif($ad->display_area == 3)
                                <strong style="background-color: red">Category Page Top</strong>
                            @else
                                <strong style="background-color: red">Category Page Bottom</strong>
                            @endif
                        </td>
                        <td>@if($ad->status == 0)
                                <strong style="background-color: red">Disabled</strong>
                                @else
                            <strong style="background-color: blueviolet">Enabled</strong>
                                @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#confirm{{$ad->id}}" style="display: inline-block">
                                @if($ad->status == 0)
                                    Enable
                                @else
                                    Disable
                                @endif
                            </button>
                            <div class="modal fade" id="confirm{{$ad->id}}" tabindex="-1" role="dialog"
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
                                            @if($ad->status == 0)
                                                Are you Sure you want to Confirm this Ad ?
                                            @else
                                                Are you Sure you want to make this Ad Inactive?
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{route('confirm_ad',$ad->id)}}"
                                               class="btn btn-primary">Confirm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<button type="button" class="btn btn-danger" data-toggle="modal"--}}
                                    {{--data-target="#link{{$link->id}}" style="display: inline-block">--}}
                                {{--Add Link--}}
                            {{--</button>--}}
                            {{--<div class="modal fade" id="link{{$link->id}}" tabindex="-1" role="dialog"--}}
                                 {{--aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                {{--<form method="post" action="{{  route('link_confirm',$link->id) }}">--}}
                                    {{--@csrf--}}
                                    {{--<div class="modal-dialog" role="document">--}}
                                        {{--<div class="modal-content">--}}
                                            {{--<div class="modal-header">--}}
                                                {{--<h5 class="modal-title" id="exampleModalLabel">Confirm</h5>--}}
                                                {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                        {{--aria-label="Close">--}}
                                                    {{--<span aria-hidden="true">&times;</span>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-body">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label for="link">Add The Link</label>--}}
                                                    {{--<input type="text" name="link" id="link" class="form-control">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-footer">--}}
                                                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">--}}
                                                    {{--Close--}}
                                                {{--</button>--}}
                                                {{--<input type="submit"--}}
                                                       {{--class="btn btn-primary" id="submit">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#delete{{$ad->id}}" style="display: inline-block">
                                Delete
                            </button>
                            <div class="modal fade" id="delete{{$ad->id}}" tabindex="-1" role="dialog"
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
                                            Are you Sure you want to delete the ad ?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{route('delete_ad',$ad->id)}}" class="btn btn-primary">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('edit_ad',$ad->id)}}" method="get"
                                  style="display: inline-block">
                                <button class="btn btn-secondary" type="submit">Edit</button>
                            </form>
                            {{--<button type="button" class="btn btn-danger" data-toggle="modal"--}}
                                    {{--data-target="#no-link{{$background->id}}" style="display: inline-block">--}}
                                {{--Remove Link--}}
                            {{--</button>--}}
                            {{--<div class="modal fade" id="no-link{{$background->id}}" tabindex="-1" role="dialog"--}}
                                 {{--aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                {{--<div class="modal-dialog" role="document">--}}
                                    {{--<div class="modal-content">--}}
                                        {{--<div class="modal-header">--}}
                                            {{--<h5 class="modal-title" id="exampleModalLabel">Confirm</h5>--}}
                                            {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                    {{--aria-label="Close">--}}
                                                {{--<span aria-hidden="true">&times;</span>--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-body">--}}
                                            {{--Are You sure you want to remove the link?--}}
                                        {{--</div>--}}
                                        {{--<div class="modal-footer">--}}
                                            {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">--}}
                                                {{--Close--}}
                                            {{--</button>--}}
                                            {{--<a href="{{route('link_remove',$background->id)}}"--}}
                                               {{--class="btn btn-primary">Confirm</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<form action="{{route('edit_background',$background->id)}}" method="get"--}}
                                  {{--style="display: inline-block">--}}
                                {{--<button class="btn btn-secondary" type="submit">Edit</button>--}}
                            {{--</form>--}}

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    </div>


@endsection