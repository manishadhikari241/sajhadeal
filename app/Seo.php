<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable=[
        'seo_keyword',
        'seo_description',
        'product_id',
        'seo_title'
    ];
    public function product(){
        return $this->hasOne(Product::Class,'product_id');
    }
}
