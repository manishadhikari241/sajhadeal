<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
'product_id','title','specification'

    ];

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
