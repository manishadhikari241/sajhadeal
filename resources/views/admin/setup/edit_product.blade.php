@extends('admin.layout.master')

@section('styles')

    <link rel="stylesheet" href="{{ asset('admin/css/smart_wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/smart_wizard_theme_arrows.css') }}">
    {{--<!-- Latest compiled and minified CSS -->--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"--}}
    {{--integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<!-- Optional theme -->--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"--}}
    {{--integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

@endsection

@section('content')



    @if(Session::has('success'))
        <span class="alert alert-success">{{ session('success') }}</span>
    @endif
    <div class="alert alert-danger error_package" id="error-section" style="display: none"></div>
    <!-- Content Header (Page header) -->

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-product"
                                   role="tab"
                                   aria-controls="pills-home" aria-selected="true">
                                    Edit Products - {{$product->title}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-image"
                                   role="tab"
                                   aria-controls="pills-profile" aria-selected="false">Manage Images</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show in active" id="pills-product" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <form action="{{ route('post_edit_product',$product->id) }}" class="product_data"
                              id="edit_product" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div id="smartwizard">
                                <ul>
                                    <li><a href="#step-1">GENERAL<br/>
                                            <small>Product description</small>
                                        </a></li>
                                    <li><a href="#step-2">GENERAL<br/>
                                            <small>Price</small>
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
                                        <div style="padding-left: 20px; color:#c3c7cb; font-size:15px">
                                            <span style="color: red;">*</span> fields should be filled compulsorily
                                        </div>
                                        <br>
                                        <h4>
                                            <label><span style="color: red;">*</span>Title</label>
                                        </h4>
                                        <div class="form-group">
                                            <input type="text" id="title" class="form-control" name="title"
                                                   placeholder="Enter the Title" value="{{ $product->title }}">
                                        </div>
                                        <span class="error_message" id="title_error"
                                              style="display:none; color: red"></span>
                                        <hr>
                                        <h4>
                                            <span style="color: red;">*</span> <label>SKU</label>
                                        </h4>
                                        <div class="form-group">
                                            <input type="text" id="sku" class="form-control" name="sku"
                                                   placeholder="Enter the SKU" value="{{ $product->sku }}">
                                        </div>
                                        <span class="error_message" id="sku_error"
                                              style="display:none; color: red"></span>
                                        <hr>
                                        <h4><label for="category"><span style="color: red;">*</span>Category</label>
                                        </h4>
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
                                                                    {{--<option value="{{ $grand_category->id }}"--}}
                                                                            {{--@if($grand_category->id == $product->category_id) selected @endif>--}}
                                                                        {{--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $grand_category->title }}</option>--}}
                                                                    <option value="{{ $grand_category->id }}"
                                                                            @if(\Illuminate\Support\Facades\DB::table('category_product')->where('product_id',$product->id)->where('category_id',$grand_category->id)->get()->isNotEmpty()) selected @endif>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $grand_category->title }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="{{$sub_category->id}}"
                                                                        style="color: blue"
                                                                        @if(\Illuminate\Support\Facades\DB::table('category_product')->where('product_id',$product->id)->where('category_id',$sub_category->id)->get()->isNotEmpty()) selected @endif>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{$sub_category->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="{{ $category->id }}"
                                                                @if($category->id == $product->category_id) selected @endif>{{ $category->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="error_message" id="category_error"
                                              style="display:none; color: red"></span>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <h4><label> Enter Status</label></h4>

                                                    Show <input type="radio" name="status" value="1"
                                                                @if($product->status == 1) checked @endif>
                                                    Hide <input type="radio" name="status" value="0"
                                                                @if($product->status == 0) checked @endif>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <h4><label>Featured?</label></h4>

                                                    Yes <input type="radio" name="featured" value="1"
                                                               @if($product->featured == 1) checked @endif>
                                                    No <input type="radio" name="featured" value="0"
                                                              @if($product->featured == 0) checked @endif>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="on_sal_input" value="0">
                                                <div class="form-group">

                                                    <h4><span style="color: red;">*</span><label> On Sale?</label></h4>

                                                    Yes <input type="radio" name="on_sale" value="1"
                                                               @if($product->on_sale == 1) checked @endif>
                                                    No <input type="radio" name="on_sale" value="0"
                                                              @if($product->on_sale == 0) checked @endif>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="hot_deal" value="0">
                                                <div class="form-group">

                                                    <h4><span style="color: red;">*</span><label> Add to HotDeal?</label></h4>

                                                    Yes <input type="radio" name="hot_deal" value="1"
                                                               @if($product->hot_deal == 1) checked @endif>
                                                    No <input type="radio" name="hot_deal" value="0"
                                                              @if($product->hot_deal == 0) checked @endif>

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
                                                           placeholder="YYYY-MM-DD" value="{{ $product->new_from }}">
                                                    <span class="error_message" id="new_start_date_error"
                                                          style="display:none; color: red"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="new_end_date">
                                                        To:
                                                    </label>
                                                    <input type="text" id="new_end_date"
                                                           name="new_end_date" class="form-control datepicker"
                                                           placeholder="YYYY-MM-DD" value="{{ $product->new_to }}">
                                                    <span class="error_message" id="new_end_date_error"
                                                          style="display:none; color: red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4><span style="color: red;">*</span>Sizes</h4>
                                        <div class="form-group">
                                            <input type="radio" class="no_size" name="size_type" value="0"
                                                   @if($product->size_variation ==0 ) checked @endif
                                            > Free-size
                                            <input type="radio" class="no_size" name="size_type" value="1"
                                                   @if($product->size_variation == 1 ) checked @endif
                                            > Size Variations
                                        </div>
                                        <span class="error_message" id="stock_quantity_error"
                                              style="display:none; color: red"></span>
                                        <div class="form-group no_size_form"
                                             style="display: @if($product->size_variation == 0) block @else none @endif;">
                                            <label for="">Stock Quantity</label>
                                            <input type="number" name="stock_quantity" class="form-control"
                                                   value="{{ $product->stock_quantity }}"
                                                   min="0">
                                        </div>
                                        <div class="form-group different_size_form"
                                             style="display:@if($product->size_variation == 1) block @else none @endif;">
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
                                                        @php $count=1; @endphp
                                                        <tbody>
                                                        @if($product->stocks->count()>0)
                                                            @foreach($product->stocks as $stock)
                                                                <tr data-row="{{ $count }}">
                                                                    <td>{{ $count }}</td>
                                                                    <td>
                                                                        <select name="size[{{$stock->id}}]">
                                                                            <option value="{{$stock->size->id}}"

                                                                            >   {{$stock->size->title}}
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="number"
                                                                               name="size_stocks[{{$stock->id}}]"
                                                                               value="{{$stock->stock}}" min="0"></td>
                                                                    <td>
                                                                        <button type="button"
                                                                                class="btn btn-danger btn-sm btn-delete-features"
                                                                                data-feature=""><i
                                                                                    class="fa fa-minus-circle"></i>
                                                                        </button>
                                                                    </td>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
                                        <div style="padding-left: 20px; color:#c3c7cb; font-size:15px">
                                            <span style="color: red;">*</span> fields should be filled compulsorily
                                        </div>
                                        <br>
                                        <h4>
                                            <label><span style="color: red;">*</span>Price</label>
                                        </h4>
                                        <div class="form-group">
                                            <input type="text" id="price" class="form-control" name="price"
                                                   placeholder="Enter the Price" value="{{ $product->price }}">
                                        </div>
                                        <span class="error_message" id="price_error"
                                              style="display:none; color: red"></span>
                                        <hr>
                                        <h4>
                                            <label>Selling Price</label>
                                        </h4>
                                        <div class="form-group">

                                            <input type="text" id="sale_price" class="form-control" name="sale_price"
                                                   placeholder="Enter the Selling Price"
                                                   value="{{ $product->sale_price }}">

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
                                                           placeholder="YYYY-MM-DD"
                                                           value="{{ $product->special_from }}">
                                                    <span class="error_message" id="special_start_date_error"
                                                          style="display:none; color: red"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="special_end_date">
                                                        TO:
                                                    </label>
                                                    <input type="text" id="special_end_date"
                                                           name="special_end_date" class="form-control datepicker"
                                                           placeholder="YYYY-MM-DD" value="{{ $product->special_to }}">
                                                    <span class="error_message" id="special_end_date_error"
                                                          style="display:none; color: red"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-3" class="">
                                        {{--<select class="js-example-basic-multiple" name="tags[]" multiple="multiple">--}}
                                        <div style="padding-left: 20px; color:#c3c7cb; font-size:15px">
                                            <span style="color: red;">*</span> fields should be filled compulsorily
                                        </div>
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
                                                    @php $count=1; @endphp
                                                    <tbody>
                                                    @foreach($product->features as $feature)
                                                        <tr data-row="{{ $count }}">
                                                            <td>{{ $count }}</td>
                                                            <td>
                                                                <input type="text" name="feature[{{ $feature->id }}]"
                                                                       value="{{ $feature->title }}">
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm btn-delete-features"
                                                                        data-feature=""><i
                                                                            class="fa fa-minus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        @php $count++; @endphp
                                                    @endforeach
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
                                                    </thead>@php $count=1; @endphp
                                                    <tbody>
                                                    @foreach($product->specifications as $spec)
                                                        <tr data-row="{{ $count }}">
                                                            <td>{{ $count }}</td>
                                                            <td>
                                                                <input type="text" name="spec[title][{{ $spec->id }}]"
                                                                       value="{{ $spec->title }}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       name="spec[specification][{{ $spec->id }}]"
                                                                       value="{{ $spec->specification }}">
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm btn-delete-specifications"
                                                                        data-feature=""><i
                                                                            class="fa fa-minus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        @php $count++; @endphp
                                                    @endforeach
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


                                        {{--<h4>Colors</h4><br>--}}
                                        {{--<div class="form-group">--}}
                                        {{--<label>--}}
                                        {{--<select class="form-control js-example-basic-multiple"--}}
                                        {{--multiple="multiple"--}}
                                        {{--name="colors[]">--}}
                                        {{--@foreach($colors as $color)--}}


                                        {{--<option value="{{ $color->id }}">{{ $color->title }}</option>--}}

                                        {{--@endforeach--}}
                                        {{--</select>--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        {{--<hr>--}}
                                        <div class="form-group">
                                            <h4><label for="tags">Tags</label></h4>
                                            <select name="tags[]" id="tags" class="js-example-basic-multiple"
                                                    multiple="multiple" style="width: 900px;">
                                                @foreach($tags as $tag)
                                                    <option value="{{$tag->id}}"
                                                            @foreach($product->tags as $sel_tag)
                                                            @if($sel_tag->id == $tag->id)
                                                            selected
                                                            @endif
                                                            @endforeach
                                                    >
                                                        {{ $tag->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <h4>
                                            <label>Enter Video Url (Youtube)</label>
                                        </h4>
                                        <div class="form-group">

                                            <input type="text" class="form-control" name="video"
                                                   placeholder="Paste the Url of the Video"
                                                   value="{{ $product->video }}">

                                        </div>
                                        <hr>
                                        <h4>
                                            <label for=""><span style="color: red;">*</span>Brief Description</label>
                                        </h4>
                                        <div class="form-group">
                            <textarea name="short_description" id="short_description" class="form-control"
                                      placeholder="Brief Description">{{ $product->short_description }}</textarea>
                                        </div>
                                        <span class="error_message" id="short_description_error"
                                              style="display:none; color: red"></span>
                                        <hr>

                                        <h4>
                                            <label for="">Detailed Description</label>
                                        </h4>
                                        <div class="form-group">
                            <textarea name="long_description" id="editor2" rows="5" class="form-control"
                                      placeholder="Detail Description">{{ $product->long_description }}</textarea>
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
                                                <textarea name="seo_keyword"
                                                          class="form-control">@if($product->seo()->exists()){{ $product->seo->seo_keyword }}@endif</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>SEO Description</label>
                                                <textarea name="seo_description" rows="3"
                                                          class="form-control">@if($product->seo()->exists()){{ $product->seo->seo_description }}@endif</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <textarea name="seo_title"
                                                          class="form-control">@if($product->seo()->exists()){{ $product->seo->seo_title }}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Update Product</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade in" id="pills-image" role="tabpanel">
                        <div class="jumbotron jumbotron-image">
                            <div class="container-fluid">
                                <form action="{{ route('edit_upload',$product->id) }}" id="image_form" method="post"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input type="file" name="upload" id="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button id="upload_submit" class="btn btn-success form-control upload_submit">
                                            Upload
                                        </button>
                                    </div>
                                </form>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img class="upload img-responsive" src="{{ asset($image->image) }}"
                                                     alt="image" style="height: 300px;width: auto;">
                                                <hr>
                                                <div class="box-button" style="padding: 0px 20px 10px 20px">
                                                    {{--<input type="hidden" name="image[is_main][{{$image->id}}]" value="0">--}}
                                                    <input class="is_main" type="radio" name="is_main"
                                                           data-id="{{$image->id}}" id="main{{$image->id}}"
                                                           @if($image->is_main == '1') checked @endif
                                                    > Is Main?
                                                    {{--                                <input type="hidden" name="image[title][{{$image->id}}]" value="{{$image->title}}">--}}
                                                    <button class="remove_image btn btn-danger" id="{{ $image->id }}">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.main-wrapper -->

@endsection



@section('script')

    <!-- Latest compiled and minified JavaScript -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('admin/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('admin/js/form_edit.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

    <script src="http://malsup.github.com/jquery.form.js"></script>

    <script>
        $("body").on("click", ".upload_submit", function (event) {
            // event.preventDefault();
            // $(this).parents("form").ajaxForm(options);
            $("#image_form").ajaxForm(options);
        });
        var options = {
            complete: function (response) {
                if ($.isEmptyObject(response.responseJSON.error)) {
                    alert('Image upload successful');
                    $(".jumbotron-image").load(" .jumbotron-image");
                } else {
                    alert('Error in uploading');
                }
            }
        };
    </script>

    <script>
        $("body").on("click", ".is_main", function (event) {
            var id = $(this).attr("data-id");
            console.log(id);
            $.ajax(
                {
                    url: "is_main_edit/" + id,
                    type: 'GET',
                    dataType: "JSON",
                    success: function (response) {
                        $(".jumbotron-image").load(" .jumbotron-image");
                        console.log(response);
                    },
                    error: function () {
                        alert("It failed");
                    }
                });
        });
    </script>

    <script>
        $("body").on("click", ".remove_image", function (e) {
            e.preventDefault();
            let id = $(this).attr("id");
            console.log("image_id : " + id);
            $.ajax(
                {
                    url: "image_delete/" + id,
                    type: 'GET',
                    dataType: "JSON",
                    success: function (response) {
                        alert("Image Deleted");
                        $(".jumbotron-image").load(" .jumbotron-image");
                        // $(".message").text(response.success);
                        // $(".message").show();
                    },
                    error: function () {
                        alert("It failed");
                    }
                });

        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $("body").on('submit', 'form.product_data', function (e) {

                e.preventDefault();
                let myForm = document.getElementById('edit_product');
                let formData = new FormData(myForm);


                $.ajax({
                    type: 'post',
                    url: '{{ route('post_edit_product',$product->id) }}',
                    // data: $('form').serialize(),
                    // dataType: "JSON",
                    data: formData,
                    // data: new FormData($('form')),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        window.location = response.route;
                    },
                    error: function (response) {
                        console.log(response.responseJSON.errors);

                        //remove error form fields
                        $("#title").parent('div.form-group').removeClass('has-error');
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
                                $('#stock_quantity_error').append('<p>Please enter Stock Quantity</p>');
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
