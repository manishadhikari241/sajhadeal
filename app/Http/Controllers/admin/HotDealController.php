<?php

namespace App\Http\Controllers\admin;

use App\Hotdeal;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotDealController extends Controller
{
    public function update_deal(Request $request)
    {
        if ($request->isMethod('get')) {
            $products = Product::where('hot_deal', '=', 1)->get();

            return view('admin.setup.hotdeals', compact('products'));
        }
        if ($request->isMethod('post')){
            $request->validate([
                'date'=>'required'
            ]);
            $date = $request->date;
            $realdate = str_replace('T', ' ', $date);

            $input = $request->only('date');
            foreach ($input as $key => $value) {
                $update = Hotdeal::updateorcreate(['configuration_key' => $key], ['configuration_value' => $realdate]);
            }

            if ($update) {
                return redirect()->back()->with('success', 'Hot Deals Date Time Updated');
            }
        }
        return false;
    }
}
