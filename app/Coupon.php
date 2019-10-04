<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code)
    {
        return self::where('coupon_code', $code)->first();
    }

    public function discount($total)
    {
        if ($this->discount_type == 'fixed') {
            return $this->discount;
        } elseif ($this->discount_type == 'percentage') {
            return ($this->discount / 100 )* $total;
        } else {
            return 0;
        }
    }

    public function check_validity($id){
        $coupon= Coupon::find($id);
        if($coupon->expiry_date >= date('Y-m-d') && $coupon->max_users > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function order(){
        return $this->hasMany(Order::class,'coupon_id');
    }
}
