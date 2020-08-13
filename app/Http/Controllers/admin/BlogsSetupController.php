<?php

namespace App\Http\Controllers\admin;

use App\BlogAdvertisement;
use App\BlogAuthor;
use App\BlogCategory;
use App\BlogImage;
use App\BlogImageSeo;
use App\BlogSlides;
use App\BlogTags;
use App\Blogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogsSetupController extends Controller
{
    //------------Category-----------//
    public function add_category(Request $request)
    {
        if ($request->isMethod('get')) {
            $category = BlogCategory::where('status', 1)->get();
            return view('admin.blogs.add_category', compact('category'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
            ]);
            $data['name'] = $request->category;
            if (BlogCategory::create($data)) {
                return redirect()->back()->with('success', 'Blog Category Created');
            }
        }
        return false;
    }

    public function delete_category($id)
    {
        $find = BlogCategory::findorfail($id);
        if ($find->delete()) {
            return redirect()->back()->with('success', 'Category deleted');
        }
        return false;
    }

    public function edit_category(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required'
            ]);
            $data['name'] = $request->category;
            $id = $request->id;
            $find = BlogCategory::findorfail($id);
            if ($find->update($data)) {
                return redirect()->back()->with('success', 'Category Updated');

            }
        }
        return false;
    }

    //------------ End Category-----------//
    //------------Tags-----------//

    public function blog_tags(Request $request)
    {
        if ($request->isMethod('get')) {
            $tags = BlogTags::all();
            return view('admin.blogs.add_tags', compact('tags'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:blog_tags,name',
            ]);
            $data['name'] = $request->name;
            if (BlogTags::create($data)) {
                return redirect()->back()->with('success', 'Tags Added');
            }
        }
        return false;
    }

    public function blog_tags_delete($id)
    {
        $find = BlogTags::findorfail($id);
        if ($find->delete()) {
            return redirect()->back()->with('success', 'Tags Deleted');
        }
        return false;
    }

    public function blog_tags_edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required'
            ]);
            $data['name'] = $request->name;
            $id = $request->id;
            $find = BlogTags::findorfail($id);
            if ($find->update($data)) {
                return redirect()->back()->with('success', 'Tags Updated');
            }
        }
        return false;
    }

    //------------End Tags-----------//
    //------------Author-----------//

    public function blog_author(Request $request)
    {
        if ($request->isMethod('get')) {
            $Authors = BlogAuthor::all();
            return view('admin.blogs.add_author', compact('Authors'));
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:blog_authors,name',
                'image' => 'required',
            ]);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/author/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            if (BlogAuthor::create($data)) {
                return redirect()->back()->with('success', 'Author Created');
            }
        }
        return false;
    }

    public function blog_author_delete($id)
    {
        $find = BlogAuthor::findorfail($id);
        if ($this->author_delete_file($id) && $find->delete()) {
            return redirect()->back()->with('success', 'Author Deleted');
        }
        return false;
    }

    public function blog_author_edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $author = BlogAuthor::where('id', '=', $request->id)->first();
            return view('admin.blogs.edit_author', compact('author'));

        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:blog_authors,name,' . $request->id,
            ]);
            $id = $request->id;
            if ($request->hasFile('image')) {
                $this->author_delete_file($id);
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/author/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            $update = BlogAuthor::findorfail($id);
            if ($update->update($data)) {
                return redirect()->route('blog-author')->with('success', 'Author Updated');

            }
        }
    }

    public function author_delete_file($id)
    {
        $findData = BlogAuthor::findorfail($id);
        $fileName = $findData->image;
        $deletePath = public_path('images/blogs/author/' . $fileName);
        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);
        }
        return true;
    }
    //------------End Author-----------//

    //--------Add Blog--------//
    public function add_blog(Request $request)
    {
        if ($request->isMethod('get')) {
            $cat = BlogCategory::all();
            $tag = BlogTags::all();
            $auth = BlogAuthor::all();
            $blogs = Blogs::all();
            $blog = $blogs->unique('title');
            return view('admin.blogs.add_blogs', compact('cat', 'tag', 'auth', 'blog'));
        }
        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'image_upload' => 'required',
                'tags' => 'required',
                'category' => 'required',
                'author' => 'required',
            ]);
            $data['title'] = $request->name;
            $data['description'] = $request->description;
            $data['description_2'] = $request->description_2;
            $data['category_id'] = $request->category;
            $data['author_id'] = $request->author;
            $data['seo_keyword'] = $request->seo_key;
            $data['seo_description'] = $request->seo_description;
            $data['popular'] = $request->popular;
            $data['featured'] = $request->featured;
            if ($request->hasfile('image_upload')) {
                foreach ($request->file('image_upload') as $image) {
                    $name = str_random() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/images/blogs/blogimages', $name);
                    $save[] = $name;
                }
            }
            $create = Blogs::create($data);
            $last_id = $create->id;
            foreach ($save as $value) {
                $item['image'] = $value;
                $item['blog_id'] = $last_id;
                $img = BlogImage::create($item);
            }
            foreach ($request->tags as $value) {
                DB::table('blog_tags_pivot')->insert(['blog_id' => $last_id, 'tag_id' => $value]);
            }
            if ($create) {
                return redirect()->back()->with('success', 'Blog Successfully Added');
            }

        }
    }

    public function blog_delete(Request $request)
    {
        $find = Blogs::findorfail($request->id);
        if ($this->blog_delete_image_all($request->id) && $find->delete()) {
            return redirect()->back()->with('success', 'Blogs Deleted');
        }
        return false;
    }

    public function blog_delete_image_all($id)
    {
        $findData = BlogImage::where('blog_id', $id);
        foreach ($findData->get() as $value) {
            $fileName = $value->image;
            $deletePath = public_path('images/blogs/blogimages/' . $fileName);
            if (file_exists($deletePath) && is_file($deletePath)) {
                unlink($deletePath);
            }
        }

        return true;
    }

    public function blog_delete_image($id)
    {
        $findData = BlogImage::where('id', $id);
        $fileName = $findData->first()->image;
        $deletePath = public_path('images/blogs/blogimages/' . $fileName);

        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);

        }
        $findData->delete();
        return redirect()->back()->with('success', 'Image Deleted');

    }

    public function blog_edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $cat = BlogCategory::all();
            $tag = BlogTags::all();
            $auth = BlogAuthor::all();
            $blog = Blogs::where('id', $request->id)->first();
            return view('admin.blogs.edit_blogs', compact('cat', 'tag', 'auth', 'blog'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'tags' => 'required',
                'category' => 'required',
                'author' => 'required',
            ]);
            $data['title'] = $request->name;
            $data['description'] = $request->description;
            $data['description_2'] = $request->description_2;
            $data['category_id'] = $request->category;
            $data['author_id'] = $request->author;
            $data['seo_keyword'] = $request->seo_key;
            $data['seo_description'] = $request->seo_description;
            $data['popular'] = $request->popular;
            $data['featured'] = $request->featured;
            if ($request->hasfile('image_upload')) {
                foreach ($request->file('image_upload') as $image) {
                    $name = str_random() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/images/blogs/blogimages/', $name);
                    $save[] = $name;
                }
            }
            $find = Blogs::where('id', $request->id);

            $create = $find->update($data);
            if (isset($save) && !empty($save)) {
                foreach ($save as $value) {
                    $item['image'] = $value;
                    $item['blog_id'] = $request->id;
                    $img = BlogImage::create($item);
                }
            }
            $find->first()->tags()->sync($request->tags);
            if ($create) {
                return redirect()->back()->with('success', 'Blogs Updated');
            }
        }
        return false;
    }
//----------end Blog-------------//

//-----blog Slides---------//

    public function blog_slides(Request $request)
    {
        if ($request->isMethod('get')) {
            $category = BlogCategory::where('status', 1)->get();
            $blogslides = BlogSlides::where('status', 1)->get();
            return view('admin.blogs.add_slides', compact('category', 'blogslides'));

        }
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'description' => 'required',
                'image' => 'required'

            ]);
            $data['title'] = $request->title;
            $data['category_id'] = $request->category;
            $data['description'] = $request->description;
            $data['link_1'] = $request->link_1;
            $data['link_2'] = $request->link_2;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/blogslides/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $create = BlogSlides::create($data);
            if ($create) {
                return redirect()->back()->with('success', 'Blog Slide Created');
            }

        }
        return false;
    }

    public function delete_blog_slides(Request $request)
    {
        $del = BlogSlides::findorfail($request->id);
        if ($this->delete_blog_slide_image($request->id) && $del->delete()) {
            return redirect()->back()->with('success', 'Your Slide has been Deleted');

        }
        return false;
    }

    public function delete_blog_slide_image($id)
    {
        $findData = BlogSlides::findorfail($id);
        $fileName = $findData->image;
        $deletePath = public_path('images/blogs/blogslides/' . $fileName);
        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);
        }
        return true;
    }

    public function edit_blog_slides(Request $request)
    {
        if ($request->isMethod('get')) {
            $blogslide = BlogSlides::where('id', $request->id)->first();
            $category = BlogCategory::where('status', 1)->get();

            return view('admin.blogs.edit_slides', compact('blogslide', 'category'));
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);
            $data['title'] = $request->title;
            $data['category_id'] = $request->category;
            $data['description'] = $request->description;
            $data['link_1'] = $request->link_1;
            $data['link_2'] = $request->link_2;

            $editslide = BlogSlides::findorfail($request->id);

            if ($request->hasFile('image')) {
                $this->delete_blog_slide_image($request->id);
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/blogslides/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $update = $editslide->update($data);

            if ($update) {
                return redirect()->route('blog-add-slides')->with('success', 'Blog slides Updated');
            }
        }
        return false;
    }

    public function blog_add_advertisement(Request $request)
    {
        if ($request->isMethod('get')) {
            $blogadvertisement = BlogAdvertisement::where('status', 1)->get();
            return view('admin.blogs.add_advertisement', compact('blogadvertisement'));

        }
        if ($request->isMethod('post')) {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'link' => 'required|max:1000',
                'image' => 'required'
            ])->validate();
            $data['title'] = $request->title;
            $data['link'] = $request->link;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/blogadvertisement/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $create = BlogAdvertisement::create($data);
            if ($create) {
                return redirect()->back()->with('success', 'Advertisement Created');
            }
        }
        return false;
    }

    public function delete_blog_advertisement(Request $request)
    {
        $find = BlogAdvertisement::findorfail($request->id);
        if ($this->delete_blog_advertisement_image($request->id) && $find->delete()) {
            return redirect()->back()->with('success', 'Advertisement Deleted');
        }

    }

    public function delete_blog_advertisement_image($id)
    {
        $findData = BlogAdvertisement::findorfail($id);
        $fileName = $findData->image;
        $deletePath = public_path('images/blogs/blogadvertisement/' . $fileName);
        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);
        }
        return true;
    }

    public function edit_blog_advertisement(Request $request)
    {
        if ($request->isMethod('get')) {
            $advertisement = BlogAdvertisement::where('id', $request->id)->first();
            return view('admin.blogs.edit_advertisement', compact('advertisement'));

        }
        if ($request->isMethod('post')) {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'link' => 'required|max:1000',
                'image' => 'required'
            ])->validate();
            $data['title'] = $request->title;
            $data['link'] = $request->link;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogs/blogadvertisement/');
                $image->move($destinationPath, $name);
                $data['image'] = $name;
            }
            $create = BlogAdvertisement::create($data);
            if ($create) {
                return redirect()->back()->with('success', 'Advertisement Created');
            }
        }
        return false;
    }


    public function blog_images(Request $request)
    {
        if ($request->isMethod('get')) {
            $blogimage = BlogImage::all();
            return view('admin.blogs.blog_image', compact('blogimage'));
        }
        return false;
    }

    public function update_blog_image(Request $request)
    {
        if ($request->isMethod('post')) {
            $data['id'] = $request->id;
            $data['tag'] = $request->tag;

            $update = BlogImageSeo::updateorcreate(['blog_id' => $request->id], ['alt_tag' => $request->tag]);

            if ($update) {
                return redirect()->back()->with('success', 'Successfully Updated');
            }
        }
        return false;
    }

}

