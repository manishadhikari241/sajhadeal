<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Shipping;
use App\User;
use App\Order;
use App\Wishlist;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index(){
        $user = Sentinel::getUser();
//        dd($user);
        $orders = Order::where('customer_id',$user->id)->orderBy('created_at','desc')->get();
        // dd($orders);
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
        $user=Sentinel::getUser();
        $wishlists=Wishlist::where('user_id',$user->id)->get();
        $locations = Shipping::all();
        $address = $user->address()->first();
        $admin=Admin::where('user_id',$user->id)->first();

//        dd($address);
        return view('front.user_account.account',compact('user','orders','admin','wishlists','locations','address'));
    }
    
    public function change_adddress(Request $request){
        $user = Sentinel::getUser();
//        dd($request);

        if($user->address == null){
            $address = new Address();
            $address->first_name = $request->fname;
            $address->last_name = $request->lname;

            $address->address = $request->delivery_address;
            $address->phone = $request->phone;
            $address->shipping_id = $request->location;
            $address->customer_id = $user->id;
            $address->save();
        }
        else{
            $address = $user->address;
            $address->first_name = $request->fname;
            $address->last_name = $request->lname;
            $address->address = $request->delivery_address;
            $address->phone = $request->phone;
            $address->shipping_id = $request->location;
            $address->save();
        }
        return redirect()->back()->with('success','Address Saved');
    }

    public function change_pswd(Request $request)
    {
        $messages = [
            'old_password.required' => 'Please Enter Old Password',
            'new_password.required' => 'Please Enter New Password',
            'confirm_password.required' => 'Please Enter The New Password Again',
            ];

        $validatedData = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required',
        ], $messages);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()], 400);
        } elseif(!(Hash::check($request['old_password'], Sentinel::getUser()->password))) {
            return response()->json(['errors' => 'Your Old Password does not Match'], 400);
        }
        else{
            $user = Sentinel::getUser();
            $user->password = bcrypt($request->new_password);
            $user->save();
        }
        Session::flash('success','Password Changed Successfully');
        return response()->json(['success' => 'Password changed','route' => '/user/info'],200);
    }
public function user( Request $request)
{
    $user=Sentinel::getUser();
if (!$user->admin) {
    $admin = new Admin();
    $admin->user_id = $user->id;
    $admin->first_name = $request->first_name;
    $admin->last_name = $request->last_name;
    $admin->mobile = $request->mobile;
    $admin->dob = $request->dob;
    $admin->gender = $request->gender;
    $admin->save();
}
else{
    $admin=$user->admin;

    $admin->first_name = $request->first_name;
    $admin->last_name = $request->last_name;
    $admin->mobile = $request->mobile;
    $admin->dob = $request->dob;
    $admin->gender = $request->gender;
    $admin->save();
}

    return redirect()->back();
}
    
}
