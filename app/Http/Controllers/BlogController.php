<?php

namespace App\Http\Controllers;

use App\BlogAdvertisement;
use App\BlogCategory;
use App\BlogSlides;
use App\BlogTags;
use Illuminate\Http\Request;

use App\Blogs;

class BlogController extends Controller
{
    public function blogs(Request $request)
    {
        if ($request->isMethod('get')) {
            $blogs = Blogs::paginate(8);
            $popular = Blogs::where('popular', '!=', null)->latest()->take(3)->get();
            $blogslides = BlogSlides::where('status', 1)->get();
            $all_category = BlogCategory::where('status', 1)->get();
            $tags = BlogTags::all();
            $advertisement = BlogAdvertisement::latest()->get();


            return view('blogs.blog', compact('blogs', 'popular', 'all_category', 'tags', 'blogslides','advertisement'));
        }
        return false;
    }

    public function blogs_single(Request $request)
    {
        if ($request->isMethod('get')) {
            $popular = Blogs::where('popular', '!=', null)->latest()->take(3)->get();
            $tags = BlogTags::all();
            $blog = Blogs::where('slug', $request->slug)->first();
            $all_category = BlogCategory::where('status', 1)->get();
            $related = Blogs::where('category_id', $blog->category_id)->latest()->take(3)->get();
            return view('blogs.blog_single', compact('blog', 'all_category', 'popular', 'tags', 'related'));
        }
    }

    public function blog_category(Request $request)
    {
        $slug = $request->slug;
        $categoryname = BlogCategory::where('slug', $slug)->first()->name;
        $blogfromcategory = Blogs::wherehas('categories', function ($query) use ($slug) {
            $query->where('blog_categories.slug', $slug)->where('blog_categories.status', 1);
        })->paginate(8);
        $popular = Blogs::where('popular', '!=', null)->latest()->take(3)->get();
        $blogslides = BlogSlides::where('status', 1)->get();
        $all_category = BlogCategory::where('status', 1)->get();
        $tags = BlogTags::all();

        return view('blogs.blog', compact('blogfromcategory', 'popular', 'all_category', 'tags', 'blogslides', 'categoryname'));
    }
}
