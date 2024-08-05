<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moneylender extends Model
{
    protected $fillable = [
        'moneylender_name',
        'moneylender_company_name',
        'moneylender_dni',
        'moneylender_phone',
    ];
}
