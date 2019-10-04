<?php

namespace App\Http\Controllers;
use App\Advertisement;

use App\Order;
use App\Product;
use App\Contact;
use App\Background;
use App\Review;
use App\Seo;
use App\Special;
use App\SpecialCategory;
use App\Subscriber;
use App\User;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;
use App\Helper\PaginationHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    use PaginationHelper;
    public function index()
    {
        $backgrounds = Background::all();
        $slideshows1=Background::where('background',3)->get();
        $slideshows2=Background::where('background',3)->get();
        $slideshows3=Background::where('background',3)->get();

        $latests = Product::where('new_to','>=',date('Y-m-d'))->where('status',1)->orderBy('created_at','desc')->get()->take(5);
        // if($latests->count()==0);
        // {
        //     $latests= Product::orderBy('created_at','desc')->get()->take(5);
        // }
        $specials = Product::where('status',1)->where('sale_price','!=',null)->where('special_to','>=',date('Y-m-d'))->get()->take(6);
        $special_by_category = SpecialCategory::where('status',1)->take(4)->get();
        $most_viewed = Product::where('status',1)->orderBy('views','desc')->take(6)->get();
        $featured = Product::where('status',1)->where('featured',1)->take(6)->get();

//        $most_seller_products = Product::leftJoin('order_details', 'product_id', '=', 'products.id')
//            ->select(, DB::raw("count('products.id') as sales_count"))
//            ->groupBy('products.id')
//            ->orderBy('sales_count', 'desc')
//        ->get();
//        $ids = DB::table('order_details')->pluck('product_id')->all();
//        $counts = array_count_values($ids);
//        $products = Product::all();
//        foreach ($products as $product){
//            $product->repition = $counts[$product->id];
//        }
//        dd($products);

   $advertisement= Advertisement::where('image_name','=','advertisement_image')->first();
        return view('front.index', compact('backgrounds','specials','latests','special_by_category','most_viewed','featured','advertisement'));
    }

    public function result(Request $request)
    {
//        dd($request);
//        $query = $request->input('query');
        $terms = explode(' ',request('query'));
//        dd($terms);

//        foreach($terms as $term){
//           $products = Package::where('keyword','like','%'.$term.'%')->get();
//        }
//        dd($products);

//        $q= $request->input('description');


        $seos = Seo::where(function ($q) use ($terms) {
            foreach ($terms as $term){
                $q->orWhere('seo_keyword', 'like', '%' . $term . '%');
            }
        })
            ->orWhere(function ($q) use ($terms){
                foreach ($terms as $term){
                    $q->orWhere('seo_description', 'like', '%' . $term . '%');
                }

            })->get();
dd($seos);
//        $products = $seos->product;
//        dd($seos);
        return view('front.search-result', compact('seos'));
    }

    public function shop($id){
        $products = Product::where('category_id',$id)->get();
        return view('front.categories',compact('products'));
    }

    public function about(){
        return view('front.about');
    }

    public function contact(){
        return view('front.contact');
    }
    public function contact_post(Request $request){
        $contact=new Contact;
        $contact->name=$request->name;
        $contact->message=$request->message;
        $contact->email=$request->email;
        $contact->status =0 ;
        $contact->save();
        return redirect()->back();
    }
    public function login(){
        return view('front.login');
    }
    public function login_post(Request $request){
        dd($request);
        return view('front.login');
    }
    public function register(){
        return view('front.register');
    }
    public function register_save(Request $request){
//        dd($request);
        return view('front.register');
    }

    public function new_arrival(){
        $now = date('Y-m-d');
//        dd($now);
        $products = Product::where('new_to','>=',$now)->get();
        $products = $this->paginateHelper( $products, 8 );
        return view('front.categories',compact('products'));
    }

    public function sale(){
        $now = date('Y-m-d');
//        dd($now);
        $products = Product::where('sale_price','!=',null)->where('special_to','>=',$now)->get();
        $products = $this->paginateHelper( $products, 8 );
        return view('front.categories',compact('products'));
    }

    public function order_track(){
        return view('front.order_track');
    }
    public function post_order_track(Request $request){
//        dd($request);
        if($order=Order::where('order_track',$request->code)->first()) {
            if ($order->status == 1) {
                if ($order->delivered == 0) {
                    $order->status_text = "Waiting";
                    $order->status_color = "primary";
                } elseif ($order->delivered == 1) {
                    $order->status_text = "Delivered";
                    $order->status_color = "success";
                }
            } else {
                $order->status_text = "Cancelled";
                $order->status_color = "danger";
            }
            Session::flash('order',$order);
            return redirect()->back()->with(compact('order'));
        }
        else{
            return redirect()->back()->with('error','No Order Found.');
        }
    }

    public function terms(){
        return view('front.terms');
    }
    public function policies(){
        return view('front.policies');
    }

    public function postSubscriber(Request $request){

        $subscriber=new Subscriber();
        $subscriber->subscriber=$request->email;
        $subscriber->save();

        return redirect()->back();
    }

}
