<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'provider_id',
        'phone',
        'name',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class,'user_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function orders(){
        return $this->hasMany(Order::class,'customer_id');
    }
    public function address(){
        return $this->hasOne(Address::class,'customer_id');
    }

}
