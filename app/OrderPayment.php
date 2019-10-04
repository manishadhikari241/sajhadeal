<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $table = 'payments';


    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
