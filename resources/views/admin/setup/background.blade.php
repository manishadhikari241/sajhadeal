@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">Background Slide-Show Images</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-responsive">
                    <tr class="mybg">
                        <th style="width: 10px">SN.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Activity</th>
                    </tr>
                    @foreach($backgrounds as $background)
                        <tr>
                            <td>{{  $background->id }}</td>
                            <td><strong style="font-weight: bold">{{ $background->title }} </strong></td>
                            <td><img src="{{  asset($background->logo) }}" alt=""
                                                          style="width: 100px">
                            </td>
                            <td>{{  $background->link }}</td>
                            <td> @if($background->status == 1)
                                    <strong style="background-color: red">Enabled</strong>
                                @else
                                    <strong style="background-color: #7878eb">Disabled</strong>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirm{{$background->id}}" style="display: inline-block">
                                    @if($background->status == 0)
                                        Enable
                                    @else
                                        Disable
                                    @endif
                                </button>
                                <div class="modal fade" id="confirm{{$background->id}}" tabindex="-1" role="dialog"
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
                                                @if($background->status == 0)
                                                    Are you Sure you want to make this item Active ?
                                                @else
                                                    Are you Sure you want to make this item Inactive?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('confirm_background',$background->id)}}"
                                                   class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#link{{$background->id}}" style="display: inline-block">
                                    Add Link
                                </button>
                                <div class="modal fade" id="link{{$background->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form method="post" action="{{  route('link_confirm',$background->id) }}">
                                        @csrf
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
                                                    <div class="form-group">
                                                        <label for="link">Add The Link</label>
                                                        <input type="text" name="link" id="link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit"
                                                           class="btn btn-primary" id="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#no-link{{$background->id}}" style="display: inline-block">
                                    Remove Link
                                </button>
                                <div class="modal fade" id="no-link{{$background->id}}" tabindex="-1" role="dialog"
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
                                                Are You sure you want to remove the link?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('link_remove',$background->id)}}"
                                                   class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('edit_background',$background->id)}}" method="get"
                                      style="display: inline-block">
                                    <button class="btn btn-secondary" type="submit">Edit</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        {{--New Arrival--}}

        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">Background New-Arrival Images</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-responsive" >
                    <tr class="mybg">
                        <th style="width: 10px">SN.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Activity</th>
                    </tr>
                    @foreach($backgrounds1 as $background)
                        <tr>
                            <td>{{  $background->id }}</td>
                            <td><strong style="font-weight: bold">{{ $background->title }} </strong></td>
                            <td><img src="{{  asset($background->logo) }}" alt=""
                                                          style="width: 100px">
                            </td>
                            <td>{{  $background->link }}</td>
                            <td> @if($background->status == 1)
                                    <strong style="background-color: red">Enabled</strong>
                                @else
                                    <strong style="background-color: #7878eb">Disabled</strong>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirm{{$background->id}}" style="display: inline-block">
                                    @if($background->status == 0)
                                        Enable
                                    @else
                                        Disable
                                    @endif
                                </button>
                                <div class="modal fade" id="confirm{{$background->id}}" tabindex="-1" role="dialog"
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
                                                @if($background->status == 0)
                                                    Are you Sure you want to Confirm this Blog ?
                                                @else
                                                    Are you Sure you want to make this item Inactive?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('confirm_background',$background->id)}}"
                                                   class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#link{{$background->id}}" style="display: inline-block">
                                    Add Link
                                </button>
                                <div class="modal fade" id="link{{$background->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form method="post" action="{{  route('link_confirm',$background->id) }}">
                                        @csrf
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
                                                    <div class="form-group">
                                                        <label for="link">Add The Link</label>
                                                        <input type="text" name="link" id="link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit"
                                                           class="btn btn-primary" id="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#no-link{{$background->id}}" style="display: inline-block">
                                    Remove Link
                                </button>
                                <div class="modal fade" id="no-link{{$background->id}}" tabindex="-1" role="dialog"
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
                                                Are You sure you want to remove the link?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('link_remove',$background->id)}}"
                                                   class="btn btn-primary">Confirm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('edit_background',$background->id)}}" method="get"
                                      style="display: inline-block">
                                    <button class="btn btn-secondary" type="submit">Edit</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        {{--Specials--}}
        {{--<div class="card">--}}
            {{--<div class="card-header">--}}
                {{--<h3 class="card-title" style="font-weight: bold">Background Slide-Show Images</h3>--}}
            {{--</div>--}}
            {{--<!-- /.card-header -->--}}
            {{--<div class="card-body">--}}
                {{--<table class="table table-bordered table-responsive">--}}
                    {{--<tr class="mybg">--}}
                        {{--<th style="width: 10px">SN.</th>--}}
                        {{--<th>Name</th>--}}
                        {{--<th>Image</th>--}}
                        {{--<th>Link</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Activity</th>--}}
                    {{--</tr>--}}
                    {{--@foreach($backgrounds2 as $background)--}}
                        {{--<tr>--}}
                            {{--<td>{{  $background->id }}</td>--}}
                            {{--<td><strong style="font-weight: bold">{{ $background->title }} </strong></td>--}}
                            {{--<td><img src="{{  asset($background->logo) }}" alt=""--}}
                                                          {{--style="width: 100px">--}}
                            {{--</td>--}}
                            {{--<td>{{  $background->link }}</td>--}}
                            {{--<td>@if($background->status == 1)--}}
                                    {{--<strong style="background-color: red">Enabled</strong>--}}
                                {{--@else--}}
                                    {{--<strong style="background-color: #7878eb">Disabled</strong>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal"--}}
                                        {{--data-target="#confirm{{$background->id}}" style="display: inline-block">--}}
                                    {{--@if($background->status == 0)--}}
                                        {{--Enable--}}
                                    {{--@else--}}
                                        {{--Disable--}}
                                    {{--@endif--}}
                                {{--</button>--}}
                                {{--<div class="modal fade" id="confirm{{$background->id}}" tabindex="-1" role="dialog"--}}
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
                                                {{--@if($background->status == 0)--}}
                                                    {{--Are you Sure you want to Confirm this Blog ?--}}
                                                {{--@else--}}
                                                    {{--Are you Sure you want to make this item Inactive?--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-footer">--}}
                                                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">--}}
                                                    {{--Close--}}
                                                {{--</button>--}}
                                                {{--<a href="{{route('confirm_background',$background->id)}}"--}}
                                                   {{--class="btn btn-primary">Confirm</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<button type="button" class="btn btn-danger" data-toggle="modal"--}}
                                        {{--data-target="#link{{$background->id}}" style="display: inline-block">--}}
                                    {{--Add Link--}}
                                {{--</button>--}}
                                {{--<div class="modal fade" id="link{{$background->id}}" tabindex="-1" role="dialog"--}}
                                     {{--aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                    {{--<form method="post" action="{{  route('link_confirm',$background->id) }}">--}}
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
                                                    {{--<button type="button" class="btn btn-secondary"--}}
                                                            {{--data-dismiss="modal">--}}
                                                        {{--Close--}}
                                                    {{--</button>--}}
                                                    {{--<input type="submit"--}}
                                                           {{--class="btn btn-primary" id="submit">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
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

                                {{--EDIT--}}

                                {{--<form action="{{route('edit_background',$background->id)}}" method="get"--}}
                                      {{--style="display: inline-block">--}}
                                    {{--<button class="btn btn-secondary" type="submit">Edit</button>--}}
                                {{--</form>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection