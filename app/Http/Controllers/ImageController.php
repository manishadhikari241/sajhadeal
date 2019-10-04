<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function delete($id)
    {
        $image = Image::findOrFail($id);
//        unlink(asset('/admin/images/packages/oficcial-512-package.png'));
        $filename = $image->image;
        unlink(public_path() . '/' . $filename);
//        unlink(public_path() . '/' . $thumbnail);
        $image->delete();
        return response()->json(['success' => 'Image has been deleted successfully!']);

//        if($image->is_main == 1){
//            $change=1;
//            $package = Package::find($image->package_id);
//        }
//        if ($image->delete()) {
//            if($change == 1 && $package->images->count > 0){
//                $new_main_image = $package->images->first();
//                $new_main_image->is_main =1;
//                $new_main_image->save();
//            }
//            return response()->json([
//                'success' => 'Image has been deleted successfully!'
//            ]);
//        } else {
//            return response()->json([
//                'error' => 'Failed to delete!'
//            ]);
//        }
    }

    public function store(Request $request, $id)
    {
        $image = new Image();
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $upload_path = "images/product/";
            $db_filename = $upload_path . $filename;
            $file->move(public_path($upload_path), $filename);
//            $file->move(public_path($location), $filename);
            $db_filename = $upload_path . $filename;

            $image->product_id = $id;
            $image->image = $db_filename;
            $image->is_main = 0;
            $image->save();
            return response()->json(['success' => 'Image successfully uploaded']);
        } else {
            return response()->json(['error' => 'Image not uploaded']);
        }
    }

    public function change_main($id)
    {
        $change = Image::findOrFail($id);
        $images = Image::where('product_id',$change->product->id)->get();
//        $images = Image::all();
        foreach ($images as $image) {
            if ($image->id == $change->id) {
                $image->is_main = 1;
            } else {
                $image->is_main = 0;
            }
            $image->save();
        }
        return response()->json(['success' => 'Is_main changed']);
    }
}
