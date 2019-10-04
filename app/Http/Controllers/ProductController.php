<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Category;
use App\Order;
use App\Product;
use App\Color;
use App\Size;
use App\Helper\PaginationHelper;
use App\Review;
use App\Image;
use App\Specification;
use App\Tag;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class ProductController extends Controller
{
    use PaginationHelper;

    public function master()
    {
        return view('front.index');
    }

    public function lists()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::all();
        return view('product.product_list', compact('products', 'sizes', 'colors'));
    }

    public function single_product($id)
    {
        $product = Product::where('slug', $id)->first();
//        dd($product);
        $product->views = $product->views + 1;
        $product->save();
        $reviews = Review::where('product_id', $id)->get();
        $counts = 0;
        $sum_review = 0;
        foreach ($reviews as $review) {
            $sum_review = $sum_review + $review->star;
            $counts = $counts + 1;

        }

        if ($counts != 0) {
            $star = $sum_review / $counts;
            $star = round($star);
        } else {
            $star = 5;
            $counts = 0;
        }

        return view('front.singlepage', compact('product', 'reviews', 'star', 'counts'));

    }


    public function profile()
    {
        $user = Sentinel::getUser();
        return view('front.account.profile', compact('user'));
    }

    public function order()
    {
        $user = Sentinel::getUser();
        $orders = Order::where('customer_id', $user->id)->get();
        return view('front.account.order', compact('orders'));
    }

    public function dashboard()
    {
        return view('front.account.dashboard');
    }

    public function index($id, Request $request)
    {

        if ($request->ajax()) {

            if ($request->has('maxprice') || $request->has('size') || $request->has('minprice') || $request->has('sort')) {

//                dd($request->size);
                $categor = Category::where('slug', $id)->first();
                $children = Category::where('parent_id', $categor->id)->get();

                if ($children->first() != Null) {
                    foreach ($children as $child) {
                        if ($child->first() != Null) {
                            foreach ($child->children as $grandChild) {
                                $cat_id[] = $grandChild->id;
                            }


                        }

                        $cat_id[] = $child->id;


                    }
                    $query = Product::join('category_product', 'category_product.product_id', '=', 'products.id')
                        ->whereIn('category_product.category_id', $cat_id);
                } else {
                    $query = Product::where('status', 1)
                        ->join('category_product', 'category_product.product_id', '=', 'products.id')
                        ->where('category_product.category_id', $categor->id);
                                   }

                if ($request->has('brand')) {
                    $query->join('brands', 'brands.id', '=', 'products.brand_id');
                    $query->whereIn('brands.slug', $request->brand);
                }
                if ($request->has('size')) {
                    $sizes = DB::table('product_size')->where('size_id', $request->size)->pluck('product_id')->all();
                    $query->whereIn('products.id', $sizes);
                }

                if ($request->has('minprice') && $request->has('maxprice')) {
                    $min = $request->minprice;
                    $max = $request->maxprice;
                    if (isset($min) && isset($max)) {
                        $query->whereBetween('products.price', [$request->minprice, $request->maxprice]);
                    }
                }

                if ($request->has('sort')) {
                    $sortBy = $request->sort;

                    if (isset($sortBy)) {
                        if ($sortBy == 'popular') {
                            $query->orderBy('id', 'DESC');
                        }
                        if ($sortBy == 'new') {
                            $query->orderBy('created_at', 'DESC');
                        }
                        if ($sortBy == 'old') {
                            $query->orderBy('created_at', 'ASC');
                        }
                        if ($sortBy == 'a-z') {
                            $query->orderBy('title', 'ASC');
                        }
                        if ($sortBy == 'z-a') {
                            $query->orderBy('title', 'DESC');
                        }
                        if ($sortBy == 'high-low') {
                            $query->orderBy('sale_price', 'DESC');
                        }
                        if ($sortBy == 'low-high') {
                            $query->orderBy('sale_price', 'ASC');
                        }
                    }
                }
                $products = $query->select('products.*')
                    ->where('products.status', '=', 1)
                    ->distinct()
                    ->get();


                return view('front.bycat', compact('products'));
            }

        }

        if (isset($id)) {
            if ($category = Category::where('slug', $id)->first()) {
//              dd($category);
                $children = Category::where('parent_id', $category->id)->get();

                if ($children->first() != Null) {
                    foreach ($children as $child) {
                        if ($child->first() != Null) {
                            foreach ($child->children as $grandChild) {
                                $cat_id[] = $grandChild->id;
                            }


                        }

                        $cat_id[] = $child->id;

                    }
                    $query = Product::join('category_product', 'category_product.product_id', '=', 'products.id')
                        ->whereIn('category_product.category_id', $cat_id);
                    $products = $query->select('products.*')
                        ->where('products.status', '=', 1)
                        ->distinct()
                        ->get();
//                    dd($products);

                } else {
                    $products = Product::where('status', 1)
                        ->join('category_product', 'category_product.product_id', '=', 'products.id')
                        ->where('category_product.category_id', $category->id)
                        ->select('products.*')
                        ->get();

                }
                $category_title = $category->title;
            } elseif ($id == 'new_arrival') {
                $products = Product::

                where('status', 1)
                    ->where('new_to', '>=', date('Y-m-d'))
                    ->get();
                $category_title = "New Arrival";
            } elseif ($id == 'sale') {
                $products = Product::
                where('status', 1)
                    ->where('sale_price', '!=', null)
                    ->where('special_to', '>=', date('Y-m-d'))
                    ->get();
                $category_title = "Special Price";
            } elseif ($id == 'most_viewed') {
                $products = Product::orderBy('views', 'desc')->get();
//                dd($products);
                $category_title = "Most Viewed";
            } elseif ($id == 'best_seller') {
                $products = Product::orderBy('views', 'desc')->get();
//                dd($products);
                $category_title = "Best Seller";
            }


        } else {
            $products = Product::where('status', 1)->get();
            $category_title = "All Products";
        }

        $category_id = $id;
        $products = $this->paginateHelper($products, 16);

        if (!isset($category)) {
            $cat = '';
        }
        $cat = $category;
//        dd($cat);

        return view('front.categories', compact('products', 'category_id', 'category_title', 'cat'));
    }

    public function search(Request $request)
    {
        // $terms = explode(' ',request('query'));
        $terms = request('query');

        if ($request->ajax()) {

            if ($request->has('maxprice') || $request->has('size') || $request->has('minprice') || $request->has('sort')) {

//
                $query = Product::where(function ($q) use ($terms) {
                    foreach ($terms as $term) {
                        $q->orWhere('title', 'like', '%' . $term . '%');
                        $q->orWhere('sku', 'like', '%' . $term . '%');
                    }
                })->get();

                if ($request->has('brand')) {
                    $query->join('brands', 'brands.id', '=', 'products.brand_id');
                    $query->whereIn('brands.slug', $request->brand);
                }
                if ($request->has('size')) {
                    $sizes = DB::table('product_size')->where('size_id', $request->size)->pluck('product_id')->all();
                    $query->whereIn('products.id', $sizes);
                }

                if ($request->has('minprice') && $request->has('maxprice')) {
                    $min = $request->minprice;
                    $max = $request->maxprice;
                    if (isset($min) && isset($max)) {
                        $query->whereBetween('products.price', [$request->minprice, $request->maxprice]);
                    }
                }

                if ($request->has('sort')) {
                    $sortBy = $request->sort;

                    if (isset($sortBy)) {
                        if ($sortBy == 'popular') {
                            $query->orderBy('id', 'DESC');
                        }
                        if ($sortBy == 'new') {
                            $query->orderBy('created_at', 'DESC');
                        }
                        if ($sortBy == 'old') {
                            $query->orderBy('created_at', 'ASC');
                        }
                        if ($sortBy == 'a-z') {
                            $query->orderBy('title', 'ASC');
                        }
                        if ($sortBy == 'z-a') {
                            $query->orderBy('title', 'DESC');
                        }
                        if ($sortBy == 'high-low') {
                            $query->orderBy('sale_price', 'DESC');
                        }
                        if ($sortBy == 'low-high') {
                            $query->orderBy('sale_price', 'ASC');
                        }
                    }
                }
                $products = $query->select('products.*')
                    ->where('products.status', '=', 1)
                    ->get();


                return view('front.bycat', compact('products'));
            }


        } else {
            // $products = Product::where('status',1)->where( function ($q) use ($terms) {
            //     foreach ($terms as $term){
            //         $q->orWhere('title',  $term);
            //         $q->orWhere('sku', 'like', '%' . $term . '%');

            //     }
            // })->get();
            $products = Product::where('status', 1)->where('title', $terms)->orWhere('sku', 'like', '%' . $terms . '%')->get();
            if ($products->isEmpty()) {
                $terms = explode(' ', request('query'));
                $products = Product::where('status', 1)->where(function ($q) use ($terms) {
                    foreach ($terms as $term) {
                        $q->orWhere('title', 'like', '%' . $term . '%');
                        $q->orWhere('sku', 'like', '%' . $term . '%');

                    }
                })->get();
            }
        }
//        if(isset($id)) {
//            if($category=Category::find($id)) {
////              dd($category);
//                $children = Category::where('parent_id', $id)->get();
//
//                if ($children->first() != Null) {
//                    foreach ($children as $child) {
//                        if ($child->first() != Null) {
//                            foreach ($child->children as $grandChild) {
//                                $cat_id[] = $grandChild->id;
//                            }
//
//
//                        }
//
//                        $cat_id[] = $child->id;
//
//
//                    }
//                    $query = Product::whereIn('category_id', $cat_id);
//                    $products = $query->select('products.*')
//                        ->where('products.status', '=', 1)
//                        ->get();
//                } else {
//                    $products = $category->products;
//                }
//            }
//            elseif($id == 'new_arrival'){
//                $products = Product::
//
//                where('status',1)
//                    ->where('new_to','>=',date('Y-m-d'))
//                    ->get();
//            }
//            elseif ($id =='sale'){
//                $products = Product::
//                where('status',1)
//                    ->where('sale_price','!=',null)
//                    ->where('special_to','>=',date('Y-m-d'))
//                    ->get();
//            }
//            elseif ($id =='most_viewed'){
//                $products = Product::orderBy('views','desc')->get();
////                dd($products);
//            }
//            elseif ($id =='best_seller'){
//                $products = Product::orderBy('views','desc')->get();
////                dd($products);
//            }
//
//
//
//        }
//        else{
//            $products = Product::all();
//        }
////       $products = Product::where( 'category_id', $id )->get();
//
//        $category_id=$id;
// dd(Request::all());
        $products = $this->paginateHelper($products, 16);
        $products->appends(\Request::all())->links();
        $category_title = "Search Result";

        return view('front.categories', compact('products', 'category_title'));
    }

    public function slug_filter(Request $request, $slug)
    {


        if ($request->ajax()) {

            if ($request->has('maxprice') || $request->has('size') || $request->has('minprice') || $request->has('sort')) {
                if ($slug == 'new_arrival') {
                    $query = Product::
                    where('status', 1)
                        ->where('new_to', '>=', date('Y-m-d'));
                    $category_title = "New Arrival";

                } elseif ($slug == 'sale') {
                    $query = Product::
                    where('status', 1)
                        ->where('sale_price', '!=', null)
                        ->where('on_sale', '=', 1);
                    $category_title = "Special Price";

                } elseif ($slug == 'featured') {
                    $query = Product::where('featured', 1)
                        ->where('status', 1);
                    $category_title = "Featured";
                } elseif ($slug == 'most_viewed') {
                    $query = Product::where('status', 1);
                    $category_title = "Most Viewed";
//
                }

                if ($request->has('brand')) {
                    $query->join('brands', 'brands.id', '=', 'products.brand_id');
                    $query->whereIn('brands.slug', $request->brand);
                }
                if ($request->has('size')) {
                    $sizes = DB::table('product_size')->where('size_id', $request->size)->pluck('product_id')->all();
                    $query->whereIn('products.id', $sizes);
                }

                if ($request->has('minprice') && $request->has('maxprice')) {
                    $min = $request->minprice;
                    $max = $request->maxprice;
                    if (isset($min) && isset($max)) {
                        $query->whereBetween('products.price', [$request->minprice, $request->maxprice]);
                    }
                }

                if ($request->has('sort')) {
                    $sortBy = $request->sort;

                    if (isset($sortBy)) {
                        if ($sortBy == 'popular') {
                            $query->orderBy('id', 'DESC');
                        }
                        if ($sortBy == 'new') {
                            $query->orderBy('created_at', 'DESC');
                        }
                        if ($sortBy == 'old') {
                            $query->orderBy('created_at', 'ASC');
                        }
                        if ($sortBy == 'a-z') {
                            $query->orderBy('title', 'ASC');
                        }
                        if ($sortBy == 'z-a') {
                            $query->orderBy('title', 'DESC');
                        }
                        if ($sortBy == 'high-low') {
                            $query->orderBy('sale_price', 'DESC');
                        }
                        if ($sortBy == 'low-high') {
                            $query->orderBy('sale_price', 'ASC');
                        }
                    }
                }
                $products = $query->select('products.*')
                    ->where('products.status', '=', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();


                return view('front.bycat', compact('products', 'category_title'));
            }


        } else {
            if ($slug == 'new_arrival') {
                $products = Product::
                where('status', 1)
                    ->where('new_to', '>=', date('Y-m-d'))
                    ->orderBy('created_at', 'desc')
                    ->get();
                $category_title = "New Arrival";
            } elseif ($slug == 'sale') {
                $products = Product::
                where('status', 1)
                    ->where('sale_price', '!=', null)
                    ->where('on_sale', '=', 1)
                    ->get();

                $category_title = "Special Price";
            } elseif ($slug == 'most_viewed') {
                $products = Product::
                where('status', 1)->
                orderBy('views', 'desc')->get();
//                dd($products);
                $category_title = "Most Viewed";
            } elseif ($slug == 'featured') {
                $products = Product::where('featured', 1)
                    ->where('status', 1)->get();
                $category_title = "Featured";
            }
        }
//
        $products = $this->paginateHelper($products, 16);

        return view('front.categories', compact('products', 'category_title'));
    }

}