<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\Size;
use App\Product;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function view()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        foreach ($orders as $order) {
            if ($order->status == 1) {
                if ($order->delivered == 0) {
                    $order->status_text = "Pending";
                } elseif ($order->delivered == 1) {
                    $order->status_text = "Delivered";
                }
            } else {
                $order->status_text = "Cancelled";
            }
        }
        return view('admin.order.orders', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
            $pid = DB::table('order_details')->where('order_id',$id)->get();
            foreach($pid as $pi){
                $product = Product::where('id',$pi->product_id)->first();
                if($product->size_variation == 0) {
                    $product->stock_quantity = (int)($product->stock_quantity) + (int)($pi->quantity);
                    $product->update();
                }
                elseif($product->size_variation == 1)
                {
                    if($pi->size != null){
                        $size = Size::where('title',$pi->size)->first();
                        $stock = Stock::where('product_id',$product->id)->where('size_id',$size->id)->first();
                        $stock->stock = (int)($stock->stock) + (int)($pi->quantity);
                        $stock->update();
                    }
                }
            }
        
        $order->status=0;
        $order->update();
        return redirect()->back();
    }
    public function cancel_to_pending($id){
        $order = Order::findOrFail($id);
            $pid = DB::table('order_details')->where('order_id',$id)->get();
            foreach($pid as $pi){
                $product = Product::where('id',$pi->product_id)->first();
                if($product->size_variation == 0) {
                    $product->stock_quantity = (int)($product->stock_quantity) - (int)($pi->quantity);
                    $product->update();
                }
                elseif($product->size_variation == 1)
                {
                    if($pi->size != null){
                        $size = Size::where('title',$pi->size)->first();
                        $stock = Stock::where('product_id',$product->id)->where('size_id',$size->id)->first();
                        $stock->stock = (int)($stock->stock) - (int)($pi->quantity);
                        $stock->update();
                    }
                }
            }
        $order->status=1;
        $order->update();
        return redirect()->back();
    }

    public function change_status(Request $request, $id){
//        dd($request);
        $order=Order::findOrFail($id);
        $order->paid = $request->paid;
        $order->delivered = $request->delivered;
        $order->save();
        return redirect()->back();
    }


    public function sort_year(Request $request){
        $orders = Order::where('created_at','==',$request->year)->get();
        foreach ($orders as $order) {
            if ($order->status == 1) {
                if ($order->delivered == 0) {
                    $order->status_text = "Pending";
                } elseif ($order->delivered == 1) {
                    $order->status_text = "Delivered";
                }
            } else {
                $order->status_text = "Cancelled";
            }
        }
        return response()->json(['redirect' =>'/admin/orders/view',compact('orders')]);
    }
    
    public function delivered(){
        $orders = Order::orderBy('created_at','desc')->where('delivered','1')->where('status',1)->get();
        return view('admin.order.order_delivered',compact('orders'));
    }
    public function pending(){
        $orders = Order::orderBy('created_at','desc')->where('delivered','0')->where('status',1)->get();
        return view('admin.order.order_pending',compact('orders'));
    }
    public function cancelled(){
        $orders = Order::orderBy('created_at','desc')->where('status','0')->get();
        return view('admin.order.order_cancel',compact('orders'));
        
    }
}
