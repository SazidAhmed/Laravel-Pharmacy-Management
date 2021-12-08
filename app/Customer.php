<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;
use App\Invoice;

class Customer extends Model
{
    protected $fillable = ['name','phone','address'];

    public function medicine(){
    	return $this->hasMany(Medicine::class);
    }

    public function invoice(){
    	return $this->hasOne(Invoice::class);
    }
}
