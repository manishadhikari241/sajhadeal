<?php

namespace App\Http\Controllers\admin;

use App\Color;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function view()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.setup.add_colors_sizes',compact('colors','sizes'));
    }

    public function store(Request $request)
    {
        $color=new Color();
        $color->title=$request->color;
        $color->save();
        return redirect()->back()->with('success','Color Added Successfully');
    }
    public function delete($id){
        $color = Color::findOrFail($id);
        $color->delete();
        return redirect()->back()->with('success','Color Deleted Successfully');
    }
}
