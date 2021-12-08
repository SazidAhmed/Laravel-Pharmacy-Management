<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;
class Unit extends Model
{
    protected $fillable = ['name'];

    public function medicine(){
    	return $this->hasMany(Medicine::class);
    }
}
