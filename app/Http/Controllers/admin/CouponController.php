<?php

namespace App\Http\Controllers\admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Coupon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $user = Sentinel::getUser();
        return view('admin.setup.add_coupons', compact('user'));
    }

    public function store(Request $request)
    {

        $coupon = new Coupon();

        $coupon->coupon_code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->discount_type = $request->discount_type;
        $coupon->max_amount = $request->max_amount;
        $coupon->max_users = $request->max_users;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->back();

    }
public function view_all()
{
    $coupons=Coupon::all();
    return view('admin.display.all_coupons',compact('coupons'));
}
    public function verify(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
//        dd($coupon);

        if (!$coupon) {
            return ('Invalid Coupon Code');
        }
        session()->put('coupon', [
            'name' => $coupon->coupon_code,

            'discount' => $coupon->discount(\Cart::session(Sentinel::getUser()->id)->getContent()->first()->sub_total),
        ]);
//        dd(\Cart::session(Sentinel::getUser()->id)->getContent()->first()->sub_total);
//        dd(session()->get('coupon')['discount']);

        return redirect()->back();
    }

    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->back();
    }
    public function delete($id)
    {
        $coupon=Coupon::findorFail($id);
        $coupon->delete();
        return redirect()->back();
    }

}