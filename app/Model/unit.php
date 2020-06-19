<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];
}
