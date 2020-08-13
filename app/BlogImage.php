<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = ['image', 'blog_id'];

    public function blogs()
    {
        return $this->belongsTo(Blogs::class, 'blog_id', 'id');
    }

    public function blogimageseos()
    {
        return $this->hasone(BlogImageSeo::class, 'blog_id');
    }
}
