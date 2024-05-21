<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionAgent extends Model
{
    protected $fillable = [
        'commissioner_name',
        'commissioner_dni',
        'commissioner_phone',
    ];
}
