<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $fillable=[
        'id',
        'user_id',
        'first_name',
        'last_name',
        'mobile',
        'dob',
        'gender',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
