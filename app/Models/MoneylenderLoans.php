<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneylenderLoans extends Model
{
    protected $fillable = [
        'moneylender_id',
        'investor_id',
        'loan_invoice_code',
        'loan_amount',
        'loan_date',
        'loan_paydate',
    ];

    public function moneylenders()
    {
        return $this->hasMany(Moneylender::class, 'moneylender_id')
            ->onDelete('cascade');
    }

    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'investor_id')
            ->onDelete('cascade');
    }
}
