@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>ADD COUPONS</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('store_coupons') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="add_brand">Add Coupon</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter Coupon Code" required>
                    </div>
                    <div class="form-group">
                        <label for="add_brand">Add Type of Amount</label>
                        <select name="discount_type" id="" class="form-control" required>
                            <option value="fixed">Fixed</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_brand">Add Amount Or Percentage</label>
                        <input type="number" name="discount" class="form-control" placeholder="Enter the Amount" required>
                    </div>

                    <div class="form-group">
                        <label for="add_brand">Add Least Purchase Amount Required</label>
                        <input type="number" class="form-control" name="max_amount" placeholder="Enter Maximum Amount" required>

                    </div>
                    <div class="form-group">
                        <label for="add_brand">Add Max User</label>
                        <input type="number" class="form-control" name="max_users" placeholder="Enter Maximum Users" required>

                    </div>
                    <div class="form-group">
                        <label for="add_brand">Add Expiry Date</label>
                        <input type="date" class="form-control" name="expiry_date" placeholder="Enter Expiry-Date" required>

                    </div>
                    <div class="form-group">
                        <label for="add_brand">Add Status</label>
                        <br>
                        <label for="status1">Active</label>
                        <input type="radio" id="status1" name="status" value="1" required>
                        <label for="status2">Inactive</label>
                        <input type="radio" id="status2" name="status" value="0" required>

                    </div>


                    <input type="submit" class="btn btn-success pull-right" value="  Submit  ">
                </form>

            </div>
        </div>
    </div>
@endsection