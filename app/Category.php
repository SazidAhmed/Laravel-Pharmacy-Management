<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;
class Category extends Model
{
    protected $fillable = ['name','slug','image'];

    public function medicine(){
    	return $this->hasMany(Medicine::class);
    }
}
