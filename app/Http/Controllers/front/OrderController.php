<?php

namespace App\Http\Controllers\front;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function view(){
        $user = Sentinel::getUser();
//        dd($user);
        $orders = $user->orders;
//        dd($orders);
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
        return view('front.customer_orders',compact('user','orders'));

    }
}
