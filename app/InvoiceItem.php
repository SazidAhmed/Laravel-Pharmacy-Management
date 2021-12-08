<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Medicine;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'medicine_id', 'qty', 'amount'];

    public function invoice(){
    	return $this->belongsTo(Invoice::class);
    }

    public function medicine(){
    	return $this->belongsTo(Medicine::class);
    }
}
