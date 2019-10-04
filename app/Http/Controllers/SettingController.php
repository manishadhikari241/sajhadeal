<?php

namespace App\Http\Controllers;

use App\Setup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function setup()
    {
        $setting=Setup::all()->first();
        if (!$setting==NULL)
        {
            return view('admin.setup.editSetup',compact('setting'));
        }
        else{
            return view('admin.setup.addSetup');
        }
    }
    public function postSetting(Request $request)
    {
        $setting=new Setup();
        $setting->company_name=$request->company_name;
        $setting->company_number=$request->company_number;
        $setting->address=$request->address;
        $setting->email=$request->email;
        $setting->copyright_year=$request->copyright_year;
        $setting->facebook_link=$request->facebook_link;
        $setting->instagram_link=$request->instagram_link;
        $setting->twitter_link=$request->twitter_link;
        $setting->youtube_link=$request->youtube_link;
        $setting->terms=$request->terms;
        $setting->policies=$request->policies;
        $setting->brief_about_us=$request->brief_about_us;
        $setting->detail_about_us=$request->detail_about_us;
        $setting->meta_keywords = $request->meta_keywords;
        $setting->meta_description = $request->meta_description;


        if($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path() . '/test/img', $fileName);
            $setting->logo = 'test/img/' . $fileName;
        }
        $setting->save();

        return redirect('/setting');
    }
    public function editPostSetting(Request $request)
    {
        $setting=Setup::all()->first();
        $setting->company_name=$request->company_name;
        $setting->company_number=$request->company_number;
        $setting->address=$request->address;
        $setting->email=$request->email;
        $setting->copyright_year=$request->copyright_year;
        $setting->facebook_link=$request->facebook_link;
        $setting->instagram_link=$request->instagram_link;
        $setting->twitter_link=$request->twitter_link;
        $setting->youtube_link=$request->youtube_link;
        $setting->terms=$request->terms;
        $setting->policies=$request->policies;
        $setting->brief_about_us=$request->brief_about_us;
        $setting->detail_about_us=$request->detail_about_us;
        $setting->meta_keywords = $request->meta_keywords;
        $setting->meta_description = $request->meta_description;


        if($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path() . '/test/img', $fileName);
            unlink($setting->logo);
            $setting->logo = 'test/img/' . $fileName;
        }
        $setting->save();


        return redirect()->back();
    }
}
