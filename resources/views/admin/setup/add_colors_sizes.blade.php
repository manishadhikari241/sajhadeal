@extends('admin.layout.master')


@section('content')

    <div class="container">
        @if(session('success'))
            <div class="alert alert-info success-msg">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link active" id="home-tab" data-toggle="tab" href="#color" role="tab"--}}
                           {{--aria-controls="home" aria-selected="true">Colors</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#size" role="tab"
                           aria-controls="profile" aria-selected="false">Sizes</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post" action="{{route('post_add_color')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Color</label>
                                <input type="text" id="title" name="color" placeholder="Enter name of Brand"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                        <div>
                            <h4>All Colors</h4>
                            <div class="table table-responsive">
                                <table class="table table-bordered css-serial">
                                    <thead>
                                    <tr class="table-primary">
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col"> Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($colors as $color)
                                    <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{$color->title}}</td>
                                    <td><a href='{{ route('delete_color',$color->id) }}'>
                                    <button class="btn btn-warning"> Delete</button>
                                    </a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="size" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('post_add_size') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="add_brand">Add Sizes</label>
                                <input type="text" name="size" class="form-control" placeholder="Enter Size" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div>
                            <h4>All Sizes</h4>
                            <div class="table table-responsive">
                                <table class="table table-bordered css-serial">
                                    <thead>
                                    <tr class="table-primary">
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col"> Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sizes as $size)
                                        <tr>
                                            <td>{{ $size->id }}</td>
                                            <td>{{$size->title}}</td>
                                            <td><a href='{{ route('delete_size',$size->id) }}'>
                                                    <button class="btn btn-warning"> Delete</button>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection