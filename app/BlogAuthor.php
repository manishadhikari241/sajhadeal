<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogAuthor extends Model
{
    protected $fillable=['name','image','description'];
}
