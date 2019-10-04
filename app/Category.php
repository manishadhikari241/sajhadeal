<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class category extends Model
{
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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

       public function products(){
        return $this->belongsToMany(Product::class,'category_product','product_id','category_id');
    }

    public function special_category(){
        return $this->hasOne(SpecialCategory::class,'category_name');
    }
}
