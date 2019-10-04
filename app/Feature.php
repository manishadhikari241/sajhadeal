<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    protected $fillable = [
'product_id','title'

    ];


    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
