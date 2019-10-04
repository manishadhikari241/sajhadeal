<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    //
    public function add_ads(){
        $ad1 = Ad::where('display_area', 1)->get()->first();
        $ad2 = Ad::where('display_area', 2)->get()->first();
        $ad3 = Ad::where('display_area', 3)->get()->first();
        $ad4 = Ad::where('display_area', 4)->get()->first();
        $ad=Ad::all()->count();
//        dd($ad1->image);

        return view('admin.setup.add_ads', compact('ad1', 'ad2', 'ad3', 'ad4','ad'));
    }
    public function post_ads(Request $request){
//        dd($request);
        $one = Ad::where('display_area', 1)->count();
        $two = Ad::where('display_area', 2)->count();
        $three = Ad::where('display_area', 3)->count();
        $four = Ad::where('display_area', 4)->count();

        if ($one == 1 && $request->display_area == 1) {
            return redirect()->back()->with('error', 'HomePage Top-Ad has already exists');
        } elseif ($two == 1 && $request->display_area == 2) {
            return redirect()->back()->with('error', 'HomePage Bottom-Ad has already exists');
        } elseif ($three == 1 && $request->display_area == 3) {
            return redirect()->back()->with('error', 'Categories Top-Ad has already exists');
        } elseif ($four == 1 && $request->display_area == 4) {
            return redirect()->back()->with('error', 'Categories Bottom-Ad has already exists');
        } else {
            $ad = new Ad();
            $ad->name = $request->name;
            $ad->status = 0;
            $ad->link = $request->link;
            $ad->display_area = $request->display_area;
            if ($request->hasFile('image')) {
                $ad_image = $request->file('image');
                $filename = time() . '.' . $ad_image->getClientOriginalExtension();
                $upload_path = "images/ads/";
                $db_filename = $upload_path . $filename;
                $ad_image->move($upload_path, $filename);
                $ad->image = $db_filename;

            }
            $ad->save();
        }
        return redirect()->back();
    }
    public function view_ads(){
        $ads= Ad::all();
        return view('admin.setup.view-ads',compact('ads'));
    }
    public function confirm_ads($id){
        $ad = Ad::findorfail($id);
        if ($ad->status == 0) {
            $ad->status = '1';
        } else {
            $ad->status = '0';
        }
        $ad->save();
        return redirect()->back();
    }
    public function delete_ads($id){
        $ad = Ad::findorfail($id);

//        dd(public_path()."/".$blog->blog_image);
//        \File::delete(public_path()."/".$blog->blog_image);
//        unlink(public_path()."/".$blog->blog_image);
        $filename = $ad->image;
        if (file_exists(public_path() . '/' . $filename)) {
            unlink(public_path() . '/' . $filename);
        }
        $ad->delete();

        return redirect()->back();
    }
    public function edit_ads($id){
        $ad = Ad::findorfail($id);
        return view('admin.setup.edit-ads',compact('ad'));

    }
    public function post_edit_ads(Request $request,$id){
        $ad = Ad::findorfail($id);
        $ad->name = $request->name;
        $ad->status = 0;
        $ad->link = $request->link;
        $ad->display_area = $request->display_area;
        $ad->status = 0;
        if ($request->hasFile('image')) {
            $ad_image = $request->file('image');
            $filename = time() . '.' . $ad_image->getClientOriginalExtension();
            $upload_path = "images/ads/";
            $db_filename = $upload_path . $filename;
            $ad_image->move($upload_path, $filename);
            $ad->image = $db_filename;

        }
        $ad->save();

return redirect('/view-ads');
    }

}
