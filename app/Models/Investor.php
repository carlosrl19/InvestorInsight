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

    public function project()
    {
        return $this->hasMany(Project::class, 'investor_id', 'id');

    }

    protected $fillable = [
        'investor_name',
        'investor_company_name',
        'investor_dni',
        'investor_phone',
        'investor_reference_id',
        'investor_balance',
        'investor_status',
    ];
}
