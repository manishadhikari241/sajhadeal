<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function verify(Request $request, $total)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
//        dd($coupon);

        if (!$coupon) {
            return response()->json(['errors' => 'Invalid Coupon Code'], 400);
        }
        elseif($coupon->check_validity($coupon->id, $total) == 0){
            return response()->json(['errors' => 'Coupon Code Expired'], 400);
        }
        elseif(CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent()) < $coupon->max_amount){
            return response()->json(['errors' => 'Coupon Code not applicable.'], 400);
        }
        $discount = $coupon->discount(CartController::get_subtotal(\Cart::session(Sentinel::getUser()->id)->getContent()));
        session()->put('coupon', [
            'name' => $coupon->coupon_code,

            'discount' => $discount,
        ]);
        $coupon->max_users = $coupon->max_users - 1;
        $coupon->save();
//        dd(\Cart::session(Sentinel::getUser()->id)->getContent()->first()->sub_total);
//        dd(session()->get('coupon')['discount']);

        return response()->json(['success' => 'Coupon Applied'], 200);
    }

    public function destroy()
    {
        $code= session()->get('coupon')['name'];
        $coupon = Coupon::where('coupon_code',$code)->first();
        $coupon->max_users = $coupon->max_users + 1;
        $coupon->save();
        session()->forget('coupon');
        return redirect()->back();
    }

}