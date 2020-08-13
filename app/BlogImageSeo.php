<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImageSeo extends Model
{
    protected $fillable = ['blog_id', 'alt_tag'];
}
