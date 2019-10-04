@extends('admin.layout.master')

@section('styles')

    {{--page specific styles--}}



@endsection

@section('content')

    {{--main content--}}
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Coupons</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="package_table" class="table table-bordered">
                <thead>
                <tr class="table table-primary">
                    <th>ID</th>
                    <th>Coupon Code</th>
                    <th>Coupon Type</th>
                    <th>Amt / Percent</th>
                    <th>Cutoff Amt</th>
                    <th>Max User</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>{{ $coupon->discount_type }}</td>
                        <td>
                            @if($coupon->discount_type=="fixed")
                                $ {{ $coupon->discount }}
                            @else
                                {{ $coupon->discount }} %
                                @endif
                        </td>
                        <td>{{ $coupon->max_amount }}</td>
                        <td>{{ $coupon->max_users }}</td>
                        <td>{{ $coupon->expiry_date }}</td>


                        <td>


                            <button class="btn btn-sm-group btn-danger" data-toggle="modal"
                                    data-target="#delete_product{{ $coupon->id }}">Delete
                            </button>

                            <div class="modal fade" id="delete_product{{ $coupon->id }}" tabindex="-1" role="dialog"
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
                                            <h6>Are you sure want to delete this Code data?</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('delete_coupon',$coupon->id) }}"
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




                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection


@section('script')

    {{--page specific scripts--}}
    <script src="{{ asset('admin/js/tables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/tables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#package_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>

@endsection