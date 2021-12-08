<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Customer;
use App\InvoiceItem;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'payment'];
    
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    public function invoiceItem(){
    	return $this->hasMany(InvoiceItem::class);
    }
}
