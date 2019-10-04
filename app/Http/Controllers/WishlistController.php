<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware('user');
     }
    public function wishlist()
    {
        $user=Sentinel::getUser();
        $wishlists=Wishlist::where('user_id',$user->id)->get();
        return view('front.account.wishlist',compact('wishlists'));
    }

    public function postWishlist($id)
    {
       $user=Sentinel::getUser();
        $wishlist=new Wishlist();
        $old_wishlist = Wishlist::where('product_id',$id)->where('user_id',$user->id)->first();
        if($old_wishlist != null){
            Alert::warning('Failed','Item already present in Wishlist');
            return redirect()->back();
        }
        else {
            $wishlist->product_id = $id;
            $wishlist->user_id = $user->id;
            $wishlist->save();
            Alert::success('Success','Item added to Wishlist');
            return redirect()->back();
        }
    }
    public function deleteWishlist($id)
    {

        $wishlist=Wishlist::findorfail($id);
        $wishlist->delete();
        Alert::success('Success','Item deleted from Wishlist');
        return redirect()->back();
    }

}
