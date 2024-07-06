<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moneylender extends Model
{
    protected $fillable = [
        'moneylender_name',
        'moneylender_dni',
        'moneylender_phone',
        'moneylender_description'
    ];
}
