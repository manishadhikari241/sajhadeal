<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
