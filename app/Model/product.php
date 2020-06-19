<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function supplier(){
    	return $this->belongsTo(supplier::class,'supplier_id','id');
    }
    public function unit(){
    	return $this->belongsTo(unit::class,'unit_id','id');
    }
    public function category(){
    	return $this->belongsTo(category::class,'category_id','id');
    }
}
