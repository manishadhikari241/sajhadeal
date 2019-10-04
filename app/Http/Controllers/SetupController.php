<?php

namespace App\Http\Controllers;

use App\Background;
use App\Contact;
use App\Message;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Review;
use App\Subscriber;
use App\User;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function contacts()
    {
        $contacts = Contact::all();
        return view('admin.setup.contact', compact('contacts'));
    }

    public function delete_contact($id)
    {
        $contact = Contact::findorfail($id);

//        dd(public_path()."/".$blog->blog_image);
//        \File::delete(public_path()."/".$blog->blog_image);

        $contact->delete();

        return redirect()->back();
    }

    public function confirm_contact($id)
    {
        $contact = Contact::findorfail($id);
        if ($contact->status == 0) {
            $contact->status = '1';
        } else {
            $contact->status = '0';
        }
        $contact->save();
        return redirect()->back();
    }

    public function dashboard()
    {
        $contact = Contact::all();
        $users=User::all();
        $orders= Order::orderBy('created_at','desc')->get()->take(10);
        $products=Product::all();
        $order_details=Order_detail::orderBy('created_at', 'desc')->get();
        $reviews=Review::orderBy('created_at', 'desc')->get();
        $message_count = Contact::where('status', '=', '0')->count();
        $datas=Order::all()->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->order_date)->format('d-M-y');
        });
        foreach ($datas as $data)
        {
            $total=0;
            foreach ($data as $sale)
            {
                $total=$total+$sale->final_total;
                $month=\Carbon\Carbon::parse($sale->order_date)->format('M');

            }
            $graphs[$month]['mon']=$month;
            $graphs[$month]['tot']=$total;
        }
        $users=User::all()->groupBy(function ($new_user)
        {
            return \Carbon\Carbon::parse($new_user->created_at)->format('d-M-y');

        });
        foreach ($users as $user)
        {
            $total=0;
            foreach ($user as $customer)
            {
                $total=$total+$customer->count();
                $month=\Carbon\Carbon::parse($customer->created_at)->format('M');

            }
            $user_graphs[$month]['mon']=$month;
            $user_graphs[$month]['tot']=$total;
        }

        return view('admin.setup.dashboard', compact('contact', 'message_count','user_graphs','graphs','users','orders','products','order_details','reviews'));
    }

    public function background()
    {
        $backgrounds = Background::where('background', '=', '1')->get();
        $backgrounds1 = Background::where('background', '=', '2')->get();
//        dd($backgrounds1);
        $backgrounds2 = Background::where('background', '=', '3')->get();
        return view('admin.setup.background', compact('backgrounds', 'backgrounds1', 'backgrounds2'));
    }

    public function add_background()
    {
        $slide = Background::where('background', '=', '1')->count();
        $arrival = Background::where('background', '=', '2')->count();
        $special = Background::where('background', '=', '5')->count();
//        dd($slide);
        return view('admin.setup.add-background', compact('slide', 'arrival', 'special'));
    }

    public function save_background(Request $request)
    {
//        dd($request)
        $background = new Background;
        $background->title = $request->title;
        $background->status = 0;
        $background->background = $request->slideshow;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/admin/images/', $filename);
            $background->logo = "/admin/images/" . $filename;
        };
        $background->save();
        return redirect()->back();

    }

    public function confirm_background($id)
    {
        $background = Background::findorfail($id);
        if ($background->status == 0) {
            $background->status = '1';
        } else {
            $background->status = '0';
        }
        $background->save();
        return redirect()->back();
    }

    public function link_confirm(Request $request, $id)
    {
//        dd($request);
        $background = Background::findorfail($id);
//        dd($background);
        $background->link = $request->link;
        $background->save();
        return redirect()->back();
    }
    public function link_remove($id){
        $background = Background::findorfail($id);
        $background->link = "";
        $background->save();
        return redirect()->back();
    }
    public function edit_background($id){
        $background = Background::findorfail($id);
        return view('admin.setup.edit-background',compact('background'));
    }
    public function post_edit_background(Request $request,$id){
        $background = Background::findorfail($id);
        $background->title = $request->title;
        $background->status = 0;
        $background->background = $request->slideshow;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/admin/images/', $filename);
            $background->logo = "/admin/images/" . $filename;
        };
        $background->save();
        return redirect('/background');

    }
    public function subscriber(){
        $subscribers=Subscriber::all();
        return view('admin.setup.subscribers',compact('subscribers'));
    }
    public function delete_subscriber($id)
    {
        $subscriber = Subscriber::findorfail($id);

//        dd(public_path()."/".$blog->blog_image);
//        \File::delete(public_path()."/".$blog->blog_image);

        $subscriber->delete();

        return redirect()->back();
    }

}
