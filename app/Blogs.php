<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $fillable=['title','description','featured','popular','author_id','category_id','seo_keyword','seo_description','description_2'];

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

    public function images()
    {
        return $this->hasMany(BlogImage::class,'blog_id');
    }
    public function authors()
    {
        return $this->belongsTo(BlogAuthor::class,'author_id');
    }
    public function categories()
    {
        return $this->belongsTo(BlogCategory::class,'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(BlogTags::class, 'blog_tags_pivot', 'blog_id', 'tag_id');
    }
}
