<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
