<?php

namespace App\Http\Controllers;
use App\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function view()
    {
        $faqs=FAQ::all();
        return view('add_categories',compact('faqs'));
    }
}
