<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
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
    public function products(){
        return $this->belongsToMany(Product::class,'product_size')
            ->withTimeStamps();
    }
    public function stocks(){
        return $this->hasMany(Stock::class,'size_id');
    }
}
