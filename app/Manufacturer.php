<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;
class Manufacturer extends Model
{
    protected $fillable = ['name','image'];

    public function medicine(){
    	return $this->hasMany(Medicine::class);
    }
}
