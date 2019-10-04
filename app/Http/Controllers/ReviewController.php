<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function review(Request $request)
    {
//        dd($request);
        $user=Sentinel::getUser();
        $review= new Review();
        $review->product_id=$request->product_id;
        $review->user_id=$user->id;
        $review->name = $request->name;
        $review->star=$request->rating;
        $review->review=$request->review;
        $review->save();
        return redirect()->back();
    }
}
