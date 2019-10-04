<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table ='address';

    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function orders(){
        return  $this->hasMany(Order::class,'address_id');
    }
}
