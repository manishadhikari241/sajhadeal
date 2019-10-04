@extends('admin.layout.master')


@section('content')

    <div class="main-wrapper">
        <form action="/store_sizes" method="post" >
            {{ csrf_field() }}
            <div class="form-group">
                <label for="add_brand">Add Sizes</label>
                <input type="text" name="size" class="form-control" placeholder="Enter Size">
            </div>
            <input type="submit" class="btn btn-success pull-right" value="  Submit  ">
        </form>
</div>
    </div>

@endsection