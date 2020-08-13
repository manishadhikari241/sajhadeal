<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogSlides extends Model
{
    protected $fillable = ['category_id', 'title', 'description', 'link_1', 'link_2', 'image'];

    public function categories()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}



