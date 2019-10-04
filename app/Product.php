<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


       public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product','product_id','category_id');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'product_id');
    }

    public function specifications()
    {

        return $this->hasMany(Specification::class, 'product_id');
    }

    public function features()
    {

        return $this->hasMany(Feature::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }


    public function tags(){
        return $this->belongsToMany(Tag::class, 'products_tags');
    }

    public function seo(){
        return $this->hasOne(Seo::Class,'product_id');
    }

    public function reviews()
    {

        return $this->hasMany(Review::class, 'product_id');
    }

    public function order_details(){
        return $this->hasMany(Order_detail::class,'product_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class,'product_id');
    }

    public function stocks(){
        return $this->hasMany(Stock::class,'product_id');
    }

    public function valid_special_price(){
        if($this->sale_price != null or $this->special_price != ""){
            $now =date('Y-m-d');
            if($now >= $this->special_from  and $now <= $this->special_to){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function get_main_image($id){
        $main_image="";
        $product= Product::findOrFail($id);
        $images = $product->images;
//        $images = $this->images();
        foreach ($images as $image){
            if($image->is_main == 1){
                $main_image = $image->image;
            }
        }
        return $main_image;
    }

    public function get_max_stock($id, $size_title){
        $product=Product::find($id);
//        dd($product);
        if($size_title == 'Free-size'){
//            dd($product->stock_quantity);
            return $product->stock_quantity;
        }
        else{
            $size = Size::where('title',$size_title)->first();
            $stock = Stock::where('product_id',$product->id)->where('size_id',$size->id);
            return $stock->stock;
        }
    }
}


