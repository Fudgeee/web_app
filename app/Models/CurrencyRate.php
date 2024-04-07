<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'currency',
        'rate',
        'date'
    ];

}
