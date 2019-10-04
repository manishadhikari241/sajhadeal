<?php

namespace App\Http\Controllers\admin;

use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    //
    public function add_location(){
        return view('admin.shipping_prices.add_shipping');
    }
    public function post_location(Request $request){
//        dd($request);
        $shipping= new Shipping();

        $shipping->status = 0;
        $shipping->shipping_location = $request->name;
        $shipping->shipping_price = $request->shipping_rate;

        $shipping->save();
        return redirect()->back();
    }
    public function shipping_view()
    {
        $shippings = Shipping::all();
        return view('admin.shipping_prices.view_shipping', compact('shippings'));
    }
    public function confirm_shipping($id){
        $shipping = Shipping::findorfail($id);
        if($shipping->status == 0){
            $shipping ->status = '1';
        }
        else{
            $shipping ->status = '0';
        }
        $shipping->save();
        return redirect()->back();
    }
    public function delete_shipping($id){
        $shipping = Shipping::findorfail($id);
        if($shipping->orders->count() > 0){
            Alert::warning('Shipping Location has Orders','It is best to Make it Inactive');
            return redirect()->back()->with('error','Shipping Location has "Orders" associated to it. It is best to Make it Inactive');
        }
        $shipping->delete();
        return redirect()->back()->with('success','Shipping Location deleted with all its associated orders');
    }
    public function edit_shipping($id){
//        dd($id);
        $shipping = Shipping::findorfail($id);
//        dd($shipping);
        return view('admin.shipping_prices.edit_shipping',compact('shipping'));
    }
    public function save_edited_shipping(Request $request, $id){
        $shipping= Shipping::findorfail($id);
        $shipping->status = 0;
        $shipping->shipping_location = $request->name;
        $shipping->shipping_price = $request->shipping_rate;

        $shipping->save();
        return redirect('/admin/view-shipping');
    }
}
