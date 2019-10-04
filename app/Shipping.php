<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function orders(){
        return $this->hasMany(Order::class,'shipping_id');
    }
    public function addresses(){
        return $this->hasMany(Address::class,'shipping_id');
    }
}
