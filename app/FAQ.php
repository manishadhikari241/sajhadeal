<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table='faqs';
    protected $fillable = [
        'question', 'answer', 'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
