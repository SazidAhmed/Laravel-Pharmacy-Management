<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CartItem;

class Cart extends Model
{
    protected $fillable = ['user_id', 'customer_id'];

    public function user(){
    	return $this->hasOne(User::class);
    }

    public function cartItem(){
    	return $this->hasMany(CartItem::class);
    }
}
