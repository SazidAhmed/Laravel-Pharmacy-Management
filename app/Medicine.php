<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Manufacturer;
use App\Category;
use App\CartItem;
use App\InvoiceItem;
use App\Unit;

class Medicine extends Model
{
    protected $fillable = ['name','category_id','manufacturer_id', 'unit_id','price','stock','expire','description','image'];

    public function category(){
    	return $this->hasOne(Category::class,'id','category_id');

    }
    public function manufacturer(){
    	return $this->belongsTo(Manufacturer::class);
    }

    public function unit(){
    	return $this->belongsTo(Unit::class);
    }

    public function cartItem(){
    	return $this->hasOne(CartItem::class);
    }

    public function invoiceItem(){
    	return $this->hasOne(InvoiceItem::class);
    }
}
