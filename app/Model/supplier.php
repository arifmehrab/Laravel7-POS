<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile','email', 'address'
    ];

}
