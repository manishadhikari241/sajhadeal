<?php

namespace App\Http\Controllers;

use App\Product;
use App\Size;
use App\Color;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index($id, Request $request)
    {
        // dd($request);
        $user_id = Sentinel::getUser()->id;
        \Cart::session($user_id);
//        \Cart::clear();
        $product = Product::find($id);

        foreach ($product->images as $image) {
            if ($image->is_main == 1) {
                $cart_image = $image->image;
            }
        }
        //check if special price is valid or not
        if($product->valid_special_price() == 1) {
            $cart_price = $product->sale_price;
        }
        else{
            $cart_price = $product->price;
        }
        if(isset($request->radSize)){
            $size=Size::findOrFail($request->radSize)->title;
        }
        else{
            $size = 'Free-Size';
        }

//        adding items in cart

        \Cart::add(array(


            array(
                'id' => $id,
                'name' => $product->title,
                'price' => $cart_price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'size' => $size,
                    'image' => $cart_image,
                )
            ),
        ));
        // dd($request);
        if($request->buy_now == 0){
            Alert::success('Success','Item added to Cart');
            return redirect()->back();
        }
        else{
            return redirect('/cart_checkout');
        }


    }
    public function add_cart($id)
    {

        $user_id = Sentinel::getUser()->id;
        \Cart::session($user_id);
//        \Cart::clear();
        $product = Product::find($id);
        $size='';
            if($product->size_variation == 0 && $product->stock_quantity > 0){
                $size = 'Free-size';
            }
            elseif($product->size_variation == 1){
                $stocks = $product->stocks->where('stock','>','0')->first();
                if(isset($stocks)){
                $size_row = Size::find($stocks->size_id);
                $size = $size_row->title;
                }
            }
            
            if($size == ''){
                Alert::warning('Out Of Stock','Please Try Later');
                return redirect()->back();        
            }

        foreach ($product->images as $image) {
            if ($image->is_main == 1) {
                $cart_image = $image->image;
            }
        }

        //check if special price is valid or not
        if($product->valid_special_price() == 1) {
            $cart_price = $product->sale_price;
        }
        else{
            $cart_price = $product->price;
        }


//        adding items in cart

        \Cart::add(array(


            array(
                'id' => $id,
                'name' => $product->title,
                'price' => $cart_price,
                'quantity' => 1,
                'attributes' => array(
                    'size' => $size,
                    'image' => $cart_image,
                )
            ),
        ));
        Alert::success('Success','Item added to Cart');
        return redirect()->back();

    }

    public function view()
    {
        if(\Cart::session(Sentinel::getUser()->id)->getContent()->count() == 0){
            return redirect('/');
        }

        foreach (\Cart::session(Sentinel::getUser()->id)->getContent() as $product) {
            $product->sub_total = $product->quantity * $product->price;
        }


        $oldsubtotal = \Cart::session(Sentinel::getUser()->id)->getSubTotal();
        $tax = $oldsubtotal * 0.13;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newsubtotal = ($oldsubtotal - $discount);

        $newtotal = $newsubtotal;


//        dd(\Cart::session(Sentinel::getUser()->id)->getContent());
        if (\Cart::session(Sentinel::getUser()->id)->getContent()->first()) {


            return view('front.view_cart')->with([
                'discount' => $discount,
                'newsubtotal' => $newsubtotal,
                'tax' => $tax,

                'newtotal' => $newtotal,

            ]);
        } else {
            return view('front.view_cart')->with([
                'tax' => $tax,

            ]);
        }

    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit_cart', compact('product'));
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function store($id, Request $request)
    {
        $product = Product::find($id);
        foreach ($product->images as $image) {
            if ($image->is_main == 1) {
                $cart_image = $image->image;
            }
        }

//        dd($request);
        $size = Size::find($request->size)->title;
        $color = Color::find($request->color)->title;
        \Cart::session(Sentinel::getUser()->id);

        \Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
            'attributes' => array(
                'size' => $size,
                'color' => $color,
                'image' => $cart_image,
            )));
        return redirect('/view_cart');
    }

    public function remove($id)
    {
//        dd($id);
        \Cart::session(Sentinel::getUser()->id)->remove($id);
        Alert::success('Success','Item removed from Cart');
        return redirect('/view_cart');
    }


    public static function get_subtotal($products){
        $sub_total = 0;
        foreach($products as $product)
        {
            $sub_total += $product->price * $product->quantity;
        }
        return $sub_total;
    }
    public static function get_tax($products){
        $sub_total = self::get_subtotal($products);
        $tax = 0.12* $sub_total;
        return $tax;
    }

    public function post_cart_update(Request $request){
//        dd($request);
        $keys = array_keys($request->update);

        foreach ($keys as $key){
            $product_id = $request->update[$key];
            $product = Product::find($product_id);
            $quantity = $request->quantity[$key];
            \Cart::session(Sentinel::getUser()->id)->update($product_id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity,
                )
                ));
        }
        return response()->json(['success' => 'Cart Updated'],200);
    }


}
