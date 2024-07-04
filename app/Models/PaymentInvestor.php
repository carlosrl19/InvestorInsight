<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInvestor extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNoteInvestor_id',
    ];

    public function investors()
    {
        return $this->belongsTo(Investor::class);
    }

    public function promissoryNoteInvestor()
    {
        return $this->belongsTo(PromissoryNote::class, 'promissoryNoteInvestor_id');
    }
}
