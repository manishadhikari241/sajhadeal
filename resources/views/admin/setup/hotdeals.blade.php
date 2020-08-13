@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection
@section('content')

            <div class="col-md-9 ">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title" text align="center">Hot Deals Setting</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{route('update-deal')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="timer">Current Deal Date and Time :</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text"
                                               value="{{\App\Helper\HotDeal::getHotdeal('date')}}"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="timer">Choose End Date and Time :</label>
                                    </div>
                                    <div class="col-sm-5">

                                        <input type="datetime-local" name="date" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>


                            </form>


                        </div>


                    </div>


            </div>

            <div class="container">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title" text align="center">Hot Deals Product</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table id="package_table" class="table table-sm table-striped datatable">
                                    <thead>
                                    <tr class="table table-primary">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Featured</th>
                                        <th>SKU</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th><i class="fa fa-image"></i></th>
                                        <th>On Sale</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>@if($product->featured == 0)
                                                    Not Featured
                                                @else
                                                    Featured
                                                @endif</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    Shown
                                                @else
                                                    Hidden
                                                @endif
                                            </td>
                                            <td>@foreach($product->category as $value)
                                                    {{$value->title .','}}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($product->images as $image)
                                                    <img src="{{ asset($image->image) }}" alt="image"
                                                         style="max-height: 120px; max-width: auto">
                                                    @break
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($product->on_sale==1)
                                                    <button class="btn btn-success btn btn-sm"><i class="fa fa-check"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn btn-sm"><i class="fa fa-times"></i></button>

                                                @endif
                                            </td>
                                            <td>@if($product->size_variation == 0)
                                                    @if($product->stock_quantity <= 0)Out of Stock @else {{$product->stock_quantity}} @endif
                                                @else
                                                    @if(isset($product->stocks))
                                                        <ul>
                                                            @foreach($product->stocks as $stock)
                                                                <li>
                                                                    {{ $stock->size->title }}&nbsp;:&nbsp;@if($stock->stock <= 0)Out of
                                                                    Stock @else {{ $stock->stock }} @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm-group btn-primary" href="{{ route('edit_product',$product->id)  }}">Edit
                                                </a>

                                                <button class="btn btn-sm-group btn-danger" data-toggle="modal"
                                                        data-target="#delete_product{{ $product->id }}">Delete
                                                </button>

                                                <div class="modal fade" id="delete_product{{ $product->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Product !!</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Are you sure want to delete this product and its associated
                                                                    data?</h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('delete_product',$product->id) }}"
                                                                   class="btn btn-success">
                                                                    Yes
                                                                </a>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{--<a href="{{ route('package_reviews',$package->id) }}" class="btn btn-outline-primary">Reviews</a>--}}

                                                {{--<button class="btn btn-sm-group btn-success" data-toggle="modal"--}}
                                                {{--data-target="#quick_edit_package{{ $package->id }}">Quick Edit--}}
                                                {{--</button>--}}

                                                {{--<div class="modal fade bd-example-modal-lg" id="quick_edit_package{{ $package->id }}"--}}
                                                {{--tabindex="-1" role="dialog"--}}
                                                {{--aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
                                                {{--<div class="modal-dialog modal-lg" role="document">--}}
                                                {{--<div class="modal-content">--}}
                                                {{--<div class="modal-header">--}}
                                                {{--<h5 class="modal-title" id="exampleModalLongTitle">Update Package Info--}}
                                                {{--!!</h5>--}}
                                                {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                {{--aria-label="Close">--}}
                                                {{--<span aria-hidden="true">&times;</span>--}}
                                                {{--</button>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-body">--}}
                                                {{--<div class="quick_edit_form">--}}
                                                {{--<div class="container-fluid">--}}
                                                {{--<h6>Upcoming Departures:</h6>--}}
                                                {{--<div class="table-responsive">--}}
                                                {{--<table>--}}

                                                {{--</table>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="container-fluid">--}}
                                                {{--<h6>Manage Prices:</h6>--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label for="price"></label>--}}
                                                {{--<input type="number">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-footer">--}}
                                                {{--<button type="submit" class="btn btn-success">--}}
                                                {{--Update--}}
                                                {{--</button>--}}
                                                {{--<button type="button" class="btn btn-secondary"--}}
                                                {{--data-dismiss="modal">Close--}}
                                                {{--</button>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Featured</th>
                                        <th>SKU</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th><i class="fa fa-image"></i></th>
                                        <th>On Sale</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!-- /.box -->

                            </div>

                        </div>

                    </div>


                </div>

            </div>


@endsection
@section('script')
    <script src="{{ asset('admin/js/tables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/tables/dataTables.bootstrap4.js') }}"></script>
<script>
    $('#package_table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(\Illuminate\Support\Facades\Session::has('success'))
        toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}");
        @endif
        @if(\Illuminate\Support\Facades\Session::has('error'))
        toastr.error("{{\Illuminate\Support\Facades\Session::get('error')}}");
        @endif
        @if(\Illuminate\Support\Facades\Session::has('info'))
        toastr.info("{{\Illuminate\Support\Facades\Session::get('info')}}");
        @endif
        @if ($errors->any())
        @foreach($errors->all() as $error)
        toastr.warning("{{ $error }}");
        @endforeach
        @endif

    </script>

@endsection
