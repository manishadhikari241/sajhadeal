<?php

namespace App\Http\Controllers\admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function add_tag(){
        $tags = Tag::all();
        return view('admin.setup.tags',compact('tags'));
    }
    public function delete_tag($id){
        $tag = Tag::findorfail($id);
        $tag->delete();
        return redirect()->bacK();
    }
    public function post_tag(Request $request){
        $tag = new Tag();
        $tag->title = $request->tags;
        $tag->save();

        return redirect()->back();
    }
}
