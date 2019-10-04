<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function order_details(){
        return $this->hasMany(Order_detail::class,'order_id');
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function address(){
        return  $this->belongsTo(Address::class,'address_id');
    }
    public function coupon(){
        return  $this->belongsTo(Coupon::class,'coupon_id');
    }
    public function order_payment(){
        return $this->hasOne(OrderPayment::class,'order_id');
    }

}
