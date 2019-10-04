<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialCategory extends Model
{
    protected $table="special_categories";

    public function category(){
        return $this->belongsTo(category::class,'category_name');
    }
}
