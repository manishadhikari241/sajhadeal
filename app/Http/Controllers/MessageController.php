<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function contact()
    {
        return view('product.contact');
    }
    public function message(Request $request)
    {
        $message=new Message();
        $message->name=$request->name;
        $message->email=$request->email;
        $message->message=$request->message;
//        $message->status = 0;
        $message->save();
        return redirect()->back();
    }
}
