<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = [
        'investor_name',
        'investor_dni',
        'investor_phone',
        'investor_reference',
        'investor_status',
    ];
}
