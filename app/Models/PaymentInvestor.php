<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInvestor extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNote_id',
        'investor_id',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }

    public function promissoryNoteInvestor()
    {
        return $this->belongsTo(PromissoryNote::class, 'promissoryNote_id');
    }
}
