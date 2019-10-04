<?php

namespace App\Http\Controllers\admin;

use App\Brand;
use App\category;
use App\Color;
use App\Image;
use App\Notifications\NewProduct;
use App\Product;
use App\Size;
use App\Stock;
use App\Tag;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function view_all()
    {
        $products = Product::all();
        return view('admin.display.all_products', compact('products'));
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Please Enter Title of the Product',
            'sku.required' => 'Please Enter SKU of the Product',
            'category_id.required' => 'Please Select a Category',
            'short_description.required' => 'Please Enter Short Description',
            'price.required' => 'Please Enter Price of the Product',
            'stock_quantity.required' => 'Please enter the Stock Quantity',
            'new_start_date.date_format' => 'The "New From" field format should be YYYY-MM-DD',
            'new_end_date.date_format' => 'The "New To" field format should be YYYY-MM-DD',
            'new_end_date.after_or_equal' => 'The "New To" field should be a date equal or after "New From"',
            'special_start_date.date_format' => 'The "Special Price From" field format should be YYYY-MM-DD',
            'special_end_date.date_format' => 'The "Special Price End" field format should be YYYY-MM-DD',
            'special_end_date.after_or_equal' => 'The "Special Price End" field should be a date equal or after "Special Price From"',
        ];

        $validatedData = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:products',
            'sku' => 'required|unique:products',
            'category_id' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'size_type' => 'required',
            'new_start_date' => 'nullable|date_format:Y-m-d',
            'new_end_date' => 'nullable|date_format:Y-m-d|after_or_equal:new_start_date',
            'special_start_date' => 'nullable|date_format:Y-m-d',
            'special_end_date' => 'nullable|date_format:Y-m-d|after_or_equal:special_start_date',
        ], $messages);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()], 400);
        } else {
            $products = new Product();
            $products->on_sale = $request->on_sale;
            $products->title = $request->title;
            $products->price = $request->price;
            $products->sale_price = $request->sale_price;
//            $products->category_id = $request->category_id;
            $products->status = $request->status;
            $products->featured = $request->featured;
            $products->short_description = $request->short_description;
            $products->long_description = $request->long_description;
            $products->sku = $request->sku;
            $products->new_from = $request->new_start_date;
            $products->new_to = $request->new_end_date;
            $products->special_from = $request->special_start_date;
            $products->special_to = $request->special_end_date;
            $products->video = $request->video;
            $products->size_variation = $request->size_type;

//            $products->seo_keyword = $request->seo_keyword;
//            $products->seo_description = $request->seo_description;

            $products->save();

            foreach ($request->category_id as $value) {
                $products->category()->attach($value);
            }

            if ($request->size_type == 0) {
                $products->stock_quantity = $request->stock_quantity;
                $products->save();
            } else {
                if (isset($request->size)) {
                    $keys = array_keys($request->size);
                    foreach ($keys as $key) {
                        $stock = new Stock();
                        $stock->product_id = $products->id;
                        $stock->size_id = $request->size[$key];
                        $products->sizes()->attach($request->size[$key]);
                        $stock->stock = $request->size_stocks[$key];
                        $stock->save();
                    }
                }
            }

            //tags
            if (isset($request->tags)) {
                $products->tags()->attach($request->tags);
            }

            //seos
            if (isset($request->seo_keyword)) {
                $products->seo()->create([
                    'keyword' => $request['seo_keyword'],
                    'description' => $request['seo_description'],
                ]);
            }

            //insertion to faq database

//        if(isset($request->question)) {
//            $question = $request->faqs['question'];
//            $answer = $request->faqs['answer'];
//            $keys = array_keys($answer);
////        dd($keys);
//            foreach ($keys as $key) {
//                $products->faqs()->create([
//                    'question' => $question[$key],
//                    'answer' => $answer[$key],
//                ]);
//            }
//        }
            //insertion to image database
            if ($request->hasFile('image')) {
                $counter = 1;
                foreach ($request->file('image') as $image) {
                    $picture = new Image();
                    $filename = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
                    $upload_path = "images/product/";
                    $db_filename = $upload_path . $filename;
                    $image->move($upload_path, $filename);
                    $picture->image = $db_filename;
                    $picture->product_id = $products->id;

                    if ($request->image_main == $counter) {
                        $picture->is_main = '1';
                    } else {
                        $picture->is_main = '0';
                    }
                    $counter = $counter + 1;

                    $picture->save();
                }
            }


            //features table ma gayo from product controller
            if (isset($request->features)) {
                foreach ($request->feature as $feature) {
                    $products->features()->create([
                        'title' => $feature,
                    ]);
                }
            }


            //specifications table ma gayo from product controller

            if (isset($request->spec)) {

                $title = $request->spec['title'];
                $specification = $request->spec['specification'];
                $keys = array_keys($title);
                foreach ($keys as $key) {
                    $products->specifications()->create([
                        'title' => $title[$key],
                        'specification' => $specification[$key],
                    ]);
                }
            }


            //color_product ko pivot table ma attach

            if (isset($request->colors)) {
                foreach ($request->colors as $color) {
                    $products->colors()->attach($color);
                }
            }

            if (isset($request->sizes)) {
                foreach ($request->sizes as $size) {
                    $products->sizes()->attach($size);
                }
            }

            //notifactions
            $users = Sentinel::getUserRepository()->with('roles')->get();
            foreach ($users as $user) {
                foreach ($user->roles as $role) {
                    if ($role->slug == 'user') {
                        $user->notify(new NewProduct($products));;
                    }
                }
            }

//        return redirect()->back()->with('success','Product Added Successfully');
            Session::flash('success', 'Product Added Successfully');
            return response()->json(['success' => 'Product Added Successfully', 'route' => '/admin/all_products'], 200);
        }
    }

    public function view()
    {
        $user = Sentinel::getUser();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $brands = Brand::all();
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.setup.add_products', compact('categories', 'colors', 'tags', 'sizes', 'user', 'brands'));

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $image) {
            $filename = $image->image;
            if (file_exists(public_path() . '/' . $filename)) {
                unlink(public_path() . '/' . $filename);
            }
            $image->delete();
        }
        $product->specifications()->delete();
        $product->features()->delete();
        $product->seo()->delete();
        $product->order_details()->delete();
        $product->reviews()->delete();
        $product->stocks()->delete();
        $product->sizes()->detach();
        $product->wishlists()->delete();
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
//        $categories = Category::where('parent_id', 0)->get();
        return view('admin.setup.edit_product', compact('product', 'colors', 'tags', 'sizes'));
    }

    public function post_edit(Request $request, $id)
    {
        $messages = [
            'title.required' => 'Please Enter Title of the Product',
            'sku.required' => 'Please Enter SKU of the Product',
            'category_id.required' => 'Please Select a Category',
            'short_description.required' => 'Please Enter Short Description',
            'price.required' => 'Please Enter Price of the Product',
            'stock_quantity.required' => 'Please enter the Stock Quantity',
            'new_start_date.date_format' => 'The "New From" field format should be YYYY-MM-DD',
            'new_end_date.date_format' => 'The "New To" field format should be YYYY-MM-DD',
            'new_end_date.after_or_equal' => 'The "New To" field should be a date equal or after "New From"',
            'special_start_date.date_format' => 'The "Special Price From" field format should be YYYY-MM-DD',
            'special_end_date.date_format' => 'The "Special Price End" field format should be YYYY-MM-DD',
            'special_end_date.after_or_equal' => 'The "Special Price End" field should be a date equal or after "Special Price From"',
        ];
        $validatedData = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'sku' => 'required',
            'category_id' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'size_type' => 'required',
            'new_start_date' => 'nullable|date_format:Y-m-d',
            'new_end_date' => 'nullable|date_format:Y-m-d|after_or_equal:new_start_date',
            'special_start_date' => 'nullable|date_format:Y-m-d',
            'special_end_date' => 'nullable|date_format:Y-m-d|after_or_equal:special_start_date',
        ], $messages);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()], 400);
        } else {
            $products = Product::findOrFail($id);
            $products->on_sale = $request->on_sale;
            $products->title = $request->title;
            $products->sku = $request->sku;
            $products->price = $request->price;
            $products->sale_price = $request->sale_price;
//            $products->category_id = $request->category_id;
            $products->size_variation = $request->size_type;
            $products->status = $request->status;
            $products->video = $request->video;
            $products->featured = $request->featured;
            $products->short_description = $request->short_description;
            $products->long_description = $request->long_description;
//            $products->sku = 'px' . rand(1, 9) . rand(1000, 9999);
            $products->new_from = $request->new_start_date;
            $products->new_to = $request->new_end_date;
            $products->special_from = $request->special_start_date;
            $products->special_to = $request->special_end_date;
            $products->save();
                $products->category()->sync($request->category_id);
            if ($request->size_type == 0) {
                $products->stocks()->delete();
                $products->stock_quantity = $request->stock_quantity;
                $products->save();
            } else {
                $products->stock_quantity = 0;
                $products->save();
//                $products->stocks()->delete();
                if (isset($request->size)) {
                    $products->stocks()->delete();
                    $keys = array_keys($request->size);
                    foreach ($keys as $key) {
                        $stock = new Stock();
                        $stock->product_id = $products->id;
                        $stock->size_id = $request->size[$key];
                        $stock->stock = $request->size_stocks[$key];
                        $stock->save();
                        $products->sizes()->sync($request->size[$key]);
                    }
                }
            }

            //tags
            if (isset($request->tags)) {
                $products->tags()->sync($request->tags);
            }

            //seos
            $products->seo()->delete();
            if (isset($request->seo_keyword)) {
                $products->seo()->create([
                    'seo_keyword' => $request['seo_keyword'],
                    'seo_description' => $request['seo_description'],
                ]);
            }

            //insertion to faq database

//        if(isset($request->question)) {
//            $question = $request->faqs['question'];
//            $answer = $request->faqs['answer'];
//            $keys = array_keys($answer);
////        dd($keys);
//            foreach ($keys as $key) {
//                $products->faqs()->create([
//                    'question' => $question[$key],
//                    'answer' => $answer[$key],
//                ]);
//            }
//        }

            //features table ma gayo from product controller
            $products->features()->delete();
            if (isset($request->feature)) {
                foreach ($request->feature as $feature) {
                    $products->features()->create([
                        'title' => $feature,
                    ]);
                }
            }


            //specifications table ma gayo from product controller

            $products->specifications()->delete();
            if (isset($request->spec)) {

                $title = $request->spec['title'];
                $specification = $request->spec['specification'];
                $keys = array_keys($title);
                foreach ($keys as $key) {
                    $products->specifications()->create([
                        'title' => $title[$key],
                        'specification' => $specification[$key],
                    ]);
                }
            }


            //color_product ko pivot table ma attach
//
//            if (isset($request->colors)) {
//                foreach ($request->colors as $color) {
//                    $products->colors()->attach($color);
//                }
//            }
//
//            if (isset($request->sizes)) {
//                foreach ($request->sizes as $size) {
//                    $products->sizes()->attach($size);
//                }
//            }
//        return redirect()->back()->with('success','Product Added Successfully');

            Session::flash('success', 'Product Edited Successfully');
            return response()->json(['success' => 'Product Edited Successfully', 'route' => '/admin/all_products'], 200);
        }
    }

}
