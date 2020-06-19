<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    public function customer(){
    	return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
    public function invoice(){
    	return $this->belongsTo(invoice::class, 'invoice_id', 'id');
    }
}
