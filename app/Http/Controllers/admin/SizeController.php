<?php

namespace App\Http\Controllers\admin;

use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function store(Request $request)
    {
        $size=new Size();
        $size->title=$request->size;
        $size->save();
        return redirect()->back()->with('success','Size Added Successfully');
    }

    public function delete($id){
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->back()->with('success','Size Deleted Successfully');
    }
}
