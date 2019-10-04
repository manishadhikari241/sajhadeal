<?php

namespace App\Http\Controllers\front;

use App\Product;
use App\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialController extends Controller
{
    public function by_price($id){
        $special = Special::findOrFail($id);
//        dd($special);
        $price = $special->special_price;
        $products = Product::where('price','<',$price)->get();
        return view('front.categories',compact('products'));
    }
}
