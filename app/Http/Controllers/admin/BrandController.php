<?php

namespace App\Http\Controllers\admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function view()
    {
        $brands = Brand::all();
        return view('admin.setup.add_brand',compact('brands'));
    }

    public function store(Request $request)
    {
        $brand=new Brand();
        $brand->title=$request->title;
        if ($request->hasFile('brand_logo')){
            $image=$request->file('brand_logo');
            $filename=time().'-brand.'.$image->getClientOriginalExtension();
//            $image->move('images/',$filename);
//
            $upload_path="images/brands/";
            $db_filename=$upload_path.$filename;
            $image->move($upload_path, $filename);
            $brand->brand_logo=$db_filename;
        }
        $brand->save();
        return redirect()->back()->with('success','Brand Added Successfully');
    }

    public function delete($id){
        $brand = Brand::findOrFail($id);
        $filename=$brand->brand_logo;
        if (file_exists(public_path() . '/' . $filename)) {
            unlink(public_path() . '/' . $filename);
        }
        $brand->delete();
        return redirect()->back()->with('success','Brand Deleted Successfully');
    }
}
