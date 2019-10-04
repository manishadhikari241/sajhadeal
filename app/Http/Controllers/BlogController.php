<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs(Request $request){
        if ($request->isMethod('get')){
            return view('blogs.blog');
        }
    }
    public function blogs_single(Request $request){
        if ($request->isMethod('get')){
            return view('blogs.blog_single');
        }
    }
}
