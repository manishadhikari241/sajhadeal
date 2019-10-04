@extends('admin.layout.master')

@section('styles')

    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{ asset('admin/css/smart_wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/smart_wizard_theme_arrows.css') }}">


@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">
                <h1 class=" text-dark">Add Products</h1>
                @if(session('success'))
                    <span class="alert alert-success">{{ session('success') }}</span>
                @endif
                <div style="padding-left: 20px; color:#c3c7cb; font-size:15px">
                    <span style="color: red;">*</span> fields should be filled compulsorily
                </div>
            </div>
            <div class="alert alert-danger error_package" id="error-section" style="display: none">
            </div>
            <div class="card-body">
                <form action="/store_products" id="add_product" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">GENERAL<br/>
                                    <small>Product description</small>
                                </a></li>
                            <li><a href="#step-2">GENERAL<br/>
                                    <small>Price and Images</small>
                                </a></li>
                            <li><a href="#step-3">Additional<br/>
                                    <small>Product Additional</small>
                                </a></li>
                            <li><a href="#step-4">Additional<br/>
                                    <small>SEOs</small>
                                </a></li>
                        </ul>
                        <div>
                            <div id="step-1" class="">
                                <br>
                                <h4>
                                    <span style="color: red;">*</span> <label>Title</label>
                                </h4>
                                <div class="form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                           placeholder="Enter the Title">
                                </div>
                                <span class="error_message" id="title_error" style="display:none; color: red"></span>
                                <hr>
                                <h4>
                                    <span style="color: red;">*</span> <label>SKU</label>
                                </h4>
                                <div class="form-group">
                                    <input type="text" id="sku" class="form-control" name="sku"
                                           placeholder="Enter the SKU">
                                </div>
                                <span class="error_message" id="sku_error" style="display:none; color: red"></span>
                                <hr>
                                <h4>
                                    <label>Brand</label>
                                </h4>
                                <div class="form-group">

                                    <select id="brand" name="brand" class="form-control">
                                        <option value="" selected>Select a brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="error_message" id="brand_error"
                                      style="display:none; color: red"></span>
                                <hr>
                                <h4><span style="color: red;">*</span><label for="category">Category</label></h4>
                                <div class="form-group">
                                    <select id="category" name="category_id[]" class="form-control" multiple="multiple">
                                        <option value="">Select a category ...</option>
                                        @foreach($categories as $category)
                                            @if($category->children->count()>0)
                                                <option value="{{$category->id}}" disabled
                                                        style="color: red">{{$category->title}}</option>
                                                @foreach($category->children as $sub_category)
                                                    @if($sub_category->children->count()>0)
                                                        <option value="{{$sub_category->id}}" disabled
                                                                style="color: blue">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                                        @foreach($sub_category->children as $grand_category)
                                                            <option value="{{ $grand_category->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $grand_category->title }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="{{$sub_category->id}}" style="color: blue">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <span class="error_message" id="category_error" style="display:none; color: red"></span>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <h4><span style="color: red;">*</span><label> Enter Status</label></h4>

                                            Show <input type="radio" name="status" value="1">
                                            Hide <input type="radio" name="status" value="0">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="on_sal_input" value="0">
                                        <div class="form-group">

                                            <h4><span style="color: red;">*</span><label> On Sale?</label></h4>

                                            Yes <input type="radio" name="on_sale" value="1">
                                            No <input type="radio" name="on_sale" value="0">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="featured" value="0">
                                        <div class="form-group">

                                            <h4><span style="color: red;">*</span><label> Featured?</label></h4>

                                            Yes <input type="radio" name="featured" value="1">
                                            No <input type="radio" name="featured" value="0">

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h4>
                                    <label>Package New</label>
                                </h4>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="new_start_date">
                                                From:
                                            </label>
                                            <input type="text" id="new_start_date"
                                                   name="new_start_date" class="form-control datepicker"
                                                   placeholder="YYYY-MM-DD">
                                            <span class="error_message" id="new_start_date_error"
                                                  style="display:none; color: red"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="new_end_date">
                                                To:
                                            </label>
                                            <input type="text" id="new_end_date"
                                                   name="new_end_date" class="form-control datepicker"
                                                   placeholder="YYYY-MM-DD">
                                            <span class="error_message" id="new_end_date_error"
                                                  style="display:none; color: red"></span>
                                        </div>
                                    </div>
                                    <span class="error_message" id="title_error"
                                          style="display:none; color: red"></span>
                                </div>
                                <hr>
                                <h4><span style="color: red;">*</span>Sizes</h4>
                                <div class="form-group">
                                    <input type="radio" class="no_size" name="size_type" value="0"> Free-size
                                    <input type="radio" class="no_size" name="size_type" value="1"> Size Variations
                                </div>
                                <span class="error_message" id="stock_quantity_error"
                                      style="display:none; color: red"></span>
                                <div class="form-group no_size_form" style="display: none;">
                                    <label for="">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" class="form-control" value="0" min="0">
                                </div>
                                <div class="form-group different_size_form" style="display: none;">
                                    <label for="">Stock Quantity based on Size</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-stocks " width="100%">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Size</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <button class="btn btn-primary btn-sm btn-add-stocks">
                                                            Add New
                                                        </button>
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="step-2" class="">
                                <br>
                                <h4>
                                    <span style="color: red;">*</span> <label>Price</label>
                                </h4>
                                <div class="form-group">
                                    <input type="text" id="price" class="form-control" name="price"
                                           placeholder="Enter the Price">
                                </div>
                                <span class="error_message" id="price_error" style="display:none; color: red"></span>
                                <hr>
                                <h4>
                                    <label>Selling Price</label>
                                </h4>
                                <div class="form-group">

                                    <input type="text" id="sale_price" class="form-control" name="sale_price"
                                           placeholder="Enter the Selling Price">

                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="special_start_date">
                                                FROM:
                                            </label>
                                            <input type="text" id="special_start_date"
                                                   name="special_start_date" class="form-control datepicker"
                                                   placeholder="YYYY-MM-DD">
                                            <span class="error_message" id="special_start_date_error"
                                                  style="display:none; color: red"></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="special_end_date">
                                                TO:
                                            </label>
                                            <input type="text" id="special_end_date"
                                                   name="special_end_date" class="form-control datepicker"
                                                   placeholder="YYYY-MM-DD">
                                            <span class="error_message" id="special_end_date_error"
                                                  style="display:none; color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <h4><span style="color: red;">*</span><label for=""> Enter Images of the
                                        Product </label></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-images " width="100%">
                                            <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Image</th>
                                                <th>Main</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button class="btn btn-primary btn-sm btn-add-images">
                                                        Add New
                                                    </button>
                                                </th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h4>
                                    <label>Enter Video Url (Youtube)</label>
                                </h4>
                                <div class="form-group">

                                    <input type="text" class="form-control" name="video"
                                           placeholder="Paste the Url of the Video">

                                </div>
                            </div>
                            <div id="step-3" class="">
                                {{--<select class="js-example-basic-multiple" name="tags[]" multiple="multiple">--}}
                                <br>
                                <h4><label for=""> Enter Features </label></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-features">
                                            <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Feature</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button class="btn btn-primary btn-sm btn-add-features">
                                                        Add New
                                                    </button>
                                                </th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr>


                                <h4><label>Add Specifications</label></h4>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-specifications">
                                            <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Specification</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button class="btn btn-primary btn-sm btn-add-specifications">
                                                        Add New
                                                    </button>
                                                </th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h4><label for="tags">Tags</label></h4>
                                    <select name="tags[]" id="tags" class="js-example-basic-multiple"
                                            multiple="multiple" style="width: 800px; position: relative">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <h4>
                                    <span style="color: red;">*</span><label for="">Brief Description</label>
                                </h4>
                                <div class="form-group">
                            <textarea name="short_description" id="short_description" class="form-control"
                                      placeholder="Brief Description"></textarea>
                                </div>
                                <span class="error_message" id="short_description_error"
                                      style="display:none; color: red"></span>
                                <hr>

                                <h4>
                                    <label for="">Detailed Description</label>
                                </h4>
                                <div class="form-group">
                            <textarea name="long_description" id="editor2" rows="5" class="form-control"
                                      placeholder="Detail Description"></textarea>
                                </div>
                                <br>

                                {{--<div id="tab05" class="tab-contents">--}}
                                {{--<h2>Extra</h2>--}}
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius--}}
                                {{--quos aliquam--}}
                                {{--consequuntur, esse--}}
                                {{--provident impedit minima porro! Laudantium laboriosam culpa quis--}}
                                {{--fugiat ea,--}}
                                {{--architecto velit ab,--}}
                                {{--deserunt rem quibusdam voluptatum.</p>--}}
                                {{--</div>--}}
                            </div>
                            <div id="step-4">
                                <br>
                                <div class="smart-wizard-form-inner">
                                    <h4>Seos</h4>
                                    <div class="form-group">
                                        <label>SEO Keyword</label>
                                        <textarea name="seo_keyword" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>SEO Description</label>
                                        <textarea name="seo_description" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.main-wrapper -->


    </div>
    <!-- /.content-wrapper -->


@endsection



@section('script')


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('admin/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('admin/js/form_script.js') }}"></script>


    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#short_description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        // multiple stock-sizes
        jQuery(document).on('click', '.btn-delete-stocks', function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.closest("tr").remove();
        });

        jQuery(document).on('click', '.btn-add-stocks', function (e) {
            e.preventDefault();
            // console.log('tgd');
            var lastRow = $('table.table-stocks > tbody > tr').last().attr('data-row');
            var counter = lastRow ? parseInt(lastRow) + 1 : 1;
            var randomInteger = generateRandomInteger();
            var newRow = jQuery('<tr data-row="' + counter + '">' +
                '<td>' + counter + '</td>' +
                '<td><select name="size[' + randomInteger + ']" required>' +
                '@foreach($sizes as $size)' +
                '<option value="{{ $size->id}}">{{ $size->title}}</option>' +
                '@endforeach' +
                '</select></td>' +
                '<td><input type="number" name="size_stocks[' + randomInteger + ']" value="0" required min="0"></td>' +
                '<td><button type="button" class="btn btn-danger btn-sm btn-delete-images" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
                '</tr>');
            jQuery('table.table-stocks').append(newRow);
        });

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('input[type=radio][name=size_type]').change(function () {
            if (this.value == '0') {
                $('.different_size_form').hide();
                $('.no_size_form').show();
            }
            else if (this.value == '1') {
                $('.no_size_form').hide();
                $('.different_size_form').show();
            }
        });
    </script>
    {{--script for form validation with ajax submit--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $('form').on('submit', function (e) {

                e.preventDefault();

                let myForm = document.getElementById('add_product');
                let formData = new FormData(myForm);


                $.ajax({
                    type: 'post',
                    url: '{{ route('post_add_products') }}',
                    // data: $('form').serialize(),
                    // dataType: "JSON",
                    data: formData,
                    // data: new FormData($('form')),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        window.location = response.route;
                    },
                    error: function (response) {
                        console.log(response.responseJSON.errors);

                        //remove error form fields
                        $("#title").parent('div.form-group').removeClass('has-error');
                        $("#sku").parent('div.form-group').removeClass('has-error');
                        $("#stock_quantity").parent('div.form-group').removeClass('has-error');
                        $("#category").parent('div.form-group').removeClass('has-error');
                        $("#short_description").parent('div.form-group').removeClass('has-error');
                        $("#price").parent('div.form-group').removeClass('has-error');
                        // $("#meals").parent('div.form-group').removeClass('has-error');
                        $("#special_start_date").parent('div.form-group').removeClass('has-error');
                        $("#special_end_date").parent('div.form-group').removeClass('has-error');
                        // $("#error_departure").hide();

                        $("#new_start_date").parent('div.form-group').removeClass('has-error');
                        $("#new_end_date").parent('div.form-group').removeClass('has-error');
                        // $("#accommodations").parent('div.form-group').removeClass('has-error');
                        // $("#days").parent('div.form-group').removeClass('has-error');

                        $(".error_package").empty();
                        $(".error_package").show();
                        $(".error_message").empty();
                        $(".error_message").show();

                        setTimeout(function () {
                            $('error_message').remove();
                        }, 5000);

                        $(".error_package").append("<p>Please Correct The Errors in the Form</p>");
                        $.each(response.responseJSON.errors, function (key, item) {
                            // jquery(".alert-danger").show();
                            // $(".error_package").append("<p>"+item+"</p>");
                            if (item === 'Please Enter Title of the Product') {
                                $("#title").parent('div.form-group').addClass('has-error');
                                $('#title_error').append('<p>Please enter the "Title of Package"</p>');
                                $('_error').append('<p></p>');
                            }
                            if (item === 'Please Enter SKU of the Product') {
                                $("#sku").parent('div.form-group').addClass('has-error');
                                $('#sku_error').append('<p>Please enter the "SKU of Package"</p>');
                                $('_error').append('<p></p>');
                            }
                            if (item === 'The size type field is required.') {
                                $("#stock_quantity").parent('div.form-group').addClass('has-error');
                                $('#stock_quantity_error').append('<p>Please Select an Option</p>');
                            }
                            if (item === 'Please Select a Category') {
                                $("#category").parent('div.form-group').addClass('has-error');
                                $('#category_error').append('<p>Please select a "Category"</p>');
                            }
                            // if(item === 'The "Accommodations" field is required.'){
                            //     $("#accommodations").parent('div.form-group').addClass('has-error');
                            //     $('#accommodations_error').append('<p>The "Accommodations" field is required.</p>');
                            // }
                            if (item === 'Please Enter Price of the Product') {
                                $("#price").parent('div.form-group').addClass('has-error');
                                $('#price_error').append('<p>The "Price" field is required.</p>');
                            }
                            // if(item === 'The "Meals" field is required.'){
                            //     $("#meals").parent('div.form-group').addClass('has-error');
                            //     $('#meals_error').append('<p>The "Meals" field is required.</p>');
                            // }
                            // if(item === 'The "Days" field is required.'){
                            //     $("#days").parent('div.form-group').addClass('has-error');
                            //     $('#days_error').append('<p>The "Days" field is required.</p>');
                            // }
                            if (item === 'The "New From" field format should be YYYY-MM-DD') {
                                $("#new_start_date").parent('div.form-group').addClass('has-error');
                                $('#new_start_date_error').append('<p>The "New From" field format should be YYYY-MM-DD</p>');
                            }
                            if (item === 'The "New To" field format should be YYYY-MM-DD') {
                                $("#new_end_date").parent('div.form-group').addClass('has-error');
                                $('#new_end_date_error').append('<p>The "New To" field format should be YYYY-MM-DD</p>');
                            }
                            if (item === 'The "New To" field should be a date equal or after "New From"') {
                                $("#new_end_date").parent('div.form-group').addClass('has-error');
                                $('#new_end_date_error').append('<p>The "New To" field should be a date equal or after "New From"</p>');
                            }
                            if (item === 'The "Special Price From" field format should be YYYY-MM-DD') {
                                $("#special_start_date").parent('div.form-group').addClass('has-error');
                                $('special_start_date_error').append('<p>The "Special Price From" field format should be YYYY-MM-DD</p>');
                            }
                            if (item === 'The "Special Price End" field format should be YYYY-MM-DD') {
                                $("#special_end_date").parent('div.form-group').addClass('has-error');
                                $('#special_end_date_error').append('<p>The "Special Price End" field format should be YYYY-MM-DD</p>');
                            }
                            if (item === 'The "Special Price End" field should be a date equal or after "Special Price From') {
                                $("#special_end_date").parent('div.form-group').addClass('has-error');
                                $('#special_end_date_error').append('<p>The "Special Price End" field should be a date equal or after "Special Price From"</p>');
                            }
                            // if(item === 'The Departure Dates format should be YYYY-MM-DD'){
                            //     $("#error_departure").show();
                            //     $('#departure_error').append('<p>The Departure Dates format should be YYYY-MM-DD</p>');
                            // }

                            if (item === 'Please Enter Short Description') {
                                $("#short_description").parent('div.form-group').addClass('has-error');
                                $('#short_description_error').append('<p>The "Short Description" field is required.</p>');
                            }
                        });
                    }

                });

            });

        });
    </script>

    <script>
        $(document).ready(function () {
            $('#category').select2();
        });
    </script>

@endsection
