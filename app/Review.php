<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    protected $fillable=[
        'id',
        'product_id',
        'user_id',
        'star',
        'review',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {

        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function get_percent($star,$product_id){
        $total_reviews = 0;
        $product = Product::find($product_id);

        $reviews = Review::where('product_id',$product_id)->where('star',$star)->count();
//        dd($reviews);
        $total_reviews = $product->reviews->count();
//        $star_count = $reviews->count();
        if($total_reviews != 0){
            $percent = ($reviews/$total_reviews)*100;
            return $percent;
        }
        else{
            return '0';
        }

    }
}
