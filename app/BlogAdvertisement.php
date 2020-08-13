<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogAdvertisement extends Model
{
    protected $fillable = ['title', 'link', 'image'];
}
