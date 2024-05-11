<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'transfer_code',
        'transfer_bank',
        'investor_id',
        'transfer_amount',
        'transfer_description',
    ];
}
