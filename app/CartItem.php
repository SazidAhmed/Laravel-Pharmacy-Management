<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Medicine;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'medicine_id', 'qty'];

    public function cart(){
    	return $this->belongsTo(Cart::class);
    }

    public function medicine(){
    	return $this->belongsTo(Medicine::class);
    }
}
