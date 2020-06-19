<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public function payment(){
       return $this->belongsTo(payment::class, 'id','invoice_id');
    }
    public function invoiceDetails(){
    	return $this->hasMany(invoiceDetail::class, 'invoice_id', 'id');
    }
}
