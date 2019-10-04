<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Mail\OrderConfirmMail;
use App\Order_detail;
use App\Product;
use App\Shipping;
use App\Size;
use App\Stock;
use Darryldecode\Cart\Cart;
use App\Address;
use App\Order;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Location;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('user');
    }

    public function cart_checkout()
    {
        if(\Cart::session(Sentinel::getUser()->id)->getContent()->count() == 0){
            return redirect('/');
        }
        $subtotal=CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent());
//        $newtotal=$newsubtotal;
        $locations = Shipping::where('status',1)->get();
        $preset_address = Sentinel::getUser()->address;
        return view('front.checkout_page', compact('subtotal','locations','preset_address'));
    }

    public function save_current_address(Request $request){
        $user = Sentinel::getUser();

        if($user->address == null){
            $address = new Address();
            $address->first_name = $request->fname;
            $address->last_name = $request->lname;

            $address->address = $request->delivery_address;
            $address->phone = $request->phone;
            $address->shipping_id = $request->location_id;
            $address->customer_id = $user->id;
            $address->save();
        }
        else{
            $address = $user->address;
            $address->first_name = $request->fname;
            $address->last_name = $request->lname;
            $address->address = $request->delivery_address;
            $address->phone = $request->phone;
            $address->shipping_id = $request->location_id;
            $address->save();
        }
        return response()->json(['success' => 'address_saved'], 200);
    }


    public function post_check(Request $request){
        $location = Shipping::where('shipping_location',$request->drop_location)->first();
//        dd($request);
//        $coupon=Coupon::where('coupon_code',$request->coupon_name)->first();
//        dd($coupon->title);
        $order = new Order();

        $user = Sentinel::getUser();
        if($request->save_address == 1){
            if ($user->address == null) {
                $address = new Address();

                $address->first_name = $request->fname;
                $address->last_name = $request->lname;

                $address->address = $request->delivery_address;
                $address->phone = $request->phone;
                $address->shipping_id = $location->id;
                $address->customer_id = $user->id;
                $address->save();
            }
            else{
                $address = $user->address;
                $address->first_name = $request->fname;
                $address->last_name = $request->lname;
                $address->address = $request->delivery_address;
                $address->phone = $request->phone;
                $address->shipping_id = $location->id;
                $address->save();
            }
        }
        $order->customer_id = $user->id;
        $order->order_track = 'OT'.$user->id.'-'.time();
        $order->order_date = date('Y-m-d');
        if(isset($request->discount)) {
//            $order->coupon_id = Coupon::where('coupon_code',$request->coupon_name)->first()->title;
            $order->discount = $request->discount;
        }
        $order->subtotal = $request->subtotal;

        //total before tax
//        $subtotal_before_tax = CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent());

        $order->shipping_id = $location->id;
        $order->final_total = $request->subtotal + $location->shipping_price;
        $order->status = 1 ;
        $order->paid = 0 ;

        $order->first_name = $request->fname;
        $order->last_name = $request->lname;
        $order->address = $request->delivery_address;
        $order->phone = $request->phone;
        $order->shipping_id = $location->id;
        // dd($order);
        $order->save();

        foreach (\Cart::session(Sentinel::getUser()->id)->getContent() as $product){
            $detail = new Order_detail();
            $detail->order_id = $order->id;
            $detail->product_id = $product->id;
            $detail->price = $product->price;
            $detail->quantity = $product->quantity;
            $detail->size = $product->attributes['size'];
            $detail->total = $product->price*$product->quantity ;
            $detail->save();
        }
        foreach ($order->order_details as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            if($product->size_variation == 0){
                $product->stock_quantity = $product->stock_quantity - $orderDetail->quantity;
                $product->save();
            }
            else{
                $size = Size::where('title',$orderDetail->size)->first();
                $stock = Stock::where('product_id',$product->id)->where('size_id',$size->id)->first();
                $stock->stock = $stock->stock -1;
                $stock->save();
            }
        }

        //sending email
        $user = Sentinel::getUser();
        $data = ['email' => $user->email, 'order' => $order];
        Mail::to($user->email)->send(new OrderConfirmMail($data));
//        $this->send Email($user, $activation->code);

        \Cart::session(Sentinel::getUser()->id)->clear();
        session()->forget('coupon');
        return response()->json(['track_code' => $order->order_track], 200);
    }

    public function code_display(){
        if(session('track_code')){
//            \Cart::session(Sentinel::getUser()->id)->clear();
            return view('front.confirmation');
        }
        else{
            return redirect('/');
        }
    }


    //-----------------old Un-used----------------------------------

//    public function index(Request $request)
//    {
////        $contents=\Cart::session(Sentinel::getUser()->id)->getContent();
////        dd($contents);
//
//
//        $ordertotal = $request->order_total;
//        $subtotal = $request->subtotal;
//        $shipping_price = $request->shipping_price;
//        $location = Location::where('shipping_location',$request->drop_location);
//        dd($location);
//
//        $order = new Order();
//        $address = new Address();
//
//        $products = Product::all();
//
//        $address->customer_id = Sentinel::getUser()->id;
//        $address->country = "Nepal";
//        $address->mobile=$request->mobile;
//        $address->address = $request->address;
//        $address->save();
//
//        if ($request->delivery_method == 'economy') {
//            $shipping_cost = 50;
//            $days = 3;
//            $order->shipping_date = Date('Y-m-d', strtotime("+" . $days . "days"));
//
//        }
//
//        if ($request->delivery_method == 'premium') {
//            $shipping_cost = 100;
//            $days = 1;
//            $order->shipping_date = Date('Y-m-d', strtotime("+" . $days . "days"));
//        }
//
//        $total = $newsubtotal + $newtax + $shipping_cost;
//        $delivery_method = $request->delivery_method;
//
//        $order->customer_id = Sentinel::getUser()->id;
//        $order->full_name = $request->full_name;
//        $order->address_id = $address->id;
//        $order->order_track = 'ot' . rand(0, 9) . rand(10, 999);
//        $order->order_date = date('Y-m-d');
//
//        $order->total_price = $total;
//        $order->sales_tax = $newtax;
//        $order->paid = 0;
//        $order->delivered = 0;
//        $order->status = 1;
//        $order->save();
//
//        foreach (\Cart::session(Sentinel::getUser()->id)->getContent() as $product) {
//            //  dd(\Cart::session(Sentinel::getUser()->id)->getContent());
//
//            $details = new Order_detail();
//            $details->order_id = $order->id;
//            $details->product_id = $product->id;
//            $details->price = $product->price;
//            $details->quantity = $product->quantity;
//            $details->total = $product->price*$product->quantity;
//            $details->size = $product->attributes['size'];
//            $details->color = $product->attributes['color'];
//            $details->save();
//
//
//        }
//        (\Cart::session(Sentinel::getUser()->id)->clear());
//
//
//        return view('product.order_placed', compact('address',
//            'order',
//            'shipping_cost',
//            'total',
//            'delivery_method',
//            'newsubtotal',
//            'newtotal',
//            'products'
//        ));
//
//
//    }
    //    public function check(Request $request)
//    {
////        dd(session()->get('coupon')['name']);
//        $newsubtotal = $request->newsubtotal;
//        $newtotal = $request->newtotal;
//
//
////dd($shipping_cost);
//
//
//        return view('product.checkout', compact('newsubtotal', 'newtotal'));
//    }

}







