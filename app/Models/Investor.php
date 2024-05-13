<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'id');
    }

    protected $fillable = [
        'investor_name',
        'investor_dni',
        'investor_phone',
        'investor_reference',
        'investor_balance',
        'investor_status',
    ];
}
