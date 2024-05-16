<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'id');
    }

    public function credit_note()
    {
        return $this->hasMany(CreditNote::class, 'id');
    }

    protected $fillable = [
        'investor_name',
        'investor_dni',
        'investor_phone',
        'investor_reference_id',
        'investor_balance',
        'investor_status',
    ];
}
