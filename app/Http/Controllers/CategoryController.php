<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function view()
    {
        $user = Sentinel::getUser();
        $values = Category::all();
        return view('admin.setup.add_categories', compact('user', 'values'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = public_path('images/category/');
            $file->move($destination_path, $name);

        }
        $categories = new Category();
        if (isset($name)) {
            $categories->category_image = $name;
            $categories->image_link = $request->image_link;
        }
        $categories->title = $request->category;
        if ($request->parent_id == "") {
            $categories->parent_id = 0;
        } else {
            $categories->parent_id = $request->parent_id;
        }
        $categories->description = $request->description;
        $categories->save();
        return redirect()->back()->with('success', 'Category Added!!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->products->count() > 0) {
            Alert::error('Warning Title', 'Warning Message');
            return redirect()->back()->with('error', 'Delete Products of this Category First');
        }
        if ($category->children->count() > 0) {
            Alert::error('Warning Title', 'Warning Message');
            return redirect()->back()->with('error', 'Delete Child Categories First');
        }
        $this->delete_image($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted!!');
    }


    public function delete_image($id)
    {
        $findData = Category::findorfail($id);
        $fileName = $findData->category_image;
        $deletePath = public_path('images/category/' . $fileName);
        if (file_exists($deletePath) && is_file($deletePath)) {
            unlink($deletePath);
        }
        return true;
    }

    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($request->hasFile('category_image')) {
            $this->delete_image($id);
            $file = $request->file('category_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = public_path('images/category/');
            $file->move($destination_path, $name);

        }
        if (isset($name)) {
            $category->category_image = $name;
        }
        $category->image_link = $request->image_link;

        $category->title = $request->category_edit;
        $category->description = $request->description;
        $category->update();
        return redirect()->back()->with('success', 'Category Edited!!');
    }

    public function delete_category_image(Request $request)
    {
        if ($request->ajax()) {

            $category = Category::findorfail($request->category_id);
            $this->delete_image($request->category_id);
            $category->category_image = null;
            $category->update();
            return view('admin.setup.delete_category_image');

        }
    }

}